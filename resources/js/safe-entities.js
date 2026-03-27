import EntityButton from './components/EntityButton.vue';
import EntityVisibilityButton from './components/EntityVisibilityButton.vue';
import AutoHyphenateButton from './components/AutoHyphenateButton.vue';
import { createEntityVisibilityExtension } from './extensions/EntityVisibility.js';
import { createAutoHyphenateExtension } from './extensions/AutoHyphenate.js';

Statamic.booting(() => {
    Statamic.$components.register('safe-entities-button', EntityButton);
    Statamic.$components.register('entity-visibility-button', EntityVisibilityButton);
    Statamic.$components.register('auto-hyphenate-button', AutoHyphenateButton);

    Statamic.$bard.buttons((allButtons, button) => {
        return [
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
                html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="14" height="14" fill="currentColor"><path d="M8 3.5C4.136 3.5 1.093 6.46.126 7.72a.5.5 0 0 0 0 .56C1.093 9.54 4.136 12.5 8 12.5s6.907-2.96 7.874-4.22a.5.5 0 0 0 0-.56C14.907 6.46 11.864 3.5 8 3.5M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0-1.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/></svg>',
            }),
            button({
                name: 'autohyphenate',
                text: 'Auto-Hyphenate',
                component: 'auto-hyphenate-button',
                html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="14" height="14" fill="currentColor"><path d="M2.5 2a.5.5 0 0 0-.5.5v11a.5.5 0 0 0 1 0v-4h3v4a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0v6H3v-6a.5.5 0 0 0-.5-.5m8.5 2a.5.5 0 0 0-.47.33l-3 8.5a.5.5 0 0 0 .94.34L9.26 11h3.48l.79 2.17a.5.5 0 0 0 .94-.34l-3-8.5A.5.5 0 0 0 11 4m0 2.12L12.38 10H9.62z"/></svg>',
            }),
        ];
    });

    Statamic.$bard.addExtension(({ tiptap }) => {
        return [
            createEntityVisibilityExtension(tiptap),
            createAutoHyphenateExtension(tiptap),
        ];
    });
});
