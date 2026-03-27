import EntityButton from './components/EntityButton.vue';
import EntityVisibilityButton from './components/EntityVisibilityButton.vue';
import { createEntityVisibilityExtension } from './extensions/EntityVisibility.js';

Statamic.booting(() => {
    Statamic.$components.register('safe-entities-button', EntityButton);
    Statamic.$components.register('entity-visibility-button', EntityVisibilityButton);

    const hyphenationLanguages = Statamic.$config.get('safeEntitiesHyphenation') || {};
    const hasHyphenation = Object.keys(hyphenationLanguages).length > 0;

    if (hasHyphenation) {
        Promise.all([
            import('./components/AutoHyphenateButton.vue'),
            import('./extensions/AutoHyphenate.js'),
        ]).then(([{ default: AutoHyphenateButton }, { createAutoHyphenateExtension }]) => {
            Statamic.$components.register('auto-hyphenate-button', AutoHyphenateButton);
            Statamic.$bard.addExtension(({ tiptap }) => [createAutoHyphenateExtension(tiptap)]);
        });
    }

    Statamic.$bard.buttons((allButtons, button) => {
        const buttons = [
            button({
                name: 'safeentities',
                text: 'Special Characters',
                component: 'safe-entities-button',
                html: '<span class="text-2xs font-mono leading-none">&amp;</span>',
            }),
            button({
                name: 'entityvisibility',
                text: 'Toggle special characters visibility',
                component: 'entity-visibility-button',
                html: '',
            }),
        ];

        if (hasHyphenation) {
            buttons.push(button({
                name: 'autohyphenate',
                text: 'Auto-Hyphenate',
                component: 'auto-hyphenate-button',
                html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="14" height="14" fill="currentColor"><path d="M2.5 2a.5.5 0 0 0-.5.5v11a.5.5 0 0 0 1 0v-4h3v4a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0v6H3v-6a.5.5 0 0 0-.5-.5m8.5 2a.5.5 0 0 0-.47.33l-3 8.5a.5.5 0 0 0 .94.34L9.26 11h3.48l.79 2.17a.5.5 0 0 0 .94-.34l-3-8.5A.5.5 0 0 0 11 4m0 2.12L12.38 10H9.62z"/></svg>',
            }));
        }

        return buttons;
    });

    Statamic.$bard.addExtension(({ tiptap }) => [
        createEntityVisibilityExtension(tiptap),
    ]);
});
