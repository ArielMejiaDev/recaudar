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
                <input autocomplete="off" tabindex="1" id="email" name="email" v-model="form.email" class="bg-gray-200 text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full appearance-none focus:outline-none focus:bg-white" type="email">
                <p class="text-xs text-red-500 font-bold leading-loose tracking-tight" v-if="$page.errors.email">{{ $page.errors.email[0] }}</p>
            </div>

            <div class="mt-4">
                <div class="flex items-start justify-between">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">{{ trans.password }}</label>
                    <InertiaLink :href="route('password.request')" class="text-xs text-gray-500 hover:underline">{{ trans.forgot_password }}</InertiaLink>
                </div>
                <input autocomplete="off" tabindex="2" id="password" name="password" v-model="form.password" class="bg-gray-200 text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full appearance-none focus:outline-none focus:bg-white" type="password">
                <p class="text-xs text-red-500 font-bold leading-loose tracking-tight" v-if="$page.errors.password">{{ $page.errors.password[0] }}</p>
            </div>

            <div class="mt-8">
                <vue-recaptcha ref="invisibleRecaptcha" @verify="onVerify" @error="onError"  @expired="onExpired" :sitekey="sitekey">
                    <button tabindex="3" class="w-full bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded focus:outline-none focus:shadow-outline py-3">{{ trans.login }}</button>
                </vue-recaptcha>
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
                image: 'images/auth/login.jpeg',
            }
        },
        components : {
            VueRecaptcha,
        },
        props: {
            trans: Object,
            sitekey: String,
        },
        methods: {
            submit() {
                this.$page.errors = {}

                this.$inertia.post(
                    this.route('login'), { ...this.form }
                )

                this.form.password = ''
            },
            onVerify() {
                console.log('verify');
                this.submit();
                this.$refs.invisibleRecaptcha.reset()
            },
            onError() {
                console.log('error');
            },
            onExpired() {
                console.log('expired');
            },
        },
    }
</script>
