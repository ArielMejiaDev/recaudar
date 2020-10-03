<template>
    <form @submit.prevent="submit">
        <Panel>
            <template v-slot:header>
                <Title :info="trans.this_is_the_banner_for_the_profile_page">Banner</Title>
            </template>

            <template v-slot:body>
                <div class="w-full lg:w-8/12 xl:w-6/12">
                    <ImageUploader :current-file="banner" v-model="form.banner" name="banner" label="Banner" :errors="$page.errors.banner" />
                </div>
            </template>

            <template v-slot:footer>
                <LoadingButton :loading="loading">
                    {{ $page.global_trans.update }} Banner
                </LoadingButton>
            </template>
        </Panel>
    </form>
</template>

<script>
import Panel from "../../../Shared/Panel";
import Title from "../../../Shared/Title";
import LoadingButton from "../../../Shared/LoadingButton";
import ImageUploader from "../../../Shared/ImageUploader";

export default {
    name: "EditBanner",
    data() {
        return {
            loading: false,
            form: {
                banner: this.banner,
            }
        }
    },
    components: {
        Panel,
        Title,
        ImageUploader,
        LoadingButton,
    },
    methods: {
        submit() {
            this.loading = true;
            const form = new FormData();
            form.append('banner', this.form.banner);
            form.append('_method', 'put');
            const route = this.route('teams.profile.update_banner', { team: this.$page.team['slug']});
            this.$inertia.post(route, form)
                .then(() => this.loading = false)
        }
    },
    props: {
        banner: String,
        trans: Object,
    },
}
</script>

