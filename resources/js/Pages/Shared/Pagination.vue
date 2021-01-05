<template>
    <nav class="border-t border-gray-200 px-4 flex items-center justify-between sm:px-0">
        <div class="-mt-px w-0 flex-1 flex pl-4">
            <inertia-link
                v-if="getPreviousPage.url !== null"
                :href="getPreviousPage.url"
                class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300"
            >
                <svg
                    class="mr-3 h-5 w-5 text-gray-400"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    aria-hidden="true"
                >
                    <path
                        fill-rule="evenodd"
                        d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
                {{ getPreviousPage.label }}
            </inertia-link>
            <div
                v-else
                class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-200 hidden md:block cursor-default"
            >
                <svg
                    class="mr-3 h-5 w-5 text-gray-200"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    aria-hidden="true"
                >
                    <path
                        fill-rule="evenodd"
                        d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
            </div>
        </div>
        <div class="hidden md:-mt-px md:flex">
            <inertia-link
                v-for="(link, index) in links"
                :key="index"
                v-if="Number.isInteger(link.label)"
                :href="link.url"
                v-bind:class="[
                    link.active
                        ? 'border-indigo-500 text-indigo-600'
                        : 'text-gray-500 hover:text-gray-700 hover:border-gray-300 border-transparent',
                ]"
                class="border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"
            >
                {{ link.label }}
            </inertia-link>
        </div>
        <div class="-mt-px w-0 flex-1 flex justify-end pr-4">
            <inertia-link
                v-if="getNextPage.url !== null"
                :href="getNextPage.url"
                class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300"
            >
                {{ getNextPage.label }}
                <svg
                    class="ml-3 h-5 w-5 text-gray-400"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    aria-hidden="true"
                >
                    <path
                        fill-rule="evenodd"
                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
            </inertia-link>
            <div
                v-else
                class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-200 hidden md:block cursor-default"
            >
                <svg
                    class="ml-3 h-5 w-5 text-gray-200"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    aria-hidden="true"
                >
                    <path
                        fill-rule="evenodd"
                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'Pagination',

    props: {
        links: Array,
    },

    computed: {
        getNextPage() {
            return this.links[this.links.length - 1];
        },

        getPreviousPage() {
            return this.links[0];
        },
    },
};
</script>

<style scoped></style>
