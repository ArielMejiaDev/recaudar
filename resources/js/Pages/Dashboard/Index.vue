<template>
    <div>

        <div class="flex items-end justify-between mb-6 pb-6 border-b border-gray-400">
            <Title info="In this section you can manage your organizations.">Your organizations.</Title>
            <div>
                <LinkButton link="/dashboard" text="Create" />
            </div>
        </div>

        <div v-if="Object.entries(teams).length > 0" class="flex flex-col md:flex-row flex-wrap mt-10">
            <PinnedLink v-for="(team, index) in teams" :key="index" :title="team.name" :info="team.category" class="mb-4" :link="route('team.dashboard', team.slug)" />
        </div>

        <div v-else>No teams available.</div>

    </div>
</template>

<script>
import SidebarLayout from "../../Shared/Layouts/SidebarLayout";
import Panel from "../../Shared/Panel";
import Card from "../../Shared/Card";
import ActionPanel from "../../Shared/ActionPanel";
import PinnedLink from "../../Shared/PinnedLink";
import Title from "../../Shared/Title";
import LinkButton from "../../Shared/LinkButton";

export default {
    metaInfo: { title: 'Dashboard' },
    name: "Dashboard",
    data: () => ({
        accept: false,
    }),
    layout: SidebarLayout,
    components: {
        Panel,
        PinnedLink,
        Title,
        LinkButton,
    },
    props: {
        teams: Array,
    }
}
</script>
