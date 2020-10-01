<template>

    <Panel>
        <template v-slot:header>
            <Title info="Transaction details">Transaction</Title>
        </template>
        <ListItem label="Donation by">{{ transaction.name }}</ListItem>
        <ListItem label="Email">{{ transaction.email }}</ListItem>
        <ListItem label="Type">{{ transaction.type }}</ListItem>
        <ListItem label="Date">{{ transaction.readable_created_at }}</ListItem>
        <ListItem label="Status">
            <Pill :type="transaction.status === 'approved' ? 'success' : 'danger'">{{ transaction.status }}</Pill>
        </ListItem>
        <ListItem label="Amount">
            <div class="flex">
                <div>{{ transaction.amount_to_deposit }}</div>
                <span class="text-gray-600 ml-2">{{ transaction.currency }}</span>
            </div>
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
        team: Object,
        transaction: Object,
        locale: Object,
    },
    components: {
        Panel,
        Title,
        ListItem,
        Pill,
    },
    methods: {
        currency: function(value) {
            return new Intl.NumberFormat(this.locale.country.toString(), {
                style: 'currency',
                currency: this.locale.currency.toString(),
                minimumFractionDigits: 2
            }).format(value);
        },
    }
}
</script>
