<template>
    <div class="w-full lg:w-8/12">
        <Panel class="w-full">
            <template v-slot:header>
                <Title>{{ trans.charge_details }}</Title>
            </template>
            <ListItem :label="trans.country" :value="charge.country"></ListItem>
            <ListItem :label="trans.income_charge">
                <Pill type="success">{{ charge.income_charge }} %</Pill>
            </ListItem>
            <ListItem :label="trans.payment_gateway" :value="charge.gateway"></ListItem>
            <ListItem :label="trans.gateway_charge_percentage">
                <Pill type="warning">{{ charge.gateway_charge }} %</Pill>
            </ListItem>
        </Panel>
    </div>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Panel from "../../../Shared/Panel";
import Title from "../../../Shared/Title";
import ListItem from "../../../Shared/ListItem";
import Pill from "../../../Shared/Pill";

export default {
    metaInfo: { title: 'Show charge' },
    layout: SidebarLayout,
    name: "Edit",
    components: {
        Panel,
        Title,
        ListItem,
        Pill,
    },
    props: {
        charge: Object,
        trans: Object,
    },
    methods: {
        submit() {
            this.loading = true;
            const route = this.route('admin.charges.update', { charge: this.charge.id})
            this.$inertia.put(route, this.form).then(() => this.loading = false);
        }
    }
}
</script>
