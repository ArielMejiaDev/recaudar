<template>

    <Panel>
        <template v-slot:header>
            <Title :info="trans.transaction_details">{{ trans.transactions }}</Title>
        </template>
        <ListItem :label="trans.by">{{ transaction.name }}</ListItem>
        <ListItem :label="trans.email">{{ transaction.email }}</ListItem>
        <ListItem :label="trans.type">{{ transaction.type }}</ListItem>
        <ListItem :label="trans.date">{{ transaction.readable_created_at }}</ListItem>
        <ListItem :label="trans.amount">
            <div class="flex">
                <div>{{ transaction.amount_to_deposit }}</div>
                <span class="text-gray-600 ml-2">{{ transaction.currency }}</span>
            </div>
        </ListItem>
        <ListItem :label="trans.status">
            <Pill :type="transaction.status === 'approved' ? 'success' : 'danger'" v-text="getStatus(transaction.status)" />
        </ListItem>
        <ListItem :label="trans.reviewed">
            <Pill :type="transaction.reviewed === 'checked' ? 'success' : 'danger'" v-text="getReview(transaction.reviewed)" />
        </ListItem>
    </Panel>

</template>

<script>
import Panel from "../../../Shared/Panel";
import Pill from "../../../Shared/Pill";
import Title from "../../../Shared/Title";
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import ListItem from "../../../Shared/ListItem";

export default {
    metaInfo: {title: 'Transaction'},
    layout: SidebarLayout,
    name: "Show",
    props: {
        transaction: Object,
        trans: Object,
    },
    components: {
        Panel,
        Title,
        ListItem,
        Pill,
    },
    methods: {
        getStatus(status) {
            if(status === 'approved') {
                return this.trans.approved;
            }
            if(status === 'pending') {
                return this.trans.pending;
            }
            return this.trans.failed;
        },
        getReview(review) {
            if(review === 'checked') {
                return this.trans.checked;
            }
            return this.trans.pending;
        }
    },
}
</script>
