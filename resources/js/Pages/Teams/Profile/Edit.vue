<template>
    <div>

        <div class="flex items-center justify-between pb-12 border-b border-gray-300">
            <div class="flex-1 min-w-0">
                <Title>{{ team.name }} Profile</Title>
            </div>
        </div>

        <EditLogo class="mt-16" :logo="team.logo" />

        <EditBanner class="mt-16" :banner="team.banner" />

        <EditTheme class="mt-16" :theme="team.theme" />

        <EditSocialNetworks
            class="mt-16"
            :facebook_account="team.facebook_account"
            :twitter_account="team.twitter_account"
            :instagram_account="team.twitter_account"
        />

        <EditPromotionalVideo :promotional_video="team.promotional_video" class="mt-16" />

    </div>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Title from "../../../Shared/Title";
import EditLogo from "./EditLogo";
import EditBanner from "./EditBanner";
import EditSocialNetworks from "./EditSocialNetworks";
import EditPromotionalVideo from "./EditPromotionalVideo";
import EditTheme from "./EditTheme";

export default {
    metaInfo: { title: 'Team profile' },
    name: "TeamProfile",
    layout: SidebarLayout,
    components: {
        Title,
        EditLogo,
        EditBanner,
        EditTheme,
        EditSocialNetworks,
        EditPromotionalVideo,
    },
    props: {
        team: Object,
    },
    methods: {
    },
}
</script>
