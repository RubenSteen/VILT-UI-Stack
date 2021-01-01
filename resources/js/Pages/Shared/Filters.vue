<template>
    <div :class="{ 'pointer-events-none': !showSidebar}" class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <transition
                enter-active-class="transition-opacity ease-linear duration-300"
                enter-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition-opacity ease-linear duration-300"
                leave-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div v-show="showSidebar" @click="toggleSidebar()" class="fixed inset-0" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
                </div>
            </transition>
            <section class="absolute inset-y-0 pl-16 max-w-full right-0 flex" aria-labelledby="slide-over-heading">
                <transition
                    enter-active-class="transform transition ease-in-out duration-500 sm:duration-700"
                    enter-class="translate-x-full"
                    enter-to-class="translate-x-0"
                    leave-active-class="transform transition ease-in-out duration-500 sm:duration-700"
                    leave-class="translate-x-0"
                    leave-to-class="translate-x-full"
                >
                    <div v-show="showSidebar" class="w-screen max-w-md">
                        <form class="h-full divide-y divide-gray-200 flex flex-col bg-white shadow-xl">
                            <div class="flex-1 h-0 overflow-y-auto">
                                <div class="py-6 px-4 bg-indigo-700 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <h2 id="slide-over-heading" class="text-lg font-medium text-white">
                                            Filters
                                        </h2>
                                        <div class="ml-3 h-7 flex items-center">
                                            <button @click="toggleSidebar()" type="button" class="bg-indigo-700 rounded-md text-indigo-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                                                <span class="sr-only">Close panel</span>
                                                <!-- Heroicon name: x -->
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mt-1">
                                        <p class="text-sm text-indigo-300">
                                            Get started by filling in the information below to create your new project.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex-1 flex flex-col justify-between">

                                    <!--Content-->
                                    <slot />
                                    <!--End content-->

                                </div>
                            </div>
                            <div class="flex-shrink-0 px-4 py-4 flex justify-end">
                                <button @click="reset()" type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Reset
                                </button>
                                <button @click="applyFilters()" type="button" class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Apply
                                </button>
                            </div>
                        </form>
                    </div>
                </transition>
            </section>
        </div>
    </div>
</template>

<script>
export default {
    name: "Filters",

    props: {
        filters: Object,
        showSidebar: Boolean,
    },

    data() {
        return {

            pendingFilters: { ...this.filters },
        }
    },

    methods: {
        applyFilters() {
            this.toggleSidebar();
            this.$emit('applyFilters', this.pendingFilters);
        },

        toggleSidebar() {
            this.$emit('toggleSidebar');
        },

        reset() {
            this.toggleSidebar();
            this.$emit('reset');
        },
    },
}
</script>

<style scoped>

</style>
