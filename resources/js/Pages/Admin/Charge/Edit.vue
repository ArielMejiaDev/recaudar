<template>
    <form @submit.prevent="submit">
        <Panel>
            <template v-slot:header>
                <Title info="This settings are used to calculate the amount to collect.">Edit Charge</Title>
            </template>
            <template v-slot:body>
                <Select v-model="form.country" name="Country" label="Country" placeholder="Add a country" :errors="$page.errors.country">
                    <option value="Guatemala">Guatemala</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Panama">Panama</option>
                    <option value="Costa Rica">Costa Rica</option>
                </Select>

                <IconInput v-model="form.country_charge" name="country_charge" label="Country Charge" placeholder="Add a charge for the country" :errors="$page.errors.country_charge" type="number" min="0" max="0.9" step="0.01" >
                    <template v-slot:icon>
                        <Icon name="dollar" />
                    </template>
                </IconInput>

                <Select v-model="form.payment_gateway" name="payment_gateway" label="Payment gateway" placeholder="Add a payment gateway" :errors="$page.errors.payment_gateway">
                    <option value="pagalogt">PagaloGT</option>
                    <option value="pagadito">Pagadito</option>
                    <option value="paypal">Paypal</option>
                    <option value="bac">Bac</option>
                    <option value="payu">PayU</option>
                </Select>

                <IconInput v-model="form.payment_gateway_charge" name="payment_gateway_charge" label="Country Charge" placeholder="Add a charge for the payment charge" :errors="$page.errors.payment_gateway_charge" type="number" min="0" max="0.9" step="0.01" >
                    <template v-slot:icon>
                        <Icon name="dollar" />
                    </template>
                </IconInput>

            </template>

            <template v-slot:footer>
                <LoadingButton :loading="loading">Update charge</LoadingButton>
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
    metaInfo: { title: 'Edit charge' },
    layout: SidebarLayout,
    name: "Edit",
    data() {
        return {
            form: {
                country: this.charge.country,
                country_charge: this.charge.country_charge,
                payment_gateway: this.charge.payment_gateway,
                payment_gateway_charge: this.charge.payment_gateway_charge,
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
    props: {
        charge: Object,
    },
    methods: {
        submit() {
            this.loading = true;
            const route = this.route('admin.charges.update', { charge: this.charge.id})
            this.$inertia.put(route, this.form).then(() => this.loading = false);
        }
    }
}
</script>
