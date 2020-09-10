<template>
    <div class="w-full flex flex-col lg:flex-row">

        <div class="w-full lg:w-1/3 mb-6 lg:mb-0">
            <Title info="This data would be public from team profile site.">Create a plan</Title>
        </div>

        <form @submit.prevent="submit" class="w-full lg:w-2/3">
            <Panel>
                <template v-slot:body>

                    <div class="w-full flex flex-col lg:flex-row">
                        <div class="w-full lg:w-1/2 lg:mr-1">
                            <Input v-model="form.title" ref="title" name="title" label="Title" placeholder="Add plans title" :errors="$page.errors.title" />
                        </div>
                        <div class="w-full lg:w-1/2 lg:ml-1">
                            <Select v-model="form.currency" name="currency" label="Plans currency" placeholder="Please select a currency for the plan" :errors="$page.errors.currency">
                                <option value="GTQ">Quetzales</option>
                                <option value="USD">Dollars</option>
                            </Select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center">
                            <label v-if="toggle" for="amount" class="text-sm text-gray-600 block mb-1 mr-4">Amount</label>
                            <span v-if="toggle" @click="showAmountInput" class="text-blue-500 font-bold text-sm leading-loose tracking-tighter hover:underline hover:text-blue-600 cursor-pointer focus:outline-none focus:text-blue-600 focus:underline">Variable amount</span>
                            <span v-if="!toggle" @click="showAmountInput" class="text-blue-500 font-bold text-sm leading-loose tracking-tighter hover:underline hover:text-blue-600 cursor-pointer focus:outline-none focus:text-blue-600 focus:underline">Add amount</span>
                        </div>
                        <input v-model="form.amount" v-show="toggle" ref="amount" id="amount" name="amount" type="number" required="required" autocomplete="off" placeholder="Add an amount for the plan..." class="w-full form-input rounded-lg" :required="false">
                        <p v-if="$page.errors.amount" class="text-red-600 text-xs font-bold my-1">{{ $page.errors.amount[0] }}</p>
                    </div>

                    <Textarea v-model="form.info" name="info" label="Optional information about the plan" placeholder="Add plans info ..." :errors="$page.errors.info" :required="false" />

                    <div class="w-full">
                        <ImageUploader v-model="form.banner" name="banner" label="Plans banner" :errors="$page.errors.banner" />
                    </div>

                </template>
                <template v-slot:footer>
                    <LoadingButton :loading="loading">Create a plan</LoadingButton>
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

export default {
    metaInfo: { title: 'Create a plan' },
    name: "Create",
    data() {
        return {
            toggle: true,
            form: {
                title: null,
                info: null,
                currency: null,
                amount: null,
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
        Select,
        Textarea,
        ImageUploader,
        LoadingButton,
    },
    props: {
        team: Object,
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
            form.append('currency', this.form.currency);
            form.append('amount', this.form.amount || '');
            form.append('info', this.form.info);
            form.append('banner', this.form.banner || '');
            const route = this.route('teams.plans.store', { team: this.$page.team['slug']});
            this.$inertia.post(route, form)
                .then(() => this.loading = false)
        },
    },
}
</script>
