<template>
    <div>
        <Table
            v-if="users.data > 0"
            :title="trans.title"
            :headers="[trans.name, trans.email, trans.created]"
            :searchbox="{show: true, placeholder: `${trans.search} ...`}"
            v-model="search"
            :action="{show: false}"
            :pagination="{show: true, links: users.links}">
            <template v-slot:tableData>
                <tr v-for="(user, index) in users.data" :key="index">
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.latin_created_at }}</td>
                </tr>
            </template>
        </Table>
        <div v-else class="flex flex-col justify-center items-center text-gray-700">
            <Icon class="w-12 h-12" name="info" />
            <span class="mt-4 font-semibold text-2xl">{{ trans('admin_backend.no_users_available') }}</span>
        </div>
    </div>
</template>

<script>
import SidebarLayout from "../../../../Shared/Layouts/SidebarLayout";
import Table from "../../../../Shared/Table";
import Title from "../../../../Shared/Title";
import Panel from "../../../../Shared/Panel";
import _ from "lodash";
import Icon from "../../../../Shared/Icon";

export default {
    name: "Index",
    metaInfo: { title: 'Users without organizations' },
    layout: SidebarLayout,
    props: {
        users: Object,
        filters: Array || Object,
    },
    components: {
        Panel,
        Title,
        Table,
        Icon,
    },
    data() {
        return {
            search: this.filters.search,
        }
    },
    watch: {
        search: _.throttle(function(value) {
            const route = this.route('admin.users_without_team', { search: value });
            this.$inertia.replace(route);
        }, 200)
    },
}
</script>

