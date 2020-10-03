<template>
    <div>

        <div class="flex items-center justify-between pb-4 border-b border-gray-300">
            <div class="flex-1 min-w-0">
                <Title>{{ team.name }}</Title>
            </div>
        </div>

        <EditLogo :trans="trans" class="mt-8" :logo="team.logo" />

        <EditBanner :trans="trans" class="mt-8" :banner="team.banner" />

        <EditTheme :trans="trans" class="mt-8" :theme="team.theme" />

        <EditSocialNetworks
            :trans="trans"
            class="mt-8"
            :facebook_account="team.facebook_account"
            :twitter_account="team.twitter_account"
            :instagram_account="team.twitter_account"
        />

        <EditPromotionalVideo :trans="trans" :promotional_video="team.promotional_video" class="mt-8" />

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
        trans: Object,
    },
}
</script>
