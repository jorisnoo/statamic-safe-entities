const loaders = {
    de: () => import('hyphen/de'),
    fr: () => import('hyphen/fr'),
    'en-us': () => import('hyphen/en-us'),
    'en-gb': () => import('hyphen/en-gb'),
};

const cache = {};

async function getHyphenator(language) {
    if (cache[language]) return cache[language];

    const loader = loaders[language];
    if (!loader) throw new Error(`Unsupported hyphenation language: ${language}`);

    const mod = await loader();
    cache[language] = mod.hyphenate || mod.default;
    return cache[language];
}

async function hyphenateDocument(editor, hyphenate, from, to) {
    const { state } = editor;
    const { doc } = state;
    const { tr } = state;
    let offset = 0;

    const nodes = [];
    doc.nodesBetween(from, to, (node, pos) => {
        if (node.isText) nodes.push({ text: node.text, pos });
    });

    for (const { text, pos } of nodes) {
        const clean = text.replaceAll('&shy;', '');
        const hyphenated = await hyphenate(clean);
        const withEntities = hyphenated.replaceAll('\u00AD', '&shy;');

        if (withEntities === text) continue;

        const adjustedFrom = pos + offset;
        const adjustedTo = pos + text.length + offset;

        tr.insertText(withEntities, adjustedFrom, adjustedTo);
        offset += withEntities.length - text.length;
    }

    if (tr.docChanged) {
        editor.view.dispatch(tr);
    }
}

export function createAutoHyphenateExtension(tiptap) {
    const { Extension } = tiptap.core;

    return Extension.create({
        name: 'autoHyphenate',

        addStorage() {
            return { loading: false };
        },

        addCommands() {
            return {
                autoHyphenate:
                    ({ language = 'de' } = {}) =>
                    () => {
                        const editor = this.editor;
                        editor.storage.autoHyphenate.loading = true;

                        getHyphenator(language)
                            .then((hyphenate) => {
                                const { selection, doc } = editor.state;
                                const hasSelection = !selection.empty;
                                const from = hasSelection ? selection.from : 0;
                                const to = hasSelection ? selection.to : doc.content.size;

                                hyphenateDocument(editor, hyphenate, from, to);
                            })
                            .finally(() => {
                                editor.storage.autoHyphenate.loading = false;
                            });

                        return true;
                    },
            };
        },
    });
}
