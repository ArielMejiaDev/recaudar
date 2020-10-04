<template>
    <div>

        <Table
            :title="$page.global_trans.transactions"
            :headers="[trans.by, trans.amount, trans.status , trans.date]"
            :searchbox="{show: true, placeholder: `${$page.global_trans.search} ...`}"
            v-model="search"
            :action="{show: false}"
            :pagination="{show: true, links: transactions.links}">
            <template v-slot:tableData>
                <tr v-for="(transaction, index) in transactions.data" :key="index" >
                    <td>
                        <InertiaLink :href="route('teams.transactions.show', {team: $page.team['slug'], transaction: transaction.id})">{{ transaction.name }}</InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('teams.transactions.show', {team: $page.team['slug'], transaction: transaction.id})">
                            {{ transaction.amount_to_deposit }}
                            <span class="text-gray-600">{{ transaction.currency }}</span>
                        </InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('teams.transactions.show', {team: $page.team['slug'], transaction: transaction.id})">
                            <Pill :type="transaction.status === 'approved' ? 'success' : 'danger'" v-text="getTransactionStatus(transaction.status)"></Pill>
                        </InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('teams.transactions.show', {team: $page.team['slug'], transaction: transaction.id})">
                            {{ transaction.readable_created_at }}
                        </InertiaLink>
                    </td>
                </tr>
            </template>
        </Table>

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
    metaInfo: { title: 'Transactions' },
    name: "Index",
    data() {
        return {
            search: this.filters.search,
        }
    },
    watch: {
        search: _.throttle(function(value) {
            const route = this.route('teams.transactions.index', { team: this.$page.team['slug'] , search: value});
            this.$inertia.replace(route, {preserveState: true});
        }, 200)
    },
    layout: SidebarLayout,
    props: {
        filters: Object,
        team: Object,
        transactions: Object,
        trans: Object,
    },
    components: {
        Title,
        Table,
        Pill,
        Icon,
    },
    filters: {
        dollar_format: function(value) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2
            }).format(value);
        },
    },
    methods: {
        getTransactionStatus(status) {
            if(status === 'approved') {
                return this.trans.approved;
            }
            if(status === 'pending') {
                return this.trans.pending;
            }
            return this.trans.failed;
        }
    },
}
</script>

