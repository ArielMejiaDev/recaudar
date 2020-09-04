<template>
        <div class="w-full flex flex-col lg:flex-row items-start mt-16">
            <div class="w-full lg:w-4/12 mb-6 lg:mb-0 lg:pr-12">
                <Title>Your settings</Title>
            </div>
            <div class="w-full lg:w-8/12">
                <Panel class="w-full">
                    <template v-slot:header>
                        <Title info="Some random text just to show how it looks.">User Detail.</Title>
                    </template>
                    <ListItem label="Name" :value="$page.auth.user.name"></ListItem>
                    <ListItem label="Email">
                        <Pill>
                            <InertiaLink href="/inertia">{{ $page.auth.user.email }}</InertiaLink>
                        </Pill>
                    </ListItem>
                </Panel>
            </div>
        </div>
</template>

<script>
import ListItem from "../../../Shared/ListItem";
import Panel from "../../../Shared/Panel";
import Title from "../../../Shared/Title";
import Pill from "../../../Shared/Pill";

export default {
    name: "ProfileDetail",
    components: {
        Title,
        Panel,
        ListItem,
        Pill,
    }
}
</script>

<style scoped>

</style>
