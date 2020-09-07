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
                            <svg viewBox="0 0 20 20" fill="currentColor" class="trash w-6 h-6"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
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
