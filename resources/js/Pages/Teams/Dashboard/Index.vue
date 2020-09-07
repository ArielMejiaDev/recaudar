<template>
    <div>

        <div class="flex items-center justify-between pb-12 border-b border-gray-300">
            <div class="flex-1 min-w-0">
                <Title info="In this section you can manage your organizations.">{{ team.name }}</Title>
            </div>
            <div class="mt-5 flex lg:mt-0 lg:ml-4">
                <LinkButton link="#">
                    <Icon name="add" />
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
import Icon from "../../../Shared/Icon";

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
        Icon,
    },
    props: {
        team: Object,
    }
}
</script>
