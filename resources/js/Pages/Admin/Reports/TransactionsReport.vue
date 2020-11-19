<template>
    <div>
        <form v-on:submit.prevent="submit">
            <Panel>
                <template v-slot:header>
                    <Title>{{ trans('admin_backend.transactions_report') }}</Title>
                </template>
                <template v-slot:body>
                    <div>
                        <div class="flex">
                            <div class="w-full md:w-8/12 md:mr-1">
                                <Input v-model="selectedTeam" type="text" required :label="trans('admin_backend.team')" :placeholder="trans('admin_backend.please_select_a_team')" :errors="$page.errors.team" list="team" />
                                <datalist id="team">
                                    <option v-for="(team, index) in teams" :value="team">{{ team }}</option>
                                </datalist>
                            </div>
                            <div class="w-full md:w-4/12 md:ml-1">
                                <Select v-model="status" name="status" :label="trans('admin_backend.status')" :errors="$page.errors.status">
                                    <option value="all">{{ trans('admin_backend.all') }}</option>
                                    <option value="approved">{{ trans('admin_backend.approved') }}</option>
                                    <option value="failed">{{ trans('admin_backend.failed') }}</option>
                                </Select>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <Input v-model="from" type="date" name="from" required :label="trans('admin_backend.from')" :errors="$page.errors.from" class="w-full md:w-1/2 md:mx-1"/>
                            <Input v-model="to" type="date" name="to" required :label="trans('admin_backend.to')" :errors="$page.errors.to" class="w-full md:w-1/2 md:mx-1" />
                        </div>
                    </div>
                </template>
                <template v-slot:footer>
                    <LoadingButton :loading="loading" class="flex items-center">
                        <span class="h-full block">{{ trans('admin_backend.generate') }}</span>
                    </LoadingButton>
                </template>
            </Panel>
        </form>
        <Table
            v-if="transactions"
            class="mt-10"
            :title="trans('admin_backend.transactions')"
            :headers="[trans('admin_backend.name'), trans('admin_backend.amount'), trans('admin_backend.amount_to_deposit'), trans('admin_backend.income'), trans('admin_backend.status'), trans('admin_backend.type'), trans('admin_backend.date')]"
            :searchbox="{show: false}"
            :action="{show: false}"
            :pagination="{show: true, links: transactions.links}">
            <template v-slot:tableData>
                <tr class="uppercase" v-for="(transaction, index) in transactions.data" :key="index">
                    <td>{{ transaction.name }}</td>
                    <td>
                        {{ transaction.amount }}
                        <span class="text-gray-600">{{ transaction.currency }}</span>
                    </td>
                    <td>
                        {{ transaction.amount_to_deposit }}
                        <span class="text-gray-600">{{ transaction.currency }}</span>
                    </td>
                    <td>
                        {{ transaction.income }}
                        <span class="text-gray-600">{{ transaction.currency }}</span>
                    </td>
                    <td>
                        <Pill :type="transaction.status === 'approved' ? 'success' : 'danger'">{{ transaction.status === 'approved' ? trans('admin_backend.approved') : trans('admin_backend.failed') }}</Pill>
                    </td>
                    <td>
                        <Pill :type="transaction.type === 'single' ? 'info' : 'warning'">{{ transaction.type === 'single' ? trans('admin_backend.single') : trans('admin_backend.recurrent') }}</Pill>
                    </td>
                    <td>{{ transaction.readable_created_at }}</td>
                </tr>
            </template>
        </Table>
        <div class="mt-10" v-else-if="loading">
            <Title class="capitalize">{{ trans('admin_backend.loading') }}...</Title>
        </div>
    </div>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Title from "../../../Shared/Title";
import Panel from "../../../Shared/Panel";
import Input from "../../../Shared/Input";
import Select from "../../../Shared/Select";
import LoadingButton from "../../../Shared/LoadingButton";
import Table from "../../../Shared/Table";
import Pill from "../../../Shared/Pill";

export default {
    name: "TransactionsReport",
    metaInfo: 'Transactions Report',
    layout: SidebarLayout,
    components: {
        Panel,
        Title,
        Input,
        Select,
        LoadingButton,
        Table,
        Pill,
    },
    data() {
        return {
            loading: false,
            selectedTeam: this.filters.team,
            from: this.filters.from,
            to: this.filters.to,
            status: this.filters.status ?? 'approved',
        }
    },
    remember: ['selectedTeam', 'from', 'to'],
    props: {
        teams: Array,
        transactions: null|Object,
        filters: null|Object,
    },
    methods:{
        submit() {
            this.loading = true;
            const route = this.route('admin.report.transactions.create', { team: this.selectedTeam, from: this.from, to: this.to, status: this.status });
            this.$inertia.replace(route, { only: ['transactions'] }).then(() => this.loading = false);
        }
    }
}
</script>
