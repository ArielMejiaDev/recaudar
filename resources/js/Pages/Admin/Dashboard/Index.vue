<template>
    <div>

        <div class="flex items-start w-full justify-between mb-8">
            <Title :info="trans.data_of_the_month" class="mb-6">Admin dashboard</Title>
            <LinkButton v-if="$page.auth.user.role === 'app_admin'" :link="route('admin.admins.create')">{{ trans.invite_admin }}</LinkButton>
        </div>

        <div class="flex flex-col lg:flex-row mb-16 w-full">
            <Card class="w-full lg:w-1/3 lg:mx-2" :title="trans.total_income" :number="totalIncome" :pill="localCurrencyCode" type="success"/>
            <Card class="w-full lg:w-1/3 lg:mx-2" :title="trans.recurrent_plans_income" :number="totalIncomeByRecurrence" :pill="localCurrencyCode" type="success" />
            <Card class="w-full lg:w-1/3 lg:mx-2" :title="trans.new_recurrent_plans" :number="newRecurrentPlans" :pill="localCurrencyCode" type="success" />
        </div>

        <Table
            :title="trans.recent_transactions"
            :headers="[trans.by, trans.income, trans.status , trans.date]"
            :searchbox="{show: false, placeholder: `${$page.global_trans.search} ...`}"
            :action="{show: false}"
            :pagination="{show: false}">
            <template v-slot:tableData>
                <tr v-for="(transaction, index) in recentTransactions" :key="index" >
                    <td>
                        <InertiaLink :href="route('admin.transactions.show', {transaction: transaction.id})">{{ transaction.name }}</InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('admin.transactions.show', {transaction: transaction.id})">
                            {{ transaction.income }}
                            <span class="text-gray-600">{{ transaction.currency }}</span>
                        </InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('admin.transactions.show', {transaction: transaction.id})">
                            <Pill :type="transaction.status === 'approved' ? 'success' : 'danger'" v-text="getTransactionStatus(transaction.status)"></Pill>
                        </InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('admin.transactions.show', {transaction: transaction.id})">
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
import Panel from "../../../Shared/Panel";
import Card from "../../../Shared/Card";
import ActionPanel from "../../../Shared/ActionPanel";
import Title from "../../../Shared/Title";
import LinkButton from "../../../Shared/LinkButton";

export default {
    metaInfo: { title: 'Admin Dashboard' },
    name: "AdminDashboard",
    data: () => ({
        accept: false,
    }),
    layout: SidebarLayout,
    components: {
        Panel,
        Card,
        ActionPanel,
        Title,
        LinkButton,
    },
    props: {
        totalIncome: String,
        totalIncomeByRecurrence: String,
        newRecurrentPlans: Number,
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
