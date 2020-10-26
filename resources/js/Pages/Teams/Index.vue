<template>
    <div>

        <div class="flex items-center justify-between pb-12 border-b border-gray-300">
            <div class="flex-1 min-w-0">
                <Title :info="trans.in_this_section_you_can_manage_your_teams">{{ trans.your_teams }}.</Title>
            </div>
            <div class="mt-5 flex lg:mt-0 lg:ml-4">
                <a class="bg-indigo-500 rounded shadow py-2 px-4 text-white flex hover:bg-indigo-600" :href="route('pricing')">
                    <Icon name="add" />
                    {{ $page.global_trans.create }}
                </a>
            </div>
        </div>

        <div v-if="Object.entries(teams).length" class="flex flex-col md:flex-row flex-wrap mt-12">
            <PinnedLink
                class="mb-4"
                v-for="(team, index) in teams"
                :key="index"
                :title="team.name"
                :info="team.category"
                :link="route('teams.dashboard', team.slug)"
                :edit-link="route('teams.edit', team.slug)"
                :edit-link-text="$page.global_trans.edit"
                :delete-link="route('teams.delete', team.slug)"
                :delete-link-text="$page.global_trans.delete"
                :modal="{ type: 'danger', 'title': $page.global_trans.are_you_sure_to_delete_the_record, 'info': $page.global_trans.this_action_cannot_be_reversed, actionButtonText: $page.global_trans.delete, closeButtonText: $page.global_trans.cancel }"
            />
        </div>

        <div v-else class="text-center text-gray-500 text-3xl mt-12 flex flex-col items-center">
            <div class="my-6 text-gray-500">
                <svg viewBox="0 0 20 20" fill="currentColor" class="exclamation-circle w-20 h-20 fill-current"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
            </div>
            {{ trans.no_teams_available }}
        </div>

    </div>
</template>

<script>

import SidebarLayout from "../../Shared/Layouts/SidebarLayout";
import Panel from "../../Shared/Panel";
import PinnedLink from "../../Shared/PinnedLink";
import Title from "../../Shared/Title";
import LinkButton from "../../Shared/LinkButton";
import Icon from "../../Shared/Icon";

export default {
    metaInfo: { title: 'Teams' },
    name: "Teams",
    data: () => ({
        accept: false,
    }),
    layout: SidebarLayout,
    components: {
        Panel,
        PinnedLink,
        Title,
        LinkButton,
        Icon,
    },
    props: {
        teams: Array,
        trans: Object,
    }
}
</script>
