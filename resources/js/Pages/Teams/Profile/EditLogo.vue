<template>
    <form @submit.prevent="submit">
        <Panel>
            <template v-slot:header>
                <Title :info="trans.this_is_the_logo_for_the_profile_page">Logo</Title>
            </template>

            <template v-slot:body>
                <AvatarUploader :current-file="logo" v-model="form.logo" name="logo" label="Logo" :options="{showButton: true, buttonText: trans.upload}" :errors="$page.errors.logo" />
            </template>

            <template v-slot:footer>
                <LoadingButton :loading="loading">
                    {{ $page.global_trans.update }} Logo
                </LoadingButton>
            </template>
        </Panel>
    </form>
</template>

<script>
import Panel from "../../../Shared/Panel";
import Title from "../../../Shared/Title";
import AvatarUploader from "../../../Shared/AvatarUploader";
import LoadingButton from "../../../Shared/LoadingButton";

export default {
    name: "EditLogo",
    data() {
        return {
            loading: false,
            form: {
                logo: this.logo,
            }
        }
    },
    components: {
        Panel,
        Title,
        AvatarUploader,
        LoadingButton,
    },
    methods: {
        submit() {
            this.loading = true;
            const form = new FormData();
            form.append('logo', this.form.logo);
            form.append('_method', 'put');
            const route = this.route('teams.profile.update_logo', { team: this.$page.team['slug'] });
            this.$inertia.post(route, form)
                .then(() => this.loading = false)
        }
    },
    props: {
        logo: String,
        trans: Object,
    },
}
</script>

