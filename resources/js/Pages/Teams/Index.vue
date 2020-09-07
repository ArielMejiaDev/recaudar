<template>
    <div>

        <div class="flex items-center justify-between pb-12 border-b border-gray-300">
            <div class="flex-1 min-w-0">
                <Title info="In this section you can manage your teams.">Your Teams.</Title>
            </div>
            <div class="mt-5 flex lg:mt-0 lg:ml-4">
                <LinkButton :link="route('teams.create')">
                    <Icon name="add" />
                    Create
                </LinkButton>
            </div>
        </div>

        <div v-if="Object.entries(teams).length > 0" class="flex flex-col md:flex-row flex-wrap mt-12">
            <PinnedLink
                class="mb-4"
                v-for="(team, index) in teams"
                :key="index"
                :title="team.name"
                :info="team.category"
                :link="route('teams.dashboard', team.slug)"
                :edit-link="route('teams.edit', team.slug)"
                edit-link-text="Editar"
                :delete-link="route('teams.delete', team.slug)"
                delete-link-text="Eliminar"
                :modal="{ type: 'danger', 'title': 'esta seguro de eliminar el equipo?', 'info': 'Esta accion no se puede revertir.', actionButtonText: 'Eliminar', closeButtonText: 'Cancelar' }"
            />
        </div>

        <div v-else class="text-center text-gray-800 text-3xl mt-12 flex flex-col items-center">
            <div class="my-6 text-gray-800">
                <svg viewBox="0 0 20 20" fill="currentColor" class="exclamation-circle w-20 h-20 fill-current"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
            </div>
            No teams available.
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
    }
}
</script>
