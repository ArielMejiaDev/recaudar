<template>
    <form @submit.prevent="submit">
        <Panel>
            <template v-slot:header>
                <Title info="This is the logo for the team profile page.">Logo</Title>
            </template>

            <template v-slot:body>
                <div class="w-full lg:w-8/12 xl:w-6/12">
                    <ImageUploader :current-file="banner" v-model="form.banner" name="banner" label="Banner" :errors="$page.errors.banner" />
                </div>
            </template>

            <template v-slot:footer>
                <LoadingButton :loading="loading">Upload logo</LoadingButton>
            </template>
        </Panel>
    </form>
</template>

<script>
import Panel from "../../../Shared/Panel";
import Title from "../../../Shared/Title";
import AvatarUploader from "../../../Shared/AvatarUploader";
import LoadingButton from "../../../Shared/LoadingButton";
import ImageUploader from "../../../Shared/ImageUploader";

export default {
    name: "EditBanner",
    data() {
        return {
            loading: false,
            form: {
                banner: null,
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
    },
    created() {
        this.form.banner = this.banner;
    }
}
</script>

