<template>
    <form class="max-w-lg bg-white rounded-lg shadow mx-auto p-8" @submit.prevent="submit">
        <h1 class="text-2xl font-bold mb-6">{{ trans.reset_password }}</h1>

        <form-input class="mb-6"
                :label="trans.email"
                :placeholder="trans.your_email_address"
                v-model="form.email"
                :errors="$page.errors.email"
                required
                autocomplete="email" />

        <form-input class="mb-6"
                :label="trans.password"
                :placeholder="trans.your_password"
                type="password"
                v-model="form.password"
                :errors="$page.errors.password"
                autocomplete="new-password"
                autofocus
                required />

        <form-input class="mb-8"
                :label="trans.confirm_password"
                :placeholder="trans.confirm_your_password"
                type="password"
                v-model="form.password_confirmation"
                :errors="$page.errors.password_confirmation"
                autocomplete="new-password"
                required />

        <button class="w-full bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded focus:outline-none focus:shadow-outline py-3">
            {{ trans.reset_password }}
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
            trans: Object,
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
