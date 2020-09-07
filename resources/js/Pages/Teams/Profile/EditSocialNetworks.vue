<template>

    <form @submit.prevent="submit">

        <Panel>
            <template v-slot:header>
                <Title>Social Networks</Title>
            </template>

            <template v-slot:body>
                <Input v-model="form.facebook_account" name="facebook_account" label="Facebook link account" :errors="$page.errors.facebook_account" :required="false" />
                <Input v-model="form.twitter_account" name="twitter_account" label="Twitter link account" :errors="$page.errors.twitter_account" :required="false" />
                <Input v-model="form.instagram_account" name="instagram_account" label="Instagram link account" :errors="$page.errors.instagram_account" :required="false" />
            </template>

            <template v-slot:footer>
                <LoadingButton :loading="loading">Update Social networks.</LoadingButton>
            </template>

        </Panel>

    </form>

</template>

<script>
import Panel from "../../../Shared/Panel";
import Title from "../../../Shared/Title";
import Input from "../../../Shared/Input";
import LoadingButton from "../../../Shared/LoadingButton";

export default {
    name: "EditSocialNetworks",
    data() {
        return {
            form: {
                facebook_account: null,
                twitter_account: null,
                instagram_account: null,
            },
            loading: false,
        }
    },
    components: {
        Panel,
        Title,
        Input,
        LoadingButton,
    },
    methods: {
        submit() {
            this.loading = true;
            const route = this.route('teams.profile.update_social_networks', {team: this.$page.team['slug']});
            this.$inertia.put(route, this.form).then(() => this.loading = false);
        },
    },
    props: {
        facebook_account: String,
        twitter_account: String,
        instagram_account: String,
    },
    created() {
        this.form.facebook_account = this.facebook_account;
        this.form.twitter_account = this.twitter_account;
        this.form.instagram_account = this.instagram_account;
    }
}
</script>
