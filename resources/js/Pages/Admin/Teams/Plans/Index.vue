<template>
    <div>
        <Table
            :title="`${team.name} plans`"
            :headers="[trans.plan, trans.amount_in_local_currency, trans.amount_in_dollars, trans.delete]"
            :searchbox="{show: true, placeholder: `${trans.search} ...`}"
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
                        <div @click="confirm = !confirm; selectedPlan = plan" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                            <Icon name="trash" />
                        </div>
                    </td>
                </tr>
            </template>
        </Table>

        <Modal
            v-if="confirm"
            type="danger"
            :title="`${trans.are_you_sure_to_delete_the_plan} ${selectedPlan.title}?`"
            :close-button-text="$page.global_trans.cancel"
            :action-button-text="`${$page.global_trans.delete} ${trans.plan}`"
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
        trans: Object,
    },
    watch: {
        search: _.throttle(function(value) {
            const route = this.route('admin.teams.plans.index', { team: this.team ,search: value });
            this.$inertia.replace(route);
        }, 200)
    },
    methods: {
        deletePlan() {
            const route = this.route('admin.teams.plans.delete', { team: this.team.id, plan: this.selectedPlan.id });
            this.$inertia.delete(route);
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
