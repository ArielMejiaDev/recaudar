<template>
    <div>

        <div class="flex items-center justify-between pb-12 border-b border-gray-300">
            <div class="flex-1 min-w-0">
                <Title>{{ team.name }} Profile</Title>
            </div>
        </div>

        <EditLogo :logo="team.logo" />

    </div>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Title from "../../../Shared/Title";
import EditLogo from "./EditLogo";

export default {
    metaInfo: { title: 'Team profile' },
    name: "TeamProfile",
    layout: SidebarLayout,
    components: {
        Title,
        EditLogo,
    },
    props: {
        team: Object,
    },
    methods: {
    },
}
</script>
