<template>
    <div class="w-full flex flex-col lg:flex-row">

        <div class="w-full lg:w-1/3 mb-6 lg:mb-0">
            <Title info="This data would be public from team profile site.">Create a plan</Title>
        </div>

        <form @submit.prevent="submit" class="w-full lg:w-2/3">
            <Panel>
                <template v-slot:body>










                    <Input v-model="form.title" ref="title" name="title" label="Title" placeholder="Add plans title" :errors="$page.errors.title" />


                    <span v-if="toggle" @click="showAmountInput" class="text-blue-500 font-bold text-sm leading-loose tracking-tighter hover:underline hover:text-blue-600 cursor-pointer focus:outline-none focus:text-blue-600 focus:underline">Variable amount</span>
                    <span v-if="!toggle" @click="showAmountInput" class="text-blue-500 font-bold text-sm leading-loose tracking-tighter hover:underline hover:text-blue-600 cursor-pointer focus:outline-none focus:text-blue-600 focus:underline">Add amount</span>

                    <div v-show="toggle" class="w-full flex flex-col md:flex-row">

                        <IconInput v-model="form.amount_in_local_currency" class="w-full md:w-1/2 md:mr-1" name="amount_in_local_currency" placeholder="Amount in local currency" :required="false">
                            <template v-slot:icon>Q</template>
                        </IconInput>

                        <IconInput v-model="form.amount_in_dollars" class="w-full md:w-1/2 md:mr-1" name="amount_in_dollars" placeholder="Amount in dollars" :required="false">
                            <template v-slot:icon>$</template>
                        </IconInput>

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
import IconInput from "../../../Shared/IconInput";
import Icon from "../../../Shared/Icon";

export default {
    metaInfo: { title: 'Create a plan' },
    name: "Create",
    data() {
        return {
            toggle: true,
            form: {
                title: null,
                amount_in_local_currency: null,
                amount_in_dollars: null,
                info: null,
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
        Icon,
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
            form.append('amount_in_local_currency', this.form.amount_in_local_currency || '');
            form.append('amount_in_dollars', this.form.amount_in_dollars || '');
            form.append('info', this.form.info);
            form.append('banner', this.form.banner || '');
            const route = this.route('teams.plans.store', { team: this.$page.team['slug']});
            this.$inertia.post(route, form)
                .then(() => this.loading = false)
        },
    },
}
</script>
