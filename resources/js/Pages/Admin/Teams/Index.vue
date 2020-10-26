<template>
    <div>
        <Table
            :title="trans.teams"
            :headers="[trans.team, trans.plan, trans.status, trans.plans]"
            :searchbox="{show: true, placeholder: `${trans.search} ...`}"
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
                    <td>
                        <Pill class="uppercase" :type="team.plan === 'free' ? 'info' : 'success'" v-text="team.plan" />
                    </td>
                    <td @click="selectedTeam = team;confirm = !confirm;" class="cursor-pointer">
                        <Pill :type="team.status === 'pending' ? 'danger' : 'success'" v-text="getStatus(team.status)"></Pill>
                    </td>
                    <td>
                        <InertiaLink :href="route('admin.teams.plans.index', { team: team.id })">
                            <Icon name="directory-filled" class="text-gray-500 hover:text-gray-600" />
                        </InertiaLink>
                    </td>
                </tr>
            </template>
        </Table>

        <Modal
            v-if="confirm"
            type="danger"
            :title="`${trans.are_you_sure_to_change_status_of} ${selectedTeam.name}?`"
            :info="trans.you_can_switch_status_anytime"
            :close-button-text="$page.global_trans.cancel"
            :action-button-text="$page.global_trans.update"
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
import Icon from "../../../Shared/Icon";

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
        Icon,
        Modal,
    },
    methods: {
        changeStatus() {
            console.log('change status of ' + this.selectedTeam.name);
            const route = this.route('admin.teams.update-status', { 'team': this.selectedTeam.id });
            this.$inertia.put(route, {status: this.selectedTeam.status});
        },
        getStatus(status) {
            if(status === 'approved') {
                return this.trans.approved;
            }
            return this.trans.pending;
        }
    },
    props: {
        teams: Object,
        filters: Array | Object,
        trans: Object,
    },
    watch: {
        search: _.throttle(function(value) {
            const route = this.route('admin.teams.index', { search: value });
            this.$inertia.replace(route);
        }, 200)
    },
}
</script>
