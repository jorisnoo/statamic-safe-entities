<template>
    <Dropdown align="center">
        <template #trigger>
            <Button
                class="px-2!"
                variant="ghost"
                size="sm"
                :aria-label="button.text"
                v-tooltip="button.text"
                :disabled="loading"
            >
                <div class="flex items-center" v-html="button.html" />
            </Button>
        </template>
        <DropdownItem
            v-for="(label, code) in languages"
            :key="code"
            @click="hyphenate(code)"
        >
            <span class="text-xs">{{ label }}</span>
        </DropdownItem>
    </Dropdown>
</template>

<script>
import { Button, Dropdown, DropdownItem } from '@statamic/cms/ui';

export default {
    components: { Button, Dropdown, DropdownItem },

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

        loading() {
            return this.editor?.storage?.autoHyphenate?.loading || false;
        },
    },

    methods: {
        hyphenate(language) {
            this.editor.commands.autoHyphenate({ language });
        },
    },
};
</script>
