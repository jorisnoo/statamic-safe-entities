<template>
    <Dropdown align="center">
        <template #trigger>
            <Button
                class="px-2!"
                variant="ghost"
                size="sm"
                :aria-label="button.text"
                v-tooltip="button.text"
            >
                <div class="flex items-center" v-html="button.html" />
            </Button>
        </template>
        <DropdownItem
            v-for="(label, code) in entities"
            :key="code"
            @click="insert(code)"
        >
            <span class="font-mono text-xs">{{ code }}</span>
            <span class="text-gray-500 text-2xs ml-1">{{ label }}</span>
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
        entities() {
            return Statamic.$config.get('safeEntities') || {};
        },
    },

    methods: {
        insert(code) {
            this.editor.chain().focus().insertContent(code).run();
        },
    },
};
</script>
