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
                    <Title info="The user role defines the actions that a user can do">Create a user</Title>
                </template>

                <template v-slot:body>
                    <Input v-model="form.name" name="name" label="Name" :errors="$page.errors.name" />
                    <Input v-model="form.email" name="email" label="Email" type="email" :errors="$page.errors.email" />

                    <Select v-model="form.role" name="role" label="Role" :errors="$page.errors.role">
                        <option selected disabled value="null">Please select a role for the user</option>
                        <option value="team_admin">Admin</option>
                        <option value="team_editor">Editor</option>
                        <option value="team_financial">Financial</option>
                        <option value="team_member">Member</option>
                    </Select>
                </template>

                <template v-slot:footer>
                    <LoadingButton :loading="loading">Add user</LoadingButton>
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
    metaInfo: { title: 'Users' },
    name: "TeamUserCreate",
    data() {
        return {
            form: {
                name: null,
                email: null,
                role: null,
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
    },
    methods: {
        submit() {
            this.loading = true;
            this.$inertia.post(this.route('teams.users.store', this.$page.team['slug']), this.form)
                .then(() => this.loading = false);
        },
    },
}
</script>
