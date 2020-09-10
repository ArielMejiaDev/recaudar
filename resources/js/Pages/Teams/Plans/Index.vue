<template>
    <div>

        <Table
            title="Plans"
            :headers="['plan', 'currency', 'amount', '']"
            :searchbox="{show: true, placeholder: 'Search ...'}"
            v-model="search"
            :action="{show: true, text: 'Add a plan', link: route('teams.plans.create', $page.team['slug']), type: 'info'}"
            :pagination="{show: true, links: plans.links}">
            <template v-slot:tableData>
                <tr v-for="(plan, index) in plans.data" :key="index" >
                    <td>
                        <InertiaLink :href="route('teams.plans.edit', {team: $page.team['slug'], plan: plan.id})">{{ plan.title }}</InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('teams.plans.edit', {team: $page.team['slug'], plan: plan.id})">
                            <Pill type="success">{{ plan.currency }}</Pill>
                        </InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('teams.plans.edit', {team: $page.team['slug'], plan: plan.id})">
                            {{ plan.amount }}
                        </InertiaLink>
                    </td>
                    <td>
                        <button @click="confirm = !confirm; selectedPlan = plan" class="text-gray-500 text-xs font-semibold focus:outline-none hover:text-gray-600">
                            <Icon name="trash" />
                        </button>
                    </td>
                </tr>
            </template>
        </Table>

        <Modal
            v-if="confirm"
            type="danger"
            :title="`Are you sure to remove ${selectedPlan.title}?`"
            info="All plan transactions will be ever available."
            close-button-text="Cancel"
            action-button-text="Remove plan"
            @close="confirm = !confirm;"
            @action="removePlan"
        />

    </div>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Title from "../../../Shared/Title";
import Table from "../../../Shared/Table";
import Pill from "../../../Shared/Pill";
import Icon from "../../../Shared/Icon";
import _ from "lodash";

export default {
    metaInfo: { title: 'Plans' },
    name: "Index",
    data() {
        return {
            confirm: false,
            search: this.filters.search,
            selectedPlan: null,
        }
    },
    methods: {
        removePlan() {
            const route = this.route('teams.plans.destroy', { team: this.$page.team['slug'] , plan: this.selectedPlan.id});
            this.$inertia.delete(route);
        },
    },
    watch: {
        search: _.throttle(function(value) {
            const route = this.route('teams.plans.index', { team: this.$page.team['slug'] , search: value});
            this.$inertia.replace(route, {preserveState: true});
        }, 200)
    },
    layout: SidebarLayout,
    props: {
        filters: Object,
        team: Object,
        plans: Object,
    },
    components: {
        Title,
        Table,
        Pill,
        Icon,
    }
}
</script>

