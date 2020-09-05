<template>
    <div>

        <div class="flex items-center justify-between pb-12 border-b border-gray-300">
            <div class="flex-1 min-w-0">
                <Title info="In this section you can manage your organizations.">{{ team.name }}</Title>
            </div>
            <div class="mt-5 flex lg:mt-0 lg:ml-4">
                <LinkButton link="#">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="plus w-6 h-6 fill-current mr-2 -ml-2"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Create
                </LinkButton>
            </div>
        </div>

    </div>
</template>

<script>

import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
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
        Title,
        LinkButton,
    },
    props: {
        team: Object,
    }
}
</script>
