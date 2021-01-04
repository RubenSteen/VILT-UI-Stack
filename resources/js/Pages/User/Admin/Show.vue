<template>
    <layout :title="title">
        <div class="">

            <div class="flex-1 overflow-y-auto focus:outline-none" tabindex="0">
                <div class="relative max-w-4xl mx-auto md:px-8 xl:px-0">
                    <div class="pt-10 pb-16">
                        <div class="px-4 sm:px-6 md:px-0">
                            <h1 class="text-3xl font-extrabold text-gray-900">Account</h1>
                        </div>
                        <div class="px-4 sm:px-6 md:px-0">
                            <div class="py-6">

                                <!-- Description list with inline editing -->
                                <div class="mt-10 divide-y divide-gray-200">
                                    <div class="space-y-1">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                            Information
                                        </h3>
                                    </div>
                                    <div class="mt-6">
                                        <dl class="divide-y divide-gray-200">
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    Name
                                                </dt>
                                                <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    <span class="flex-grow">{{ user.username }}</span>
                                                </dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    Photo
                                                </dt>
                                                <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <span class="flex-grow">
                          <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </span>
                                                </dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:pt-5">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    Email
                                                </dt>
                                                <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    <span class="flex-grow">{{ user.email }} <br /> <small class="text-gray-500">{{ user.email_verified_at }}</small></span>
                                                </dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-b sm:border-gray-200">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    Created
                                                </dt>
                                                <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    <span class="flex-grow">{{ user.created_at }}</span>
                                                </dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-b sm:border-gray-200">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    Last update
                                                </dt>
                                                <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    <span class="flex-grow">{{ user.updated_at }}</span>
                                                </dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>

                                <div class="mt-10 divide-y divide-gray-200">
                                    <div class="space-y-1">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                            Actionsc
                                        </h3>
                                        <p class="max-w-2xl text-sm text-gray-500">
                                            Manage the users account.
                                        </p>
                                    </div>
                                    <div class="mt-6">
                                        <dl class="divide-y divide-gray-200">

                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                                <dt id="delete-option-label" class="text-sm font-medium text-gray-500">
                                                    Delete
                                                </dt>
                                                <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    <span class="flex-grow">{{ user.deleted_at }}</span>
                                                    <!-- On: "bg-purple-600", Off: "bg-gray-200" -->
                                                    <button v-if="user.id !== $page.props.auth.user.id" @click="deleteOrRestore" type="button" aria-pressed="true" aria-labelledby="delete-option-label" :class="[ user.deleted_at === null ? 'bg-gray-200' : 'bg-purple-600' ]" class="bg-gray-200 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-auto">
                                                        <span class="sr-only">Use setting</span>
                                                        <!-- On: "translate-x-5", Off: "translate-x-0" -->
                                                        <span aria-hidden="true" :class="[ user.deleted_at === null ? 'translate-x-0' : 'translate-x-5' ]" class="translate-x-0 inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                                    </button>
                                                </dd>
                                            </div>

                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </layout>
</template>

<script>
import Layout from '@/Layouts/DefaultLayout'

export default {
    name: "Show",

    components: {
        Layout,
    },

    props: {
        title: {
            type: String,
            default: 'Users'
        },
        user: Object,
    },

    methods: {
        deleteOrRestore() {
            if (this.user.deleted_at === null) {
                this.$inertia.delete(this.route('admin.user.delete', this.user.username))
            } else {
                this.$inertia.put(this.route('admin.user.restore', this.user.username))
            }
        },
    },
}
</script>

<style scoped>

</style>

