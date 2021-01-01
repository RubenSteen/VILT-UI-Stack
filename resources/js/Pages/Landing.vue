<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <img class="block lg:hidden h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
                            <img class="hidden lg:block h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg" alt="Workflow">
                        </div>
                        <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                            <!-- Current: "border-indigo-500 text-gray-900", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                            <inertia-link class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" href="#">Landing</inertia-link>

                            <inertia-link v-if="$page.props.auth.user && $page.props.auth.user.isAdmin" :href="route('admin.user.index')" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Users</inertia-link>
                        </div>
                    </div>
                    <div class="sm:ml-6 sm:flex sm:items-center">
                        <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                            <inertia-link class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" v-if="! $page.props.auth.user" :href="route('register')">Register</inertia-link>
                            <inertia-link class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" v-if="! $page.props.auth.user" :href="route('login')">Login</inertia-link>

                            <inertia-link class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" v-if="$page.props.auth.user" :href="route('logout')" method="post">Logout</inertia-link>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="py-10">
            <header>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold leading-tight text-gray-900">
                        {{ $page.props.app.name }}
                    </h1>
                </div>
            </header>
            <main>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                    <div class="px-4 py-8 sm:px-0">
                        <!-- Begin feature section -->
                        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
                            <div class="max-w-3xl mx-auto text-center">
                                <h2 class="text-3xl font-extrabold text-gray-900">What does it already have...</h2>
                                <p class="mt-4 text-lg text-gray-500">Ac euismod vel sit maecenas id pellentesque eu sed consectetur. Malesuada adipiscing sagittis vel nulla nec.</p>
                            </div>
                            <dl class="mt-12 space-y-10 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 lg:grid-cols-4 lg:gap-x-8">
                                <div class="flex">
                                    <svg class="flex-shrink-0 h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <div class="ml-3">
                                        <dt class="text-lg leading-6 font-medium text-gray-900">
                                            Invite team members
                                        </dt>
                                        <dd class="mt-2 text-base text-gray-500">
                                            Tempor tellus in aliquet eu et sit nulla tellus. Suspendisse est, molestie blandit quis ac. Lacus.
                                        </dd>
                                    </div>
                                </div>

                                <div class="flex">
                                    <svg class="flex-shrink-0 h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <div class="ml-3">
                                        <dt class="text-lg leading-6 font-medium text-gray-900">
                                            Notifications
                                        </dt>
                                        <dd class="mt-2 text-base text-gray-500">
                                            Ornare donec rhoncus vitae nisl velit, neque, mauris dictum duis. Nibh urna non parturient.
                                        </dd>
                                    </div>
                                </div>

                                <div class="flex">
                                    <svg class="flex-shrink-0 h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <div class="ml-3">
                                        <dt class="text-lg leading-6 font-medium text-gray-900">
                                            List view
                                        </dt>
                                        <dd class="mt-2 text-base text-gray-500">
                                            Etiam cras augue ornare pretium sit malesuada morbi orci, venenatis. Dictum lacus.
                                        </dd>
                                    </div>
                                </div>

                                <div class="flex">
                                    <svg class="flex-shrink-0 h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <div class="ml-3">
                                        <dt class="text-lg leading-6 font-medium text-gray-900">
                                            Boards
                                        </dt>
                                        <dd class="mt-2 text-base text-gray-500">
                                            Interdum quam pulvinar turpis tortor, egestas quis diam amet, natoque. Mauris sagittis.
                                        </dd>
                                    </div>
                                </div>

                                <div class="flex">
                                    <svg class="flex-shrink-0 h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <div class="ml-3">
                                        <dt class="text-lg leading-6 font-medium text-gray-900">
                                            Keyboard shortcuts
                                        </dt>
                                        <dd class="mt-2 text-base text-gray-500">
                                            Ullamcorper in ipsum ac feugiat. Senectus at aliquam vulputate mollis nec. In at risus odio.
                                        </dd>
                                    </div>
                                </div>

                                <div class="flex">
                                    <svg class="flex-shrink-0 h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <div class="ml-3">
                                        <dt class="text-lg leading-6 font-medium text-gray-900">
                                            Reporting
                                        </dt>
                                        <dd class="mt-2 text-base text-gray-500">
                                            Magna a vel sagittis aliquam eu amet. Et lorem auctor quam nunc odio. Sed bibendum.
                                        </dd>
                                    </div>
                                </div>

                                <div class="flex">
                                    <svg class="flex-shrink-0 h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <div class="ml-3">
                                        <dt class="text-lg leading-6 font-medium text-gray-900">
                                            Calendars
                                        </dt>
                                        <dd class="mt-2 text-base text-gray-500">
                                            Sed mi, dapibus turpis orci posuere integer. A porta viverra posuere adipiscing turpis.
                                        </dd>
                                    </div>
                                </div>

                                <div class="flex">
                                    <svg class="flex-shrink-0 h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <div class="ml-3">
                                        <dt class="text-lg leading-6 font-medium text-gray-900">
                                            Mobile app
                                        </dt>
                                        <dd class="mt-2 text-base text-gray-500">
                                            Quisque sapien nunc nisl eros. Facilisis sagittis maecenas id dignissim tristique proin sed.
                                        </dd>
                                    </div>
                                </div>
                            </dl>
                        </div>
                        <!-- /End feature section -->
                    </div>

                </div>
            </main>
        </div>
    </div>

</template>

<script>
export default {
    name: "Landing",
}
</script>

<style scoped>

</style>
