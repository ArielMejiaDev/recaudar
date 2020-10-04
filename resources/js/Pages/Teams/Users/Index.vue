<template>
    <div>

        <Table
            :title="trans.users"
            :headers="[trans.user, trans.role, $page.global_trans.delete]"
            :searchbox="{show: true, placeholder: `${$page.global_trans.search} ...`}"
            v-model="search"
            :action="{show: true, text: trans.invite_a_user, link: route('teams.users.create', $page.team['slug']), type: 'info'}"
            :pagination="{show: true, links: users.links}">
            <template v-slot:tableData>
                <tr v-for="(user, index) in users.data" :key="index">
                    <td>
                        <InertiaLink :href="route('teams.users.edit', {team: $page.team['slug'], user: user.id})">{{ user.name }}</InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('teams.users.edit', {team: $page.team['slug'], user: user.id})">
                            <Pill type="info" v-text="getRole(user.role)"></Pill>
                        </InertiaLink>
                    </td>
                    <td>
                        <button @click="confirm = !confirm; selectedUser = user" class="text-gray-500 hover:text-gray-600 text-xs font-semibold focus:outline-none">
                            <Icon name="trash" />
                        </button>
                    </td>
                </tr>
            </template>
        </Table>

        <Modal
            v-if="confirm"
            type="danger"
            :title="`${trans.remove_access_to} ${selectedUser.name}`"
            :info="trans.you_can_invite_again_the_user_anytime"
            :close-button-text="$page.global_trans.cancel"
            :action-button-text="trans.remove_access"
            @close="confirm = !confirm;"
            @action="removeUserAccess"
        />

    </div>
</template>

<script>
import _ from "lodash";
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Title from "../../../Shared/Title";
import LinkButton from "../../../Shared/LinkButton";
import Table from "../../../Shared/Table";
import Pill from "../../../Shared/Pill";
import Modal from "../../../Shared/Modal";
import Icon from "../../../Shared/Icon";

export default {
    metaInfo: { title: 'Dashboard' },
    name: "Dashboard",
    data() {
        return {
            confirm: false,
            search: this.filters.search,
            selectedUser: null,
        }
    },
    layout: SidebarLayout,
    components: {
        Title,
        LinkButton,
        Table,
        Pill,
        Modal,
        Icon,
    },
    props: {
        team: Object,
        users: Object,
        filters: Object,
        trans: Object,
    },
    methods: {
        removeUserAccess() {
            this.$inertia.delete(this.route('teams.users.destroy', { team: this.$page.team['slug'] , user: this.selectedUser.id}));
        },
        getRole(role) {
            if(role === 'Admin') {
                return this.trans.admin;
            }
            if(role === 'Editor') {
                return this.trans.editor;
            }
            if(role === 'Financial') {
                return this.trans.financial;
            }
            return this.trans.member;
        }
    },
    watch: {
        search: _.throttle(function(value) {
            this.$inertia.replace(this.route('teams.users.index', { team: this.$page.team['slug'] , search: value}));
        }, 200)
    },
}
</script>
