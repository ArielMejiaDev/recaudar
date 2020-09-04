<template>
    <div>

        <Table v-if="can.viewAny_user" title="Users" :searchbox="{show: true, placeholder: 'Buscar'}"
               :action="{show: true, text: 'Create User', link: '/users/create', type: 'info'}"
               v-model="search" :headers="['Users', 'Role', 'Created']"
               :pagination="{show: true, links: users.links}" >
            <template v-slot:tableData>
                <tr v-for="(user, index) in users.data" :key="index">
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.created_at }}</td>
                </tr>
            </template>
        </Table>

        <div v-else class="p-6 w-full bg-gray-300 text-xs uppercase font-bold rounded">You are not allowed to manage users, only the user with id: 1.</div>

<!--        <Pagination-->
<!--            :config="{-->
<!--                links: users.links,-->
<!--                prevLinkText: 'Anterior', prevLink: users.prev_page_url,-->
<!--                nextLinkText: 'Siguiente' , nextLink: users.next_page_url,-->
<!--            }"-->
<!--        />-->

    </div>
</template>

<script>
import _ from "lodash";
import SidebarLayout from "../../Shared/Layouts/SidebarLayout";
import Table from "../../Shared/Table";
import Pagination from "../../Shared/Pagination";

export default {
    name: "Index",
    data() {
        return {
            search: this.filters.search,
        }
    },
    layout: SidebarLayout,
    components: {
        Table,
        Pagination,
    },
    props: {
        users: Object,
        filters: Object,
        can: Object,
    },
    watch: {
        search: _.throttle(function(value) {
            this.$inertia.replace(this.route('users.index', {search: value}));
        }, 200)
    },
}
</script>

<style scoped>

</style>
