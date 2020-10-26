<template>
    <form @submit.prevent="showModal = !showModal">
    <Panel>
            <template v-slot:header>
                <Title :info="trans.subtitle">{{ trans.title }}</Title>
            </template>
            <template v-slot:body>
                <div class="flex flex-col">
                    <label class="inline-flex items-center my-5 flex">
                        <input v-model="form.plan" name="plan" type="radio" value="free" class="form-radio h-5 w-5 text-gray-400" :checked="form.plan === 'free'">
                        <span class="ml-2 text-gray-700">Free</span>
                        <span class="ml-2 font-bold">($0.00 {{ trans.free_plan_info }})</span>
                    </label>
                    <label class="inline-flex items-center my-5 flex">
                        <input v-model="form.plan" name="plan" type="radio" value="pro" class="form-radio h-5 w-5 text-gray-400" :checked="form.plan === 'pro'">
                        <span class="ml-2 text-gray-700">Pro</span>
                        <span class="ml-2 font-bold">($13.00 {{ trans.pro_plan_info }})</span>
                    </label>
                </div>
            </template>
            <template v-slot:footer>
                <LoadingButton :loading="loading">{{ trans.update_plan }}</LoadingButton>
            </template>
        <Modal
            v-if="showModal"
            type="danger"
            :title="trans.modal_title"
            :info="trans.modal_info"
            :close-button-text="trans.cancel"
            :action-button-text="trans.update_plan"
            @action="submit()"
            @close="showModal = !showModal" />

    </Panel>
    </form>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Panel from "../../../Shared/Panel";
import Title from "../../../Shared/Title";
import ListItem from "../../../Shared/ListItem";
import Modal from "../../../Shared/Modal";
import LoadingButton from "../../../Shared/LoadingButton";

export default {
    name: "SwitchPlan",
    layout: SidebarLayout,
    components: {
        Panel,
        Title,
        ListItem,
        Modal,
        LoadingButton,
    },
    data() {
        return {
            loading: false,
            showModal: false,
            form: {
                plan: this.team.plan,
            }
        }
    },
    props: {
        trans: Object,
        team: Object,
    },
    methods: {
        submit() {
            this.showModal = !this.showModal;
            this.loading = true;
            const route = this.route('teams.switch-plan.update', {team: this.$page.team['slug'] });
            this.$inertia.put(route, this.form).then(() => this.loading = false);
        }
    },
}
</script>

