<template>

    <form @submit.prevent="submit">

        <Panel>
            <template v-slot:header>
                <Title>Promotional video</Title>
            </template>

            <template v-slot:body>
                <Input v-model="form.promotional_video" name="promotional_video" :errors="$page.errors.promotional_video" :required="false" placeholder="Add the video url" />
            </template>

            <template v-slot:footer>
                <LoadingButton :loading="loading">Update promotional video.</LoadingButton>
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
    name: "EditPromotionalVideo",
    data() {
        return {
            form: {
                promotional_video: this.promotional_video,
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
            const route = this.route('teams.profile.update_promotional_video', {team: this.$page.team['slug']});
            this.$inertia.put(route, this.form).then(() => this.loading = false);
        },
    },
    props: {
        promotional_video: String,
    },
}
</script>
