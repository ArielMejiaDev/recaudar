<template>

    <Panel>
        <template v-slot:header>
            <Title info="Transaction details">
                {{ $page.global_trans.transactions }}
            </Title>
        </template>
        <ListItem :label="trans.by">{{ transaction.name }}</ListItem>
        <ListItem :label="trans.email">{{ transaction.email }}</ListItem>
        <ListItem :label="trans.type">{{ transaction.type }}</ListItem>
        <ListItem :label="trans.date">{{ transaction.readable_created_at }}</ListItem>
        <ListItem :label="trans.status">
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
        trans: Object,
    },
    components: {
        Panel,
        Title,
        ListItem,
        Pill,
    },
}
</script>
