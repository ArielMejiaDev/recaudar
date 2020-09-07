<template>
    <div>

        <div class="flex items-center justify-between pb-12 border-b border-gray-300">
            <div class="flex-1 min-w-0">
                <Title info="In this section you can manage your organizations.">{{ team.name }} Users</Title>
            </div>
        </div>

        <Table
            title="Users"
            :headers="['user', 'role', '']"
            :searchbox="{show: true, placeholder: 'Search ...'}"
            v-model="search"
            :action="{show: true, text: 'Invite a User', link: route('teams.users.create', $page.team['slug']), type: 'info'}"
            :pagination="{show: true, links: users.links}">
            <template v-slot:tableData>
                <tr v-for="(user, index) in users.data">
                    <td>
                        <InertiaLink :href="route('teams.users.edit', {team: $page.team['slug'], user: user.id})">{{ user.name }}</InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('teams.users.edit', {team: $page.team['slug'], user: user.id})">
                            <Pill type="info">{{ user.role }}</Pill>
                        </InertiaLink>
                    </td>
                    <td>
                        <button @click="confirm = !confirm; selectedUser = user" class="text-gray-500 text-xs font-semibold focus:outline-none">
                            <Icon name="trash" />
                        </button>
                    </td>
                </tr>
            </template>
        </Table>

        <Modal
            v-if="confirm"
            type="danger"
            :title="`Are you sure to remove access to ${selectedUser.name}?`"
            info="You can invite again the user anytime."
            close-button-text="Cancel"
            action-button-text="Remove access"
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
    },
    methods: {
        removeUserAccess() {
            this.$inertia.delete(this.route('teams.users.destroy', { team: this.$page.team['slug'] , user: this.selectedUser.id}));
        }
    },
    watch: {
        search: _.throttle(function(value) {
            this.$inertia.replace(this.route('teams.users.index', { team: this.$page.team['slug'] , search: value}));
        }, 200)
    },
}
</script>
