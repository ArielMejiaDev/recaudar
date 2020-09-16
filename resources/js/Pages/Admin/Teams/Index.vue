<template>
    <div>
        <Table
            title="Teams"
            :headers="['team', 'status']"
            :searchbox="{show: true, placeholder: 'Search ...'}"
            v-model="search"
            :action="{show: false}"
            :pagination="{show: true, links: teams.links}">
            <template v-slot:tableData>
                <tr v-for="(team, index) in teams.data" :key="index">
                    <td>
                        <InertiaLink :href="route('admin.teams.edit', { team: team.id })">
                            {{ team.name }}
                        </InertiaLink>
                    </td>
                    <td @click="selectedTeam = team;confirm = !confirm;" class="cursor-pointer">
                        <Pill :type="team.status === 'pending' ? 'danger' : 'success'">
                            {{ team.status }}
                        </Pill>
                    </td>
                </tr>
            </template>
        </Table>

        <Modal
            v-if="confirm"
            type="danger"
            :title="`Are you sure to change status of ${selectedTeam.name}?`"
            info="You can switch status anytime."
            close-button-text="Cancel"
            action-button-text="Switch team status"
            @close="confirm = !confirm;"
            @action="changeStatus();confirm = !confirm"
        />
    </div>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Table from "../../../Shared/Table";
import Pill from "../../../Shared/Pill";
import _ from "lodash";
import Modal from "../../../Shared/Modal";

export default {
    metaInfo: { title: 'Admin Teams' },
    layout: SidebarLayout,
    name: "Index",
    data() {
        return {
            search: this.filters.search,
            confirm: false,
            selectedTeam: null,
        }
    },
    components: {
        Table,
        Pill,
        Modal,
    },
    methods: {
        changeStatus() {
            console.log('change status of ' + this.selectedTeam.name);
            const route = this.route('admin.teams.update-status', { 'team': this.selectedTeam.id });
            this.$inertia.put(route, {status: this.selectedTeam.status});
        }
    },
    props: {
        teams: Object,
        filters: Array | Object,
    },
    watch: {
        search: _.throttle(function(value) {
            const route = this.route('admin.teams.index', { search: value });
            this.$inertia.replace(route);
        }, 200)
    },
}
</script>
