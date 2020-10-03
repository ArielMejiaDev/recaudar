<template>
    <div>

        <div class="flex items-center justify-between pb-12 border-b border-gray-300">
            <div class="flex-1 min-w-0">
                <Title>{{ team.name }}</Title>
            </div>
        </div>

        <form @submit.prevent="submit">

            <Panel>
                <template v-slot:header>
                    <Title :info="trans.the_user_role_defines_the_actions_that_a_user_can_do">{{ trans.edit_role_of }} {{ user.name }}</Title>
                </template>

                <template v-slot:body>
                    <Select v-model="form.role" name="role" :label="trans.role" :placeholder="`${$page.global_trans.select} ${trans.role}`" :errors="$page.errors.role">
                        <option value="team_admin">Admin</option>
                        <option value="team_editor">Editor</option>
                        <option value="team_financial">Financial</option>
                        <option value="team_member">Member</option>
                    </Select>
                </template>

                <template v-slot:footer>
                    <LoadingButton :loading="loading">{{ $page.global_trans.update }}</LoadingButton>
                </template>

            </Panel>

        </form>

    </div>
</template>

<script>

import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Title from "../../../Shared/Title";
import LinkButton from "../../../Shared/LinkButton";
import Panel from "../../../Shared/Panel";
import Input from "../../../Shared/Input";
import LoadingButton from "../../../Shared/LoadingButton";
import Select from "../../../Shared/Select";

export default {
    metaInfo: { title: 'Edit user' },
    name: "TeamUserEdit",
    remember: 'form',
    data() {
        return {
            form: {
                role: 'team_' + this.user.role.toLowerCase(),
            },
            loading: false,
        }
    },
    layout: SidebarLayout,
    components: {
        Title,
        Panel,
        Input,
        Select,
        LoadingButton,
    },
    props: {
        team: Object,
        user: Object,
        trans: Object,
    },
    methods: {
        submit() {
            this.loading = true;
            const route = this.route('teams.users.update', { team: this.$page.team['slug'], user: this.user.id });
            this.$inertia.put(route, this.form)
                .then(() => this.loading = false)
        },
    },
}
</script>
