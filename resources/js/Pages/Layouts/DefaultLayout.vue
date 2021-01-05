<template>
    <master-layout :title="title">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="h-screen flex overflow-hidden bg-gray-100">
            <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
            <div class="md:hidden">
                <div :class="{ 'pointer-events-none': !showSidebar }" class="fixed inset-0 flex z-40">
                    <transition
                        enter-active-class="transition-opacity ease-linear duration-300"
                        enter-class="opacity-0"
                        enter-to-class="opacity-100"
                        leave-active-class="transition-opacity ease-linear duration-300"
                        leave-class="opacity-100"
                        leave-to-class="opacity-0"
                    >
                        <div v-show="showSidebar" @click="showSidebar = false" class="fixed inset-0" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
                        </div>
                    </transition>

                    <transition
                        enter-active-class="transition ease-in-out duration-300 transform"
                        enter-class="-translate-x-full"
                        enter-to-class="translate-x-0"
                        leave-active-class="transition ease-in-out duration-300 transform"
                        leave-class="translate-x-0"
                        leave-to-class="-translate-x-full"
                    >
                        <div
                            v-show="showSidebar"
                            class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white"
                        >
                            <div class="absolute top-0 right-0 -mr-12 pt-2">
                                <button
                                    @click="showSidebar = false"
                                    class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                >
                                    <span class="sr-only">Close sidebar</span>
                                    <!-- Heroicon name: x -->
                                    <svg
                                        class="h-6 w-6 text-white"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex-shrink-0 flex items-center px-4">
                                <inertia-link href="/">
                                    <img
                                        class="h-8 w-auto"
                                        src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg"
                                        alt="Workflow"
                                    />
                                </inertia-link>
                            </div>
                            <div class="mt-5 flex-1 h-0 overflow-y-auto">
                                <nav class="px-2 space-y-1">
                                    <!-- Current: "bg-gray-100 text-gray-900", Default: "text-gray-600 hover:bg-gray-50 hover:text-gray-900" -->
                                    <inertia-link
                                        :href="route('admin.user.index')"
                                        class="bg-gray-100 text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md"
                                    >
                                        <!-- Current: "text-gray-500", Default: "text-gray-400 group-hover:text-gray-500" -->
                                        <!-- Heroicon name: home -->
                                        <svg
                                            class="text-gray-400 group-hover:text-gray-500 mr-4 h-6 w-6"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                            />
                                        </svg>
                                        Users
                                    </inertia-link>

                                    <inertia-link
                                        href="#"
                                        class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md"
                                    >
                                        <!-- Heroicon name: folder -->
                                        <svg
                                            class="text-gray-400 group-hover:text-gray-500 mr-4 h-6 w-6"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"
                                            />
                                        </svg>
                                        Projects
                                    </inertia-link>
                                </nav>
                            </div>
                            <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                                <div class="flex-shrink-0 w-full group block">
                                    <div v-if="$page.props.auth.user !== null" class="flex items-center">
                                        <div>
                                            <img
                                                class="inline-block h-10 w-10 rounded-full"
                                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                alt=""
                                            />
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-base font-medium text-gray-700 group-hover:text-gray-900">
                                                {{ $page.props.auth.user.username }}
                                            </p>
                                            <inertia-link
                                                :href="route('profile.edit')"
                                                class="text-sm font-medium text-gray-500 group-hover:text-gray-700"
                                            >
                                                View profile
                                            </inertia-link>
                                        </div>
                                        <div @click="logout()" class="cursor-pointer ml-auto">
                                            <svg
                                                class="text-red-500 h-6 w-6"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                                />
                                            </svg>
                                        </div>
                                    </div>
                                    <inertia-link v-else :href="route('login')" class="flex items-center">
                                        <svg
                                            class="text-gray-600 group-hover:text-gray-900 h-6 w-6"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                                            />
                                        </svg>
                                        <div class="ml-2">
                                            <p class="text-base font-medium text-gray-700 group-hover:text-gray-900">
                                                Login
                                            </p>
                                        </div>
                                    </inertia-link>
                                </div>
                            </div>
                        </div>
                    </transition>

                    <div class="flex-shrink-0 w-14" aria-hidden="true">
                        <!-- Dummy element to force sidebar to shrink to fit close icon -->
                    </div>
                </div>
            </div>

            <!-- Static sidebar for desktop -->
            <div class="hidden md:flex md:flex-shrink-0">
                <div class="flex flex-col w-64">
                    <!-- Sidebar component, swap this element with another sidebar if you like -->
                    <div class="flex flex-col h-0 flex-1 border-r border-gray-200 bg-white">
                        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                            <div class="flex items-center flex-shrink-0 px-4">
                                <inertia-link href="/">
                                    <img
                                        class="h-8 w-auto"
                                        src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg"
                                        alt="Workflow"
                                    />
                                </inertia-link>
                            </div>
                            <nav class="mt-5 flex-1 px-2 bg-white space-y-1">
                                <inertia-link
                                    :href="route('admin.user.index')"
                                    class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md"
                                >
                                    <svg
                                        class="text-gray-400 group-hover:text-gray-500 mr-3 h-6 w-6"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                        />
                                    </svg>
                                    Users
                                </inertia-link>
                            </nav>
                        </div>
                        <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                            <div class="flex-shrink-0 w-full group block">
                                <div v-if="$page.props.auth.user !== null" class="flex items-center">
                                    <div>
                                        <img
                                            class="inline-block h-9 w-9 rounded-full"
                                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt=""
                                        />
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">
                                            {{ $page.props.auth.user.username }}
                                        </p>
                                        <inertia-link
                                            :href="route('profile.edit')"
                                            class="text-xs font-medium text-gray-500 group-hover:text-gray-700"
                                        >
                                            View profile
                                        </inertia-link>
                                    </div>
                                    <div @click="logout()" class="cursor-pointer ml-auto">
                                        <svg
                                            class="text-red-500 h-6 w-6"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                            />
                                        </svg>
                                    </div>
                                </div>
                                <inertia-link v-else :href="route('login')" class="flex items-center">
                                    <svg
                                        class="text-gray-600 group-hover:text-gray-900 h-6 w-6"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                                        />
                                    </svg>
                                    <div class="ml-2">
                                        <p class="text-base font-medium text-gray-700 group-hover:text-gray-900">
                                            Login
                                        </p>
                                    </div>
                                </inertia-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
                    <button
                        @click="showSidebar = true"
                        class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    >
                        <span class="sr-only">Open sidebar</span>
                        <!-- Heroicon name: menu -->
                        <svg
                            class="h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>
                    </button>
                </div>
                <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
                    <!-- Pages -->
                    <slot />
                </main>
            </div>
        </div>
    </master-layout>
</template>

<script>
import MasterLayout from '@/Layouts/MasterLayout';

export default {
    name: 'DefaultLayout',

    components: {
        MasterLayout,
    },

    props: {
        title: String,
    },

    data() {
        return {
            showSidebar: false,
        };
    },

    methods: {
        logout() {
            if (confirm('Are you sure you want to logout?')) {
                this.$inertia.post(this.route('logout'));
            }
        },
    },
};
</script>

<style scoped></style>
