<template>
    <div>
        <Table
            title="Transactions"
            :headers="['amount', 'status',  'type', 'active', 'date']"
            :searchbox="{show: true, placeholder: 'Search ...'}"
            v-model="search"
            :action="{show: false}"
            :pagination="{show: true, links: transactions.links}">
            <template v-slot:tableData>
                <tr v-for="(transaction, index) in transactions.data" :key="index">
                    <td>
                        <InertiaLink :href="route('admin.transactions.show', { transaction: transaction.id })">
                            {{ transaction.amount_to_deposit }}
                            <span class="text-gray-600">{{ transaction.currency }}</span>
                        </InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('admin.transactions.show', { transaction: transaction.id })">
                            <Pill :type="transaction.status === 'approved' ? 'success' : 'danger'">
                                {{ transaction.status }}
                            </Pill>
                        </InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('admin.transactions.show', { transaction: transaction.id })">
                            <Pill :type="transaction.type === 'recurrent' ? 'warning' : null">
                                {{ transaction.type }}
                            </Pill>
                        </InertiaLink>
                    </td>
                    <td>
                        <button class="focus:outline-none" @click.prevent="confirm = !confirm;selectedTransaction = transaction" v-if="transaction.type === 'recurrent' && transaction.reviewed === 'pending'" :href="route('admin.transactions.show', { transaction: transaction.id })">
                            <Icon name="x-circle" class="text-red-500 hover:text-red-600" />
                        </button>
                        <button class="focus:outline-none" @click.prevent="confirm = !confirm;selectedTransaction = transaction" v-if="transaction.type === 'recurrent' && transaction.reviewed === 'checked'" :href="route('admin.transactions.show', { transaction: transaction.id })">
                            <Icon name="check-circle" class="text-green-500 hover:text-green-600" />
                        </button>
                    </td>
                    <td>
                        <InertiaLink :href="route('admin.transactions.show', { transaction: transaction.id })">
                            {{ transaction.readable_created_at }}
                        </InertiaLink>
                    </td>
                </tr>
            </template>
        </Table>

        <Modal
            v-if="confirm"
            type="danger"
            :title="selectedTransaction.reviewed === 'pending' ? 'Are you sure to active transaction recurrence?' : 'Are you sure to disable transaction recurrence?'"
            info="This change is going to impact on plan charges."
            close-button-text="Cancel"
            :action-button-text="selectedTransaction.reviewed === 'pending' ? 'Active recurrence' : 'Disabled recurrence'"
            @close="confirm = !confirm;"
            @action="changeRecurrence();confirm = !confirm"
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
    metaInfo: { title: 'Transactions' },
    layout: SidebarLayout,
    name: "Index",
    data() {
        return {
            search: this.filters.search,
            confirm: false,
            selectedTransaction: null,
        }
    },
    components: {
        Table,
        Pill,
        Icon,
        Modal,
    },
    props: {
        transactions: Object,
        filters: Array | Object,
    },
    methods: {
        changeRecurrence() {
            const route = this.route('admin.transactions.update', { transaction: this.selectedTransaction.id });
            this.$inertia.put(route);
        }
    },
    watch: {
        search: _.throttle(function(value) {
            const route = this.route('admin.teams.index', { search: value });
            this.$inertia.replace(route);
        }, 200)
    },
}
</script>

