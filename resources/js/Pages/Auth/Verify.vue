<template>
    <form class="max-w-lg bg-white rounded-lg shadow mx-auto p-8" @submit.prevent="submit">
        <h1 class="text-2xl font-bold mb-6">{{ trans.verify_your_email_address }}</h1>

        <h3 class="text-gray-600 text-sm mb-2 mb-10">
            {{ trans.please_click_the_button_below_to_verify_your_email_address }}
        </h3>
        <button class="w-full bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded focus:outline-none focus:shadow-outline py-3">
            {{ trans.resend_verification_email }}
        </button>
        <p class="mt-4 text-gray-600 text-xs">Si deseas loguearte como otro usuario puedes
            <button @click="logout" class="outline-none underline font-semibold">cerrar sesion y volver a loguearte</button>
        </p>
    </form>
</template>

<script>
    import Auth from "../../Shared/Layouts/Auth";
    import axios from "axios";

    export default {
        layout: Auth,

        data() {
            return {
                form: {
                    email: '',
                    password: '',
                    remember: false,
                }
            }
        },

        props: {
            trans: Object,
        },

        methods: {
            submit() {
                this.$page.errors = {}

                this.$inertia.post(
                    this.route('verification.resend'), { ...this.form }
                )

                this.form.password = ''
            },
            logout() {
                axios.post(this.route('logout').url(), {}).finally(() => window.location.href = '/');
            }
        }
    }
</script>
