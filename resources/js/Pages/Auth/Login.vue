<template>
    <layout :title="title">
        <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <img
                        class="mx-auto h-12 w-auto"
                        src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                        alt="Workflow"
                    />
                    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
                    <p class="mt-2 text-center text-sm text-gray-600">
                        Or
                        <inertia-link
                            :href="route('register')"
                            class="font-medium text-indigo-600 hover:text-indigo-500"
                        >
                            sign up
                        </inertia-link>
                    </p>
                </div>
                <form class="mt-8 space-y-6" @submit.prevent="submit">
                    <div class="rounded-md bg-red-50 p-4" v-if="Object.keys($page.props.errors).length > 0">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg
                                    class="h-5 w-5 text-red-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Something went wrong...</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        <li v-for="(error, index) in $page.props.errors">
                                            {{ error }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="remember" value="true" />

                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="email-address" class="sr-only">Email address</label>
                            <input
                                v-model="form.email"
                                id="email-address"
                                name="email"
                                type="email"
                                autocomplete="email"
                                required
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Email address"
                            />
                        </div>
                        <div>
                            <label for="password" class="sr-only">Password</label>
                            <input
                                v-model="form.password"
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                required
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Password"
                            />
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input
                                v-model="form.remember"
                                id="remember_me"
                                name="remember_me"
                                type="checkbox"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                            />
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
                        </div>

                        <div class="text-sm">
                            <inertia-link
                                :href="route('password.request')"
                                class="font-medium text-indigo-600 hover:text-indigo-500"
                            >
                                Forgot your password?
                            </inertia-link>
                        </div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg
                                    class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </span>
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </layout>
</template>

<script>
import Layout from '@/Layouts/DefaultLayout';

export default {
    name: 'Login',

    components: {
        Layout,
    },

    props: {
        title: {
            type: String,
            default: 'Login',
        },
    },

    remember: 'form',

    data() {
        return {
            sending: false,
            form: {
                email: null,
                password: null,
                remember: false,
            },
        };
    },

    methods: {
        submit() {
            this.$inertia.post(this.route('login'), this.form, {
                onStart: () => (this.sending = true),
                onFinish: () => {
                    this.resetForm();
                    this.sending = false;
                },
            });
        },

        resetForm() {
            this.form.password = null;
        },
    },

    mounted() {
        this.resetForm();
    },
};
</script>

<style scoped></style>
