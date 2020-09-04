<template>
    <form class="max-w-lg bg-white rounded-lg shadow mx-auto p-8" @submit.prevent="submit">
        <h1 class="text-2xl font-bold mb-6">Verify Your Email Address</h1>

        <h3 class="text-gray-600 text-sm mb-10">
            Before proceeding, please check your email for a verification link. If you did not receive the email click the button below to request another.
        </h3>

        <button class="w-full bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded focus:outline-none focus:shadow-outline py-3">
            Resend Verification Email
        </button>
    </form>
</template>

<script>
    import Auth from "../../Shared/Layouts/Auth";

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

        methods: {
            submit() {
                this.$page.errors = {}

                this.$inertia.post(
                    this.$route('verification.resend'), { ...this.form }
                )

                this.form.password = ''
            }
        }
    }
</script>
