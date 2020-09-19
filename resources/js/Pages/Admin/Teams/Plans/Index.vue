<template>
    <div>
        <Table
            :title="`${team.name} plans`"
            :headers="['plan', 'Amount in local currency', 'Amount in dollars', 'Delete']"
            :searchbox="{show: true, placeholder: 'Search ...'}"
            v-model="search"
            :action="{show: false}"
            :pagination="{show: true, links: plans.links}">
            <template v-slot:tableData>
                <tr v-for="(plan, index) in plans.data" :key="index">
                    <td>
                        <InertiaLink :href="route('admin.teams.plans.edit', { team: team.id, plan: plan.id })">
                            {{ plan.title }}
                        </InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('admin.teams.plans.edit', { team: team.id, plan: plan.id })">
                            {{ plan.amount_in_local_currency | local_format }}
                        </InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('admin.teams.plans.edit', { team: team.id, plan: plan.id })">
                            {{ plan.amount_in_dollars | dollar_format }}
                        </InertiaLink>
                    </td>
                    <td>
                        <div @click="confirm = !confirm; selectedPlan = plan" class="text-gray-500 hover:text-gray-600">
                            <Icon name="trash" />
                        </div>
                    </td>
                </tr>
            </template>
        </Table>

        <Modal
            v-if="confirm"
            type="danger"
            :title="`Are you sure to delete the plan ${selectedPlan.title}?`"
            info="This is going to delete the plan from the team profile page."
            close-button-text="Cancel"
            action-button-text="Delete plan"
            @close="confirm = !confirm;"
            @action="deletePlan();confirm = !confirm"
        />

    </div>
</template>

<script>
import SidebarLayout from "../../../../Shared/Layouts/SidebarLayout";
import Table from "../../../../Shared/Table";
import Modal from "../../../../Shared/Modal";
import Icon from "../../../../Shared/Icon";
import _ from "lodash";

export default {
    metaInfo: { title:  'Team plans' },
    layout: SidebarLayout,
    name: "Index",
    components: {
        Table,
        Icon,
        Modal,
    },
    data() {
        return {
            search: this.filters.search,
            confirm: false,
            selectedPlan: null,
        }
    },
    props: {
        team: Object,
        plans: Object,
        filters: Array | Object,
    },
    watch: {
        search: _.throttle(function(value) {
            const route = this.route('admin.teams.plans.index', { team: this.team ,search: value });
            this.$inertia.replace(route);
        }, 200)
    },
    methods: {
        deletePlan() {
            //
        }
    },
    filters: {
        dollar_format: function(value , style = 'currency') {
            return new Intl.NumberFormat('en-US', {
                style: style,
                currency: 'USD',
                minimumFractionDigits: 2
            }).format(value);
        },
        local_format: function(value, style = 'currency', countryCode = 'es-GT', currencyCode = 'GTQ') {
            return new Intl.NumberFormat(countryCode, {
                style: style,
                currency: currencyCode,
                minimumFractionDigits: 2
            }).format(value);
        },
    }
}
</script>

<style scoped>

</style>
