<template>
    <div>

        <div class="flex items-center justify-between mb-8">
            <div class="flex-1 min-w-0">
                <Title :info="trans.data_of_the_month">{{ team.name }}</Title>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row mb-16 w-full">
            <Card class="w-full lg:w-1/3 lg:mx-2" :title="trans.total_income" :number="monthTotalIncome" :pill="localCurrencyCode" type="success"/>
            <Card class="w-full lg:w-1/3 lg:mx-2" :title="trans.recurrent_plans_income" :number="monthTotalIncomeRecurrent" :pill="localCurrencyCode" type="success" />
            <Card class="w-full lg:w-1/3 lg:mx-2" :title="trans.new_recurrent_plans" :number="monthNewRecurrentPlans" :pill="localCurrencyCode" type="success" />
        </div>

        <Table
            :title="trans.recent_transactions"
            :headers="[trans.by, trans.amount, trans.status , trans.date]"
            :searchbox="{show: false, placeholder: `${$page.global_trans.search} ...`}"
            :action="{show: false}"
            :pagination="{show: false}">
            <template v-slot:tableData>
                <tr v-for="(transaction, index) in recentTransactions" :key="index" >
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
import LinkButton from "../../../Shared/LinkButton";
import Icon from "../../../Shared/Icon";
import Card from "../../../Shared/Card";
import Table from "../../../Shared/Table";
import Pill from "../../../Shared/Pill";

export default {
    metaInfo: { title: 'Dashboard' },
    name: "Dashboard",
    data: () => ({
        accept: false,
    }),
    layout: SidebarLayout,
    components: {
        Title,
        LinkButton,
        Icon,
        Card,
        Table,
        Pill,
    },
    props: {
        team: Object,
        monthTotalIncome: String,
        monthNewRecurrentPlans: Number,
        monthTotalIncomeRecurrent: String,
        trans: Object,
        localCurrencyCode: String,
        recentTransactions: Array,
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
