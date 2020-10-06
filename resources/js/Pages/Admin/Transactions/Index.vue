<template>
    <div>
        <Table
            :title="trans.transactions"
            :headers="[trans.income , trans.amount, trans.status,  trans.type, trans.reviewed, trans.date]"
            :searchbox="{show: true, placeholder: `${trans.search} ...`}"
            v-model="search"
            :action="{show: false}"
            :pagination="{show: true, links: transactions.links}">
            <template v-slot:tableData>
                <tr v-for="(transaction, index) in transactions.data" :key="index">
                    <td>
                        <InertiaLink :href="route('admin.transactions.show', { transaction: transaction.id })">
                            {{ transaction.income }}
                            <span class="text-gray-600">{{ transaction.currency }}</span>
                        </InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('admin.transactions.show', { transaction: transaction.id })">
                            {{ transaction.amount_to_deposit }}
                            <span class="text-gray-600">{{ transaction.currency }}</span>
                        </InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('admin.transactions.show', { transaction: transaction.id })">
                            <Pill :type="transaction.status === 'approved' ? 'success' : 'danger'" v-text="getStatus(transaction.status)" />
                        </InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('admin.transactions.show', { transaction: transaction.id })">
                            <Pill :type="transaction.type === 'recurrent' ? 'warning' : null" v-text="getType(transaction.type)" />
                        </InertiaLink>
                    </td>
                    <td>
                        <InertiaLink v-if="transaction.type === 'recurrent'" href="#" @click.prevent="confirm = !confirm;selectedTransaction = transaction">
                            <Pill :type="transaction.reviewed === 'checked' ? 'success' : 'danger'" v-text="getReviewStatus(transaction.reviewed)" />
                        </InertiaLink>
                        <div v-else class="text-gray-500 w-full text-left">-</div>
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
        trans: Object,
    },
    methods: {
        changeRecurrence() {
            const route = this.route('admin.transactions.update', { transaction: this.selectedTransaction.id });
            this.$inertia.put(route);
        },
        getStatus(status) {
            if(status === 'approved') {
                return this.trans.approved;
            }
            if(status === 'pending') {
                return this.trans.pending;
            }
            return this.trans.failed;
        },
        getType(type) {
            if(type === 'single') {
                return this.trans.single;
            }
            return this.trans.recurrent;
        },
        getReviewStatus(review) {
            if(review === 'checked') {
                return this.trans.checked;
            }
            return this.trans.pending;
        }
    },
    watch: {
        search: _.throttle(function(value) {
            const route = this.route('admin.transactions.index', { search: value });
            this.$inertia.replace(route);
        }, 200)
    },
}
</script>

