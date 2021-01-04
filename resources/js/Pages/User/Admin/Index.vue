<template>
    <layout :title="title">
        <div class="">
            <div class="h-screen flex overflow-hidden bg-white">

                    <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
                        <!-- Page title & actions -->
                        <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
                            <div class="flex-1 min-w-0">
                                <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">
                                    {{ title }}
                                </h1>
                            </div>
                            <div class="mt-4 flex sm:mt-0 sm:ml-4">
                                <button type="button" class="order-0 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:order-1 sm:ml-3">
                                    Create
                                </button>
                            </div>
                        </div>

                        <search-top-of-page v-model="searchForm.search" :filters="filters" :aFilterIsActive="aFilterIsActive" @toggleFilterMenu="toggleFilterSidebar">
                            <filters :show-sidebar="showFilterSidebar" :filters="filters" @applyFilters="applyFilters" @reset="resetFilters" @toggleSidebar="toggleFilterSidebar">
                                <div class="px-4 divide-y divide-gray-200 sm:px-6">
                                    <div class="space-y-6 pt-6 pb-5">

<!--                                        <div>-->
<!--                                            <label for="email_verified" class="block text-sm font-medium text-gray-900">-->
<!--                                                Verified email-->
<!--                                            </label>-->
<!--                                            <div class="mt-1">-->
<!--                                                <button @click="filtersForm.email_verified = !filtersForm.email_verified" id="email_verified" type="button" aria-pressed="false" :class="{ 'bg-indigo-600 border-indigo-600 focus:ring-indigo-500': filtersForm.email_verified, 'bg-red-600 border-red-600 focus:ring-red-500': !filtersForm.email_verified,}" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2">-->
<!--                                                    <span class="sr-only">Use setting</span>-->
<!--                                                    <span :class="{ 'translate-x-5': filtersForm.email_verified, 'translate-x-0': !filtersForm.email_verified,}" class="translate-x-0 relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200">-->
<!--                                                                    <span :class="{ 'opacity-0 ease-out duration-100': filtersForm.email_verified, 'opacity-100 ease-in duration-200': !filtersForm.email_verified,}" class="opacity-100 ease-in duration-200 absolute inset-0 h-full w-full flex items-center justify-center transition-opacity" aria-hidden="true">-->
<!--                                                                        <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">-->
<!--                                                                            <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />-->
<!--                                                                        </svg>-->
<!--                                                                    </span>-->
<!--                                                                    <span class="opacity-0 ease-out duration-100 absolute inset-0 h-full w-full flex items-center justify-center transition-opacity" aria-hidden="true">-->
<!--                                                                        <svg class="h-3 w-3 text-indigo-600" fill="currentColor" viewBox="0 0 12 12">-->
<!--                                                                            <path d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z" />-->
<!--                                                                        </svg>-->
<!--                                                                    </span>-->
<!--                                                                </span>-->
<!--                                                </button>-->
<!--                                            </div>-->
<!--                                        </div>-->

                                        <div>
                                            <label for="verified_email" class="block text-sm font-medium text-gray-900">
                                                Verified email
                                            </label>
                                            <div class="mt-1">
                                                <select v-model="filtersForm.verified_email" id="trashed" name="trashed" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                    <option value="">Both</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="trashed" class="block text-sm font-medium text-gray-900">
                                                Trashed
                                            </label>
                                            <div class="mt-1">
                                                <select v-model="filtersForm.trashed" id="trashed" name="trashed" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                    <option value="">Without</option>
                                                    <option value="with">With</option>
                                                    <option value="only">Only</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </filters>
                        </search-top-of-page>

                        <!-- Pinned stats -->
                        <div class="px-4 mt-6 sm:px-6 lg:px-8">
                            <ul class="grid grid-cols-1 gap-4 sm:gap-6 sm:grid-cols-2 xl:grid-cols-4 mt-3">
                                <li class="relative col-span-1 flex shadow-sm rounded-md">
                                    <div class="flex-shrink-0 flex items-center justify-center w-16 bg-pink-600 text-white text-sm font-medium rounded-l-md">
                                        {{ stats.newUsersMonthly.amount }}
                                    </div>
                                    <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                                        <div class="flex-1 px-4 py-2 text-sm truncate">
                                            <a href="#" class="text-gray-900 font-medium hover:text-gray-600">
                                                New users <small class="text-gray-400">({{ stats.newUsersMonthly.month }})</small>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Projects list (only on smallest breakpoint) -->
                        <div class="mt-10 sm:hidden">
                            <div class="px-4 sm:px-6">
                                <h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">Admin / Username / Email</h2>
                            </div>
                            <ul class="mt-3 border-t border-gray-200 divide-y divide-gray-100">
                                <li v-for="(user, index) in users.data" :key="user.id">
                                    <inertia-link :href="route('admin.user.show', user.username)" class="group flex items-center justify-between px-4 py-4 hover:bg-gray-50 sm:px-6">
                                      <span class="flex items-center truncate space-x-3">
                                          <span :class="{
                                                        'bg-red-600': !user.isAdmin,
                                                        'bg-green-600': user.isAdmin,
                                                    }"
                                                class="w-2.5 h-2.5 flex-shrink-0 rounded-full" aria-hidden="true"></span>
                                        <span class="font-medium truncate text-sm leading-6">
                                          {{ user.username }}
                                          <span class="truncate font-normal text-gray-500">{{ user.email }}</span>
                                        </span>
                                      </span>
                                        <!-- Heroicon name: chevron-right -->
                                        <svg class="ml-4 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </inertia-link>
                                </li>

                                <!-- More project rows... -->
                            </ul>
                        </div>


                        <!-- Projects table (small breakpoint and up) -->
                        <div class="hidden mt-8 sm:block">
                            <div class="align-middle inline-block min-w-full border-b border-gray-200">
                                <table class="min-w-full">
                                    <thead>
                                    <tr class="border-t border-gray-200">
                                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Username
                                        </th>
                                        <th class="hidden md:table-cell px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th class="hidden md:table-cell px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Admin
                                        </th>
                                        <th class="pr-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-100">

                                    <tr v-if="users.data.length > 0" v-for="(user, index) in users.data" :key="user.id" class="hover:bg-gray-50 cursor-pointer">

                                        <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <div class="flex items-center space-x-3 lg:pl-2">
                                                {{ user.id }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-3 text-sm text-gray-500 font-medium">
                                            {{ user.username }}
                                        </td>
                                        <td class="hidden md:table-cell px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-left">
                                            <span>
                                            {{ user.email }} <br />
                                            <span class="text-gray-400 font-normal">{{ user.email_verified_at }}</span>
                                          </span>
                                        </td>
                                        <td class="hidden md:table-cell px-6 pl-10 py-3 whitespace-nowrap text-sm text-gray-500 text-left">
                                            <span class="flex items-center truncate space-x-3">
                                            <span :class="{
                                                        'bg-red-600': !user.isAdmin,
                                                        'bg-green-600': user.isAdmin,
                                                    }"
                                                  class="w-2.5 h-2.5 flex-shrink-0 rounded-full" aria-hidden="true"></span>
                                          </span>
                                        </td>
                                        <td class="pr-6">
                                            <div class="relative flex justify-end items-center">
                                                <inertia-link :href="route('admin.user.show', user.username)" id="project-options-menu-0" aria-haspopup="true" type="button" class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
<!--                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">-->
<!--                                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />-->
<!--                                                    </svg>-->
                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                    </svg>
                                                </inertia-link>
                                            </div>
                                        </td>

                                    </tr>

                                    </tbody>
                                </table>

                                <div v-if="users.data.length === 0" class="sm:rounded-lg text-center py-4">
                                    <div class="px-4 py-5 sm:p-6">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                            No results...
                                        </h3>
                                        <div class="mt-2 text-sm text-gray-500">
                                            <p>
                                                Check if you have any filters active...
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <pagination :links="users.links" :class="{'mb-8': users.links.length > 3}"/>

                    </main>
                </div>
            </div>

        </div>
    </layout>
</template>

<script>
import Layout from '@/Layouts/DefaultLayout'
import Pagination from '@/Shared/Pagination'
import SearchTopOfPage from '@/Shared/SearchTopOfPage'
import Filters from '@/Shared/Filters'

import mapValues from 'lodash/mapValues'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'

export default {
    name: "Index",

    components: {
        Layout,
        Pagination,
        SearchTopOfPage,
        Filters
    },

    props: {
        title: {
            type: String,
            default: 'Users'
        },
        stats: Object,
        users: Object,
        search: String,
        filters: Object,
    },

    data() {
        return {
            showFilterSidebar: false,
            aFilterIsActive: false,
            searchForm: {
                search: this.search,
            },
            filtersForm: {
                trashed: this.filters.trashed,
                verified_email: this.filters.verified_email,
            },
        }
    },

    watch: {
        searchForm: {
            handler: throttle(function() {
                this.submitSearchAndFilters();
            }, 150),
            deep: true,
        },
    },

    methods: {
        isFilterActive() {
            let query = pickBy(this.filtersForm);

            if (Object.keys(query).length > 0) {
                return this.aFilterIsActive = true;
            }

            return this.aFilterIsActive = false;
        },

        resetFilters() {
            this.filtersForm = mapValues(this.filtersForm, () => null)
            this.submitSearchAndFilters();
        },

        applyFilters() {
            this.submitSearchAndFilters();
            this.isFilterActive();
        },

        toggleFilterSidebar() {
            this.showFilterSidebar = !this.showFilterSidebar;
        },

        submitSearchAndFilters() {
            let query = pickBy({ ...this.searchForm, ...this.filtersForm});
            this.$inertia.get(this.route('admin.user.index'), query, { preserveState: true });
        },
    },

    mounted() {
        this.isFilterActive();
    },
}
</script>

<style scoped>

</style>

