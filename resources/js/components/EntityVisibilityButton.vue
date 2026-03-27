<template>
    <Button
        class="px-2!"
        :variant="visible ? 'solid' : 'ghost'"
        size="sm"
        :aria-label="button.text"
        v-tooltip="button.text"
        @click="toggle"
    >
        <div class="flex items-center" v-html="icon" />
    </Button>
</template>

<script>
import { Button } from '@statamic/cms/ui';

const eyeOpen = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="14" height="14" fill="currentColor"><path d="M8 3.5C4.136 3.5 1.093 6.46.126 7.72a.5.5 0 0 0 0 .56C1.093 9.54 4.136 12.5 8 12.5s6.907-2.96 7.874-4.22a.5.5 0 0 0 0-.56C14.907 6.46 11.864 3.5 8 3.5M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0-1.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/></svg>';
const eyeClosed = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="14" height="14" fill="currentColor"><path d="M1.48 1.48a.75.75 0 0 0-.022 1.06l2.66 2.773C2.627 6.41 1.426 7.58.948 8.094a.75.75 0 0 0 .104 1.312l.466.156-.466-.156c.96.59 2.3 1.243 3.84 1.63l-.792 1.903a.75.75 0 0 0 1.386.576L6.4 11.383c.526.083 1.06.13 1.6.13s1.074-.047 1.6-.13l.914 2.132a.75.75 0 0 0 1.386-.576l-.792-1.902a11 11 0 0 0 2.218-.834l1.634 1.703a.75.75 0 0 0 1.082-1.04l-12.5-13.024a.75.75 0 0 0-1.06-.022M11.07 9.472l-1.72-1.793A2 2 0 0 0 8 5.963a2 2 0 0 0-1.963 1.612L4.18 5.666A8.6 8.6 0 0 1 8 4.986c3.12 0 5.57 2.11 6.605 3.07A13.4 13.4 0 0 1 11.07 9.47"/></svg>';

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

    data() {
        return {
            visible: true,
        };
    },

    computed: {
        icon() {
            return this.visible ? eyeOpen : eyeClosed;
        },
    },

    mounted() {
        this._syncVisible = () => {
            this.visible = this.editor.storage.entityVisibility.visible;
        };
        this.editor.on('transaction', this._syncVisible);
    },

    beforeUnmount() {
        this.editor.off('transaction', this._syncVisible);
    },

    methods: {
        toggle() {
            this.editor.commands.toggleEntityVisibility();
        },
    },
};
</script>
