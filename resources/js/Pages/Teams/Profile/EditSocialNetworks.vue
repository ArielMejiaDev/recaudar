<template>

    <form @submit.prevent="submit">

        <Panel>
            <template v-slot:header>
                <Title>{{ trans.social_networks }}</Title>
            </template>

            <template v-slot:body>
                <Input v-model="form.facebook_account" name="facebook_account" :label="trans.facebook_account" :placeholder="trans.add_a_link" :errors="$page.errors.facebook_account" :required="false" />
                <Input v-model="form.twitter_account" name="twitter_account" :label="trans.twitter_account" :placeholder="trans.add_a_link" :errors="$page.errors.twitter_account" :required="false" />
                <Input v-model="form.instagram_account" name="instagram_account" :label="trans.instagram_account" :placeholder="trans.add_a_link" :errors="$page.errors.instagram_account" :required="false" />
            </template>

            <template v-slot:footer>
                <LoadingButton :loading="loading">
                    {{ $page.global_trans.update }} {{ trans.social_networks }}
                </LoadingButton>
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
                facebook_account: this.facebook_account,
                twitter_account: this.twitter_account,
                instagram_account: this.instagram_account,
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
        trans: Object,
    },
}
</script>
