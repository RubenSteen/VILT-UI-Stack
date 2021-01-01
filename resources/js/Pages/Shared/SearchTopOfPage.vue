<template>
    <div class="relative z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200">
        <div v-show="filters !== null" class="flex">
            <button
                @click="$emit('toggleFilterMenu')"
                type="button"
                :class="{ 'ring-2 ring-indigo-500': aFilterIsActive, 'ring-2 ring-indigo-300': aFilterIsActive }"
                class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none ring-inset"
            >
                <span class="sr-only">Open filters</span>
                <svg
                    :class="{ 'animate-bounce': aFilterIsActive }"
                    class="h-6 w-6 text-indigo-500 transform hover:scale-125 hover:text-indigo-600 duration-150 ease-in-out"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"
                    />
                </svg>
            </button>
        </div>

        <div class="flex-1 px-4 flex justify-between">
            <div class="flex-1 flex">
                <form class="w-full flex lg:ml-0" action="#" method="GET">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                            <svg
                                class="h-5 w-5"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </div>
                        <input
                            :value="value"
                            @input="$emit('input', $event.target.value)"
                            autocomplete="off"
                            id="search"
                            class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-transparent sm:text-sm"
                            placeholder="Search"
                            type="search"
                            name="search"
                        />
                    </div>
                </form>
            </div>
        </div>

        <slot />
    </div>
</template>

<script>
export default {
    name: 'SearchTopOfPage',

    props: {
        value: String,
        filters: {
            type: Object,
            default: null,
        },
        aFilterIsActive: {
            type: Boolean,
            default: false,
        },
    },
};
</script>

<style scoped></style>
