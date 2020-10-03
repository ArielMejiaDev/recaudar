<template>
    <form class="max-w-lg bg-white rounded-lg shadow overflow-hidden mx-auto p-8" @submit.prevent="submit">
        <h3 v-if="success" class="rounded bg-green-100 text-green-800 text-sm px-4 py-3 mb-6">
            {{ trans.we_have_emailed_your_password_reset_link }}
        </h3>

        <h1 class="text-2xl font-bold">{{ trans.reset_password }}</h1>

        <h3 class="text-gray-600 text-sm mb-6">
            {{ trans.remembered_your_password }}
            <inertia-link :href="route('login')" class="text-gray-700 text-sm font-semibold ml-2">{{ trans.login }}</inertia-link>
        </h3>

        <form-input class="mb-8"
                :label="trans.email"
                :placeholder="trans.your_email_address"
                v-model="form.email"
                :errors="$page.errors.email"
                required
                autofocus
                autocomplete="email" />

        <button class="w-full bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded focus:outline-none focus:shadow-outline py-3">
            {{ trans.email_password_reset_link }}
        </button>
    </form>
</template>

<script>

    import Auth from "../../../Shared/Layouts/Auth";

    export default {
        layout: Auth,

        data() {
            return {
                form: {
                    email: '',
                },
                success: false,
            }
        },

        props: {
            trans: Object,
        },

        methods: {
            async submit() {
                this.success = false
                this.$page.errors = {}

                await this.$inertia.post(
                    this.route('password.email'), { ...this.form }
                )

                if (!this.$page.errors.email) {
                    this.form = {}
                    this.success = true
                }
            },
        }
    }
</script>
