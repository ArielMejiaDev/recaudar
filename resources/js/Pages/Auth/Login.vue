<template>

    <div class="flex max-w-sm mx-auto bg-white rounded-lg shadow-lg overflow-hidden lg:max-w-4xl">

        <div class="hidden lg:block lg:w-1/2 bg-cover" :style="{ backgroundImage: `url(${image})` }"></div>

        <form @submit.prevent="submit" class="w-full py-8 px-6 md:px-8 lg:w-1/2">

            <h2 class="text-2xl font-semibold text-gray-700 text-center">{{ $page.appName }}</h2>

            <p class="text-md text-gray-600 text-center">{{ trans.login }}</p>

            <div class="mt-4 flex items-center justify-between">
                <span class="border-b w-full"></span>
            </div>

            <div class="mt-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">{{ trans.email }}</label>
                <input id="email" name="email" v-model="form.email" class="bg-gray-200 text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full appearance-none focus:outline-none focus:bg-white" type="email">
                <p class="text-xs text-red-500 font-bold leading-loose tracking-tight" v-if="$page.errors.email">{{ $page.errors.email[0] }}</p>
            </div>

            <div class="mt-4">
                <div class="flex items-start justify-between">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">{{ trans.password }}</label>
                    <InertiaLink :href="route('password.request')" class="text-xs text-gray-500 hover:underline">{{ trans.forgot_password }}</InertiaLink>
                </div>
                <input id="password" name="password" v-model="form.password" class="bg-gray-200 text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full appearance-none focus:outline-none focus:bg-white" type="password">
                <p class="text-xs text-red-500 font-bold leading-loose tracking-tight" v-if="$page.errors.password">{{ $page.errors.password[0] }}</p>
            </div>

            <div class="mt-8">
                <button class="w-full bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded focus:outline-none focus:shadow-outline py-3">{{ trans.login }}</button>
            </div>

            <div class="mt-4 flex items-center justify-between">
                <span class="border-b w-1/5 md:w-1/4"></span>

                <InertiaLink :href="route('register')" class="text-xs text-gray-500 uppercase hover:underline">{{ trans.signup }}</InertiaLink>

                <span class="border-b w-1/5 md:w-1/4"></span>
            </div>

        </form>

    </div>

</template>

<script>
    import Auth from "../../Shared/Layouts/Auth";

    export default {
        metaInfo: { title: 'Login' },
        layout: Auth,
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                    remember: false,
                },
                image: 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=80',
            }
        },
        props: {
            trans: Object,
        },
        methods: {
            submit() {
                this.$page.errors = {}

                this.$inertia.post(
                    this.route('login'), { ...this.form }
                )

                this.form.password = ''
            }
        },
    }
</script>
