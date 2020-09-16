<template>
    <div>

        <div class="flex items-start w-full justify-between mb-8">
            <Title class="mb-6">Admin dashboard</Title>
            <LinkButton :link="route('admin.admins.create')">Invite admin</LinkButton>
        </div>

        <div class="flex flex-wrap -mx-4 mb-16">
            <Card title="Users" number="500" />
            <Card title="Sales" number="20,000" percent="35" type="success"/>
            <Card title="Inventory" number="820" percent="10" type="danger" />
        </div>

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
}
</script>
