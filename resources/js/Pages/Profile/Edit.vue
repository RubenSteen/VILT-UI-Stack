<template>
    <layout :title="title">
        <div class="p-4">
            <form class="space-y-8 divide-y divide-gray-200" @submit.prevent="submit">
                <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                    <div>
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Profile</h3>
                        </div>

                        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                            <div
                                class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
                            >
                                <label for="username" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Username
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input
                                        v-model="username"
                                        disabled
                                        type="text"
                                        name="username"
                                        id="username"
                                        class="opacity-60 max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
                                    />
                                </div>
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
                            >
                                <label for="email" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Email
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input
                                        v-model="email"
                                        disabled
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="opacity-60 max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
                                    />
                                </div>
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
                            >
                                <label for="password" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Change password
                                </label>
                                <div>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2 mb-2">
                                        <input
                                            v-model="form.password"
                                            type="password"
                                            name="password"
                                            id="password"
                                            v-bind:class="{ 'border border-red-500': $page.props.errors.password }"
                                            class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
                                        />
                                    </div>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input
                                            v-model="form.password_confirmation"
                                            type="password"
                                            name="password_confirmation"
                                            id="password_confirmation"
                                            v-bind:class="{ 'border border-red-500': $page.props.errors.password }"
                                            class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
                                        />
                                    </div>
                                    <p class="mt-2 text-sm text-red-600" id="password-error">
                                        {{ $page.props.errors.password }}
                                    </p>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        Keep this empty if you do <b>not</b> want to change your password...
                                    </p>
                                </div>
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:border-t sm:border-gray-200 sm:pt-5"
                            >
                                <label for="photo" class="block text-sm font-medium text-gray-700"> Photo </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <div class="flex items-center">
                                        <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                            <svg
                                                class="h-full w-full text-gray-300"
                                                fill="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"
                                                />
                                            </svg>
                                        </span>
                                        <button
                                            type="button"
                                            class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        >
                                            Change
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-5">
                    <div class="flex justify-end sm:justify-center">
                        <button
                            type="submit"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </layout>
</template>

<script>
import Layout from '@/Layouts/DefaultLayout';

export default {
    name: 'Profile',

    components: {
        Layout,
    },

    props: {
        title: {
            type: String,
            default: 'Profile',
        },
        username: String,
        email: String,
    },

    remember: 'form',

    data() {
        return {
            sending: false,
            form: {
                password: null,
                password_confirmation: null,
            },
        };
    },

    methods: {
        submit() {
            const data = new FormData();
            this.$inertia.patch(this.route('profile.update'), this.form, {
                onStart: () => (this.sending = true),
                onFinish: () => {
                    this.resetForm();
                    this.sending = false;
                },
            });
        },

        resetForm() {
            this.form.password = null;
            this.form.password_confirmation = null;
        },
    },

    mounted() {
        this.resetForm();
    },
};
</script>

<style scoped></style>
