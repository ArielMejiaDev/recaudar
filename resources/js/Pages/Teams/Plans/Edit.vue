<template>
    <div class="w-full flex flex-col lg:flex-row">

        <div class="w-full lg:w-1/3 mb-6 lg:mb-0">
            <Title :info="trans.this_data_would_be_public_from_team_profile_site">{{ trans.edit_a_plan }}</Title>
        </div>

        <form @submit.prevent="submit" class="w-full lg:w-2/3">
            <Panel>
                <template v-slot:body>

                    <Input v-model="form.title" ref="title" name="title" :label="trans.title" :errors="$page.errors.title" />

                    <div class="w-full flex flex-col md:flex-row">

                        <IconInput v-model="form.amount_in_local_currency" class="w-full md:w-1/2 md:mr-1" name="amount_in_local_currency" :errors="$page.errors.amount_in_local_currency">
                            <template v-slot:icon>
                                <span class="text-xs">{{ locale.currency }}</span>
                            </template>
                        </IconInput>

                        <IconInput v-model="form.amount_in_dollars" class="w-full md:w-1/2 md:mr-1" name="amount_in_dollars" :errors="$page.errors.amount_in_dollars">
                            <template v-slot:icon>
                                <span class="text-xs">USD</span>
                            </template>
                        </IconInput>

                    </div>

                    <Textarea v-model="form.info" name="info" :label="trans.information_about_the_plan" :errors="$page.errors.info" />

                    <div class="w-full">
                        <ImageUploader v-model="form.banner" :current-file="plan.banner" name="banner" label="Banner" :errors="$page.errors.banner" />
                    </div>

                </template>
                <template v-slot:footer>
                    <LoadingButton :loading="loading">
                        {{ $page.global_trans.update }}
                    </LoadingButton>
                </template>
            </Panel>
        </form>

    </div>
</template>

<script>
import Title from "../../../Shared/Title";
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Panel from "../../../Shared/Panel";
import Input from "../../../Shared/Input";
import LoadingButton from "../../../Shared/LoadingButton";
import Textarea from "../../../Shared/Textarea";
import Select from "../../../Shared/Select";
import ImageUploader from "../../../Shared/ImageUploader";
import IconInput from "../../../Shared/IconInput";

export default {
    metaInfo: { title: 'Edit a plan' },
    name: "Edit",
    data() {
        return {
            form: {
                title: this.plan.title,
                info: this.plan.info,
                amount_in_local_currency: this.local_format(this.plan.amount_in_local_currency),
                amount_in_dollars: this.dollar_format(this.plan.amount_in_dollars),
                banner: null,
            },
            loading: false,
        }
    },
    layout: SidebarLayout,
    components: {
        Title,
        Panel,
        Input,
        IconInput,
        Select,
        Textarea,
        ImageUploader,
        LoadingButton,
    },
    props: {
        team: Object,
        plan: Object,
        locale: Object,
        trans: Object,
    },
    methods: {
        showAmountInput() {
            this.toggle = !this.toggle;
            this.text = 'Add amount';
            if(this.toggle) {
                this.$nextTick(() => this.$refs.amount.focus());
            }
        },
        submit() {
            this.loading = true;
            const form = new FormData();
            form.append('title', this.form.title);
            form.append('amount_in_local_currency', this.form.amount_in_local_currency || '');
            form.append('amount_in_dollars', this.form.amount_in_dollars || '');
            form.append('info', this.form.info);
            form.append('banner', this.form.banner || '');
            form.append('_method', 'put');
            const route = this.route('teams.plans.update', { team: this.$page.team['slug'], plan: this.plan.id});
            this.$inertia.post(route, form)
                .then(() => this.loading = false)
        },
        dollar_format(value) {
            return new Intl.NumberFormat('en-US', {
                currency: 'USD',
                minimumFractionDigits: 2
            }).format(value);
        },
        local_format(value, style = 'currency', countryCode = 'es-GT', currencyCode = 'GTQ') {
            return new Intl.NumberFormat(countryCode, {
                currency: currencyCode,
                minimumFractionDigits: 2
            }).format(value);
        },
    },
}
</script>
