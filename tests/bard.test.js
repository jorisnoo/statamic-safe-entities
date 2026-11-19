import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import test from 'node:test';
import { JSDOM } from 'jsdom';

test('the shipped toolbar inserts literal codes and previews configured outputs without editing content', async () => {
    const dom = new JSDOM('<!doctype html><html><body></body></html>', { pretendToBeVisual: true });
    globalThis.window = dom.window;
    globalThis.document = dom.window.document;
    globalThis.requestAnimationFrame = dom.window.requestAnimationFrame.bind(dom.window);
    globalThis.getComputedStyle = dom.window.getComputedStyle.bind(dom.window);
    window.Vue = await import('vue');
    const core = await import('@tiptap/core');
    const state = await import('@tiptap/pm/state');
    const view = await import('@tiptap/pm/view');
    const { StarterKit } = await import('@tiptap/starter-kit');
    const components = new Map();
    const config = {
        safeEntities: { '&shy;': { label: 'Soft hyphen', output: '&shy;' }, '&nnbsp;': { label: 'Narrow space', output: '&#8239;' } },
        safeEntityButtons: { insert: 'Sonderzeichen', toggle: 'Umschalten' },
    };
    let buttons, extensions;
    // The addon registers with these public CP hooks; editing uses a real Tiptap editor.
    globalThis.__STATAMIC__ = { ui: {} };
    globalThis.Statamic = {
        booting: fn => fn(),
        $config: { get: key => config[key] },
        $components: { register: (name, component) => components.set(name, component) },
        $bard: {
            buttons: fn => { buttons = fn([], button => button); },
            addExtension: fn => { extensions = fn({ tiptap: { core, pm: { state, view } } }); },
        },
    };
    const dir = new URL('../resources/dist/build/', import.meta.url);
    const manifest = JSON.parse(readFileSync(new URL('manifest.json', dir)));
    await import(new URL(manifest['resources/js/safe-entities.js'].file, dir));
    const editor = new core.Editor({ extensions: [StarterKit, ...extensions] });
    try {
        const [insert, visibility] = buttons;
        assert.equal(insert.name, 'safeentities');
        assert.equal(insert.text, 'Sonderzeichen');
        assert.equal(visibility.name, 'entityvisibility');
        assert.equal(visibility.text, 'Umschalten');
        const button = components.get(insert.component);
        assert.deepEqual(button.computed.entities(), config.safeEntities);
        for (const code of Object.keys(config.safeEntities)) button.methods.insert.call({ editor }, code);
        const text = editor.getText();
        assert.equal(text, '&shy;&nnbsp;');
        const getText = selector => Array.from(editor.view.dom.querySelectorAll(selector), el => el.textContent);
        assert.deepEqual(getText('.entity-marker'), ['&shy;', '&nnbsp;']);
        const toggle = () => components.get(visibility.component).methods.toggle.call({ editor });
        toggle();
        assert.deepEqual(getText('.entity-rendered'), ['\u00ad', '\u202f']);
        assert.equal(editor.getText(), text);
        toggle();
        assert.deepEqual(getText('.entity-rendered'), []);
    } finally {
        editor.destroy();
        dom.window.close();
    }
});
