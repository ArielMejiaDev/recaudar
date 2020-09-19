<template>
    <form @submit.prevent="submit">
        <Panel>
            <template v-slot:header>
                <Title>Edit a plan</Title>
            </template>
            <template v-slot:body>
                <Input v-model="form.title" name="title" label="Title" placeholder="Add a title" :errors="$page.errors.title" />
                <span v-if="toggle" @click="showAmountInput" class="text-blue-500 font-bold text-sm leading-loose tracking-tighter hover:underline hover:text-blue-600 cursor-pointer focus:outline-none focus:text-blue-600 focus:underline">Variable amount</span>
                <span v-if="!toggle" @click="showAmountInput" class="text-blue-500 font-bold text-sm leading-loose tracking-tighter hover:underline hover:text-blue-600 cursor-pointer focus:outline-none focus:text-blue-600 focus:underline">Add amount</span>

                <div v-show="toggle" class="w-full flex flex-col md:flex-row">

                    <IconInput ref="amount_in_local_currency" v-model="form.amount_in_local_currency" class="w-full md:w-1/2 md:mr-1" name="amount_in_local_currency" placeholder="Amount in local currency" :required="false">
                        <template v-slot:icon>Q</template>
                    </IconInput>

                    <IconInput v-model="form.amount_in_dollars" class="w-full md:w-1/2 md:mr-1" name="amount_in_dollars" placeholder="Amount in dollars" :required="false">
                        <template v-slot:icon>$</template>
                    </IconInput>

                </div>

                <Textarea v-model="form.info" name="info" label="Optional information about the plan" placeholder="Add plans info ..." :errors="$page.errors.info" :required="false" />

                <ImageUploader v-model="form.banner" :current-file="plan.banner" name="banner" label="Plans banner" :errors="$page.errors.banner" />

            </template>
            <template v-slot:footer>
                <LoadingButton :loading="loading">Update plan</LoadingButton>
            </template>
        </Panel>
    </form>
</template>

<script>
import SidebarLayout from "../../../../Shared/Layouts/SidebarLayout";
import Panel from "../../../../Shared/Panel";
import Title from "../../../../Shared/Title";
import Input from "../../../../Shared/Input";
import IconInput from "../../../../Shared/IconInput";
import Icon from "../../../../Shared/Icon";
import Textarea from "../../../../Shared/Textarea";
import ImageUploader from "../../../../Shared/ImageUploader";
import LoadingButton from "../../../../Shared/LoadingButton";

export default {
    metaInfo: { title: 'Edit plan' },
    layout: SidebarLayout,
    name: "Edit",
    components: {
        Panel,
        Title,
        Input,
        IconInput,
        Icon,
        Textarea,
        ImageUploader,
        LoadingButton,
    },
    data() {
        return {
            toggle: true,
            loading: false,
            form: {
                title: this.plan.title,
                amount_in_local_currency: this.local_format(this.plan.amount_in_local_currency),
                amount_in_dollars: this.dollar_format(this.plan.amount_in_dollars),
                info: this.plan.info,
                banner: null,
            }
        }
    },
    props: {
        team: Object,
        plan: Object,
    },
    methods: {
        showAmountInput() {
            this.toggle = !this.toggle;
            // if(this.toggle) {
            //     this.$nextTick(() => this.$refs.amount_in_local_currency.focus());
            // }
        },
        dollar_format(value) {
            return new Intl.NumberFormat('en-US', {
                currency: 'USD',
                minimumFractionDigits: 2
            }).format(value);
        },
        local_format(value, countryCode = 'es-GT', currencyCode = 'GTQ') {
            return new Intl.NumberFormat(countryCode, {
                currency: currencyCode,
                minimumFractionDigits: 2
            }).format(value);
        },
        submit() {
            this.loading = true;
            const route = this.route('admin.teams.plans.update', { team: this.team.id, plan: this.plan.id });
            const form = new FormData;
            form.append('title', this.form.title || '');
            form.append('amount_in_local_currency', this.form.amount_in_local_currency || '');
            form.append('amount_in_dollars', this.form.amount_in_dollars || '');
            form.append('info', this.form.info || '');
            form.append('banner', this.form.banner || '');
            form.append('_method', 'put');
            this.$inertia.post(route, form).then(() => this.loading = false);
        }
    }
}
</script>

<style scoped>

</style>
