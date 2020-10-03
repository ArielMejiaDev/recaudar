<template>
    <div>

        <Table
            :title="trans.plans"
            :headers="['plan', trans.amount_in_local_currency, trans.amount_in_dollars, trans.copy_link, trans.delete]"
            :searchbox="{show: true, placeholder: `${$page.global_trans.search}...`}"
            v-model="search"
            :action="{show: true, text: trans.add_a_plan, link: route('teams.plans.create', $page.team['slug']), type: 'info'}"
            :pagination="{show: true, links: plans.links}">
            <template v-slot:tableData>
                <tr v-for="(plan, index) in plans.data" :key="index" >
                    <td>
                        <InertiaLink :href="route('teams.plans.edit', {team: $page.team['slug'], plan: plan.id})">{{ plan.title }}</InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('teams.plans.edit', {team: $page.team['slug'], plan: plan.id})">
                            {{ plan.amount_in_local_currency | local_format }}
                        </InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('teams.plans.edit', {team: $page.team['slug'], plan: plan.id})">
                            {{ plan.amount_in_dollars | dollar_format }}
                        </InertiaLink>
                    </td>
                    <td>
                        <button @click.prevent="copyLinkToClipboard(plan);clickOnLinkIcon = true" :class="clickOnLinkIcon ? 'text-blue-500' : 'text-gray-500'" class="text-xs font-semibold focus:outline-none hover:text-blue-500">
                            <Icon name="link" />
                        </button>
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
            :title="`${trans.are_you_sure_to_remove} ${selectedPlan.title}?`"
            :close-button-text="$page.global_trans.cancel"
            :action-button-text="trans.remove_plan"
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
            clickOnLinkIcon: false,
        }
    },
    methods: {
        removePlan() {
            const route = this.route('teams.plans.destroy', { team: this.$page.team['slug'] , plan: this.selectedPlan.id});
            this.$inertia.delete(route);
        },
        copyLinkToClipboard(plan) {
            this.selectedPlan = plan;
            const route = this.route('donate-direct-link', { team: this.team.slug, amount: plan.amount_in_local_currency });

            const el = document.createElement('input');
            el.value = route.url();
            el.setAttribute('readonly', '');
            el.style.position = 'absolute';
            el.style.left = '-9999px';
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
        }
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
        trans: Object,
    },
    components: {
        Title,
        Table,
        Pill,
        Icon,
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

