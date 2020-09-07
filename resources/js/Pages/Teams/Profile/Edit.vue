<template>
    <div>

        <div class="flex items-center justify-between pb-12 border-b border-gray-300">
            <div class="flex-1 min-w-0">
                <Title>{{ team.name }} Profile</Title>
            </div>
        </div>

        <EditLogo :logo="team.logo" />

        <EditBanner class="mt-16" :banner="team.banner" />

        <EditSocialNetworks
            class="mt-16"
            :facebook_account="team.facebook_account"
            :twitter_account="team.twitter_account"
            :instagram_account="team.twitter_account"
        />

    </div>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Title from "../../../Shared/Title";
import EditLogo from "./EditLogo";
import EditBanner from "./EditBanner";
import EditSocialNetworks from "./EditSocialNetworks";

export default {
    metaInfo: { title: 'Team profile' },
    name: "TeamProfile",
    layout: SidebarLayout,
    components: {
        Title,
        EditLogo,
        EditBanner,
        EditSocialNetworks,
    },
    props: {
        team: Object,
    },
    methods: {
    },
}
</script>
