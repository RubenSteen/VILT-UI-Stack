<template>
    <div>
        <flash-messages />

        <!-- Sub Layout -->
        <slot />
    </div>
</template>

<script>
import MasterLayout from '@/Layouts/MasterLayout';
import FlashMessages from '@/Shared/FlashMessages';

export default {
    name: 'MasterLayout',

    components: {
        FlashMessages,
        MasterLayout,
    },

    props: {
        title: String,
    },

    watch: {
        title: {
            immediate: true,
            handler(title) {
                document.title = title + ' - ' + this.$page.props.app.name;
            },
        },
    },
};
</script>

<style scoped></style>
