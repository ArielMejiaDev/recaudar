<template>

    <form @submit.prevent="submit">

        <Panel>
            <template v-slot:header>
                <Title>Theme</Title>
            </template>

            <template v-slot:body>
                <Select v-model="form.theme" name="theme" :errors="$page.errors.theme" placeholder="Change theme">
                    <option value="classic">Classic</option>
                    <option value="condensed">Condensed</option>
                    <option value="columns">Columns</option>
                </Select>
            </template>

            <template v-slot:footer>
                <LoadingButton :loading="loading">Update theme</LoadingButton>
            </template>

        </Panel>

    </form>

</template>

<script>
import Panel from "../../../Shared/Panel";
import Title from "../../../Shared/Title";
import LoadingButton from "../../../Shared/LoadingButton";
import Select from "../../../Shared/Select";

export default {
    name: "EditPromotionalVideo",
    data() {
        return {
            form: {
                theme: this.theme,
            },
            loading: false,
        }
    },
    components: {
        Panel,
        Title,
        Select,
        LoadingButton,
    },
    methods: {
        submit() {
            this.loading = true;
            const route = this.route('teams.profile.update_theme', {team: this.$page.team['slug'] });
            this.$inertia.put(route, this.form).then(() => this.loading = false);
        },
    },
    props: {
        theme: String,
    },
}
</script>
