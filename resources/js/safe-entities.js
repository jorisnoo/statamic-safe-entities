import EntityButton from './components/EntityButton.vue';

Statamic.booting(() => {
    Statamic.$components.register('safe-entities-button', EntityButton);

    Statamic.$bard.buttons((allButtons, button) => {
        return button({
            name: 'safeentities',
            text: 'Insert Entity',
            component: 'safe-entities-button',
            html: '<span class="text-2xs font-mono leading-none">&amp;</span>',
        });
    });
});
