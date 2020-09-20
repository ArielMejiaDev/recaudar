<template>
    <div>
        <Table
            title="Teams"
            :headers="['country', 'payment gateway', 'Delete']"
            :searchbox="{show: true, placeholder: 'Search ...'}"
            v-model="search"
            :action="{show: true, text: 'Create a charge', link: route('admin.charges.create'), type: 'info'}"
            :pagination="{show: true, links: charges.links}">
            <template v-slot:tableData>
                <tr v-for="(charge, index) in charges.data" :key="index">
                    <td>
                        <InertiaLink :href="route('admin.charges.edit', { charge: charge.id })">{{ charge.country }}</InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('admin.charges.edit', { charge: charge.id })">{{ charge.payment_gateway }}</InertiaLink>
                    </td>
                    <td @click="confirm = !confirm;selectedCharge = charge">
                        <Icon name="trash" class="text-gray-500 hover:text-gray-600" />
                    </td>
                </tr>
            </template>
        </Table>
        <Modal
            v-if="confirm"
            type="danger"
            :title="`Are you sure to change charge for ${selectedCharge.payment_gateway} in ${selectedCharge.country}?`"
            info="This action will invalid this charge."
            close-button-text="Cancel"
            action-button-text="Delete charge"
            @close="confirm = !confirm;"
            @action="deleteCharge();confirm = !confirm"
        />
    </div>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Table from "../../../Shared/Table";
import Modal from "../../../Shared/Modal";
import _ from "lodash";
import Icon from "../../../Shared/Icon";

export default {
    metaInfo: { title: 'Charges'},
    layout: SidebarLayout,
    name: "Index",
    data() {
        return {
            search: this.filters.search,
            confirm: false,
            selectedCharge: null,
        }
    },
    components: {
        Table,
        Icon,
        Modal,
    },
    props: {
        charges: Object,
        filters: Array | Object,
    },
    methods: {
        deleteCharge() {
            const route = this.route('admin.charges.destroy', {charge: this.selectedCharge.id});
            this.$inertia.delete(route);
        }
    },
    watch: {
        search: _.throttle(function(value) {
            const route = this.route('admin.charges.index', { search: value });
            this.$inertia.replace(route);
        }, 200)
    },
}
</script>

<style scoped>

</style>
