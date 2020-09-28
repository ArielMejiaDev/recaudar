<template>
    <div class="w-full lg:w-8/12">
        <Panel class="w-full">
            <template v-slot:header>
                <Title info="Some random text just to show how it looks.">Charge Details.</Title>
            </template>
            <ListItem label="Country" :value="charge.country"></ListItem>
            <ListItem label="Income">
                <Pill type="success">{{ charge.income }}</Pill>
            </ListItem>
            <ListItem label="Payment gateway" :value="charge.gateway"></ListItem>
            <ListItem label="Payment gateway percentage">
                <Pill type="warning">{{ charge.gateway_charge }}</Pill>
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
    metaInfo: { title: 'Edit charge' },
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
