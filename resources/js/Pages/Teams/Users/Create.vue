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
                    <Title :info="trans.the_user_role_defines_the_actions_that_a_user_can_do">{{ trans.create_a_user }}</Title>
                </template>

                <template v-slot:body>
                    <Input v-model="form.name" name="name" :label="trans.name" :errors="$page.errors.name" />
                    <Input v-model="form.email" name="email" :label="trans.email" type="email" :errors="$page.errors.email" />

                    <Select v-model="form.role" name="role" :label="trans.role" :placeholder="`${$page.global_trans.select} ${trans.role}`" :errors="$page.errors.role">
                        <option value="team_admin">{{ trans.admin }}</option>
                        <option value="team_editor">{{ trans.editor }}</option>
                        <option value="team_financial">{{ trans.financial }}</option>
                        <option value="team_member">{{ trans.member }}</option>
                    </Select>
                </template>

                <template v-slot:footer>
                    <LoadingButton :loading="loading">{{ $page.global_trans.create }}</LoadingButton>
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
    remember: 'form',
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
        trans: Object,
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
