<template>
    <form @submit.prevent="showModal = !showModal">
        <Panel>
            <template v-slot:header>
                <Title :info="trans.subtitle">{{ trans.title }}</Title>
            </template>
            <template v-slot:body>
                <Input v-model="form.name" name="name" :label="trans.name" :errors="$page.errors.name" />
                <Input v-model="form.email" name="email" :label="trans.email" type="email" :errors="$page.errors.name" />
                <Select v-model="form.role" name="role" :label="trans.role" :placeholder="`${$page.global_trans.select} ${trans.role}`" :errors="$page.errors.role">
                    <option value="app_admin">{{ trans.admin }}</option>
                    <option value="app_editor">{{ trans.editor }}</option>
                    <option value="app_financial">{{ trans.financial }}</option>
                </Select>
            </template>
            <template v-slot:footer>
                <LoadingButton :loading="loading">{{ trans.create }}</LoadingButton>
            </template>
        </Panel>
        <Modal v-if="showModal" type="danger" :title="trans.subtitle" :info="trans.be_careful_when_adding_new_administrators" :close-button-text="$page.global_trans.cancel" @close="showModal = !showModal" :action-button-text="$page.global_trans.create" @action="showModal = !showModal; submit()" />
    </form>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Input from "../../../Shared/Input";
import LoadingButton from "../../../Shared/LoadingButton";
import Panel from "../../../Shared/Panel";
import Title from "../../../Shared/Title";
import Modal from "../../../Shared/Modal";
import Select from "../../../Shared/Select";

export default {
    metaInfo: { title: 'Create app admin' },
    layout: SidebarLayout,
    name: "Create",
    data() {
        return {
            loading: false,
            showModal: false,
            form: {
                name: null,
                email: null,
                role: null,
            }
        }
    },
    props: {
        trans: Object,
    },
    components: {
        Title,
        Panel,
        Input,
        LoadingButton,
        Modal,
        Select,
    },
    methods: {
        submit() {
            this.loading = true;
            const route = this.route('admin.admins.store')
            this.$inertia.post(route, this.form)
                .then(() => this.loading = false);
        }
    },
}
</script>

