<template>

    <form @submit.prevent="submit">

        <Panel>
            <template v-slot:header>
                <Title>{{ trans.promotional_video }}</Title>
            </template>

            <template v-slot:body>
                <Input v-model="form.promotional_video" name="promotional_video" :placeholder="trans.add_a_link" :errors="$page.errors.promotional_video" :required="false" />
            </template>

            <template v-slot:footer>
                <LoadingButton :loading="loading">
                    {{ $page.global_trans.update }} {{ trans.promotional_video }}
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
        trans: Object,
    },
}
</script>
