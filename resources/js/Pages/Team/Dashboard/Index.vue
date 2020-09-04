<template>
    <div>

        <div class="flex items-end justify-between mb-6 pb-6 border-b border-gray-400">
            <Title info="In this section you can manage your organizations.">Here the current team dashboard.</Title>
            <div>
                <LinkButton link="/dashboard" text="Create" />
            </div>
        </div>

    </div>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Panel from "../../../Shared/Panel";
import Card from "../../../Shared/Card";
import ActionPanel from "../../../Shared/ActionPanel";
import PinnedLink from "../../../Shared/PinnedLink";
import Title from "../../../Shared/Title";
import LinkButton from "../../../Shared/LinkButton";

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
}
</script>
