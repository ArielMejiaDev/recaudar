<template>
    <form class="max-w-lg bg-white rounded-lg shadow mx-auto p-8" @submit.prevent="submit">
        <h1 class="text-2xl font-bold mb-6">Reset Password</h1>

        <form-input class="mb-6"
                label="Email"
                placeholder="Your Email Address"
                v-model="form.email"
                :errors="$page.errors.email"
                required
                autocomplete="email" />

        <form-input class="mb-6"
                label="Password"
                placeholder="Your Password"
                type="password"
                v-model="form.password"
                :errors="$page.errors.password"
                autocomplete="new-password"
                autofocus
                required />

        <form-input class="mb-8"
                label="Confirm Password"
                placeholder="Confirm Your Password"
                type="password"
                v-model="form.password_confirmation"
                :errors="$page.errors.password_confirmation"
                autocomplete="new-password"
                required />

        <button class="w-full bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded focus:outline-none focus:shadow-outline py-3">
            Reset Password
        </button>
    </form>
</template>

<script>

    import Auth from "../../../Shared/Layouts/Auth";

    export default {
        layout: Auth,

        props: {
            email: String,
            token: String,
        },

        data() {
            return {
                form: {
                    token: this.token,
                    email: this.email,
                    password: '',
                    password_confirmation: '',
                },
            }
        },

        methods: {
            submit() {
                this.$page.errors = {}

                this.$inertia.post(
                    this.route('password.update'), { ...this.form }
                )

                this.form.password = ''
                this.form.password_confirmation = ''
            },
        }
    }
</script>
