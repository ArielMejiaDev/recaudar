<template>
    <form @submit.prevent="submit">
        <Panel>
            <template v-slot:header>
                <Title :info="trans.this_settings_are_used_to_calculate_the_amount_to_collect">{{ trans.create_a_charge }}</Title>
            </template>
            <template v-slot:body>

                <div class="flex flex-col lg:flex-row w-full">

                    <Select class="w-full lg:w-1/2 lg:mr-1" v-model="form.country" name="Country" :label="trans.country" :placeholder="`${$page.global_trans.select} ${trans.country}`" :errors="$page.errors.country">
                        <option value="Guatemala">Guatemala</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Panama">Panama</option>
                        <option value="Costa Rica">Costa Rica</option>
                    </Select>

                    <IconInput class="w-full lg:w-1/2 lg:ml-1" v-model="form.income_charge" name="income" :label="trans.income" :errors="$page.errors.income_charge" type="number" step="0.1" min="0" max="100" :required="false" >
                        <template v-slot:icon>%</template>
                    </IconInput>

                </div>

                <div class="flex flex-col lg:flex-row">

                    <Select class="w-full lg:w-1/2 lg:mr-1" v-model="form.gateway" name="payment_gateway" :label="trans.payment_gateway" :placeholder="`${$page.global_trans.select} ${trans.payment_gateway}`" :errors="$page.errors.gateway">
                        <option value="pagalogt">PagaloGT</option>
                        <option value="pagadito">Pagadito</option>
                        <option value="paypal">Paypal</option>
                        <option value="bac">Bac</option>
                        <option value="payu">PayU</option>
                    </Select>

                    <IconInput class="w-full lg:w-1/2 lg:ml-1" v-model="form.gateway_charge" name="gateway_charge" :label="trans.gateway_charge_percentage" :errors="$page.errors.gateway_charge" type="number" step="0.1" min="0" max="100" :required="false" >
                        <template v-slot:icon>%</template>
                    </IconInput>

                </div>

            </template>

            <template v-slot:footer>
                <LoadingButton :loading="loading">
                    {{ $page.global_trans.create }} {{ trans.charge }}
                </LoadingButton>
            </template>

        </Panel>
    </form>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Panel from "../../../Shared/Panel";
import Title from "../../../Shared/Title";
import Select from "../../../Shared/Select";
import IconInput from "../../../Shared/IconInput";
import LoadingButton from "../../../Shared/LoadingButton";
import Icon from "../../../Shared/Icon";

export default {
    metaInfo: { title: 'Create a charge' },
    layout: SidebarLayout,
    name: "Create",
    data() {
        return {
            form: {
                country: null,
                income_charge: null,
                gateway: null,
                gateway_charge: null,
            },
            loading: false,
        }
    },
    components: {
        Panel,
        Title,
        Select,
        IconInput,
        Icon,
        LoadingButton,
    },
    methods: {
        submit() {
            this.loading = true;
            const route = this.route('admin.charges.store')
            this.$inertia.post(route, this.form).then(() => this.loading = false);
        }
    },
    props: {
        trans: Object,
    },
}
</script>
