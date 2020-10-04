<template>
    <div>
        <Table
            :title="trans.charges"
            :headers="[trans.country, trans.payment_gateway, trans.delete]"
            :searchbox="{show: true, placeholder: `${trans.search}...`}"
            v-model="search"
            :action="{show: true, text: trans.create_a_charge, link: route('admin.charges.create'), type: 'info'}"
            :pagination="{show: true, links: charges.links}">
            <template v-slot:tableData>
                <tr v-for="(charge, index) in charges.data" :key="index">
                    <td>
                        <InertiaLink :href="route('admin.charges.show', { charge: charge.id })">{{ charge.country }}</InertiaLink>
                    </td>
                    <td>
                        <InertiaLink :href="route('admin.charges.show', { charge: charge.id })">{{ charge.gateway }}</InertiaLink>
                    </td>
                    <td @click="confirm = !confirm;selectedCharge = charge">
                        <Icon name="trash" class="text-gray-500 hover:text-gray-600 cursor-pointer" />
                    </td>
                </tr>
            </template>
        </Table>
        <Modal
            v-if="confirm"
            type="danger"
            :title="`${trans.are_you_sure_to_delete_charge_for} ${selectedCharge.gateway} ${trans.in} ${selectedCharge.country}?`"
            :info="trans.this_action_will_invalid_this_charge"
            :close-button-text="$page.global_trans.cancel"
            :action-button-text="`${trans.delete} ${trans.charge}`"
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
        trans: Object,
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
