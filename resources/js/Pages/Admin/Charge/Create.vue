<template>
    <form @submit.prevent="submit">
        <Panel>
            <template v-slot:header>
                <Title info="This settings are used to calculate the amount to collect.">Create Charge</Title>
            </template>
            <template v-slot:body>

                <div class="flex">

                    <Select class="w-full md:w-1/2 md:mr-1" v-model="form.country" name="Country" label="Country" placeholder="Add a country" :errors="$page.errors.country">
                        <option value="Guatemala">Guatemala</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Panama">Panama</option>
                        <option value="Costa Rica">Costa Rica</option>
                    </Select>

                    <IconInput class="w-full md:w-1/2 md:ml-1" v-model="form.income" name="income" label="Income" placeholder="Add an income" :errors="$page.errors.income" type="number" min="0" max="9.9" step="0.10" :required="false" >
                        <template v-slot:icon>%</template>
                    </IconInput>

                </div>

                <div class="flex">

                    <Select class="w-full md:w-1/2 md:mr-1" v-model="form.gateway" name="payment_gateway" label="Payment gateway" placeholder="Add a payment gateway" :errors="$page.errors.gateway">
                        <option value="pagalogt">PagaloGT</option>
                        <option value="pagadito">Pagadito</option>
                        <option value="paypal">Paypal</option>
                        <option value="bac">Bac</option>
                        <option value="payu">PayU</option>
                    </Select>

                    <IconInput class="w-full md:w-1/2 md:ml-1" v-model="form.gateway_charge" name="gateway_charge" label="Gateway charge percentage" placeholder="Add a charge for the payment charge percentage" :errors="$page.errors.gateway_charge" type="number" min="0" max="100" :required="false" >
                        <template v-slot:icon>%</template>
                    </IconInput>

                </div>

            </template>

            <template v-slot:footer>
                <LoadingButton :loading="loading">Create charge</LoadingButton>
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
                income: null,
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
    }
}
</script>
