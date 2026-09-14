import EntityButton from './components/EntityButton.vue';
import EntityVisibilityButton from './components/EntityVisibilityButton.vue';
import { createEntityVisibilityExtension } from './extensions/EntityVisibility.js';

Statamic.booting(() => {
    Statamic.$components.register('safe-entities-button', EntityButton);
    Statamic.$components.register('entity-visibility-button', EntityVisibilityButton);

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
                html: '',
            }),
        ];
    });

    Statamic.$bard.addExtension(({ tiptap }) => [
        createEntityVisibilityExtension(tiptap),
    ]);
});
