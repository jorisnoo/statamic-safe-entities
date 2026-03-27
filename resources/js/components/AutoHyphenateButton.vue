<template>
    <Button
        class="px-2!"
        variant="ghost"
        size="sm"
        :aria-label="button.text"
        v-tooltip="tooltip"
        :disabled="loading"
        @click="hyphenate"
    >
        <div class="flex items-center" v-html="button.html" />
    </Button>
</template>

<script>
import { Button } from '@statamic/cms/ui';

export default {
    components: { Button },

    props: {
        button: Object,
        active: Boolean,
        variant: String,
        config: Object,
        bard: {},
        editor: {},
    },

    computed: {
        languages() {
            return Statamic.$config.get('safeEntitiesHyphenation') || {};
        },

        language() {
            const locale = (Statamic.$config.get('safeEntitiesLocale') || '').toLowerCase().replace('_', '-');
            const codes = Object.keys(this.languages);

            return codes.find(code => code === locale)
                || codes.find(code => locale.startsWith(code))
                || codes.find(code => code.startsWith(locale))
                || codes[0]
                || null;
        },

        tooltip() {
            const label = this.language ? this.languages[this.language] : null;
            return label ? `${this.button.text} (${label})` : this.button.text;
        },

        loading() {
            return this.editor?.storage?.autoHyphenate?.loading || false;
        },
    },

    methods: {
        hyphenate() {
            if (this.language) {
                this.editor.commands.autoHyphenate({ language: this.language });
            }
        },
    },
};
</script>
