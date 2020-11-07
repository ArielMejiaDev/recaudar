<template>
    <div>
        <Table
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
    </div>
</template>

<script>
import SidebarLayout from "../../../../Shared/Layouts/SidebarLayout";
import Table from "../../../../Shared/Table";
import Title from "../../../../Shared/Title";
import Panel from "../../../../Shared/Panel";
import _ from "lodash";

export default {
    name: "Index",
    metaInfo: { title: 'Users without organizations' },
    layout: SidebarLayout,
    props: {
        users: Object,
        trans: Object,
        filters: Array || Object,
    },
    components: {
        Panel,
        Title,
        Table,
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

