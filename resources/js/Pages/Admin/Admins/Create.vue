<template>
    <form @submit.prevent="showModal = !showModal">
        <Panel>
            <template v-slot:header>
                <Title :info="trans.subtitle">{{ trans.title }}</Title>
            </template>
            <template v-slot:body>
                <Input v-model="form.name" name="name" :label="trans.name" :errors="$page.errors.name" />
                <Input v-model="form.email" name="email" :label="trans.email" type="email" :errors="$page.errors.name" />
            </template>
            <template v-slot:footer>
                <LoadingButton :loading="loading">{{ trans.create }}</LoadingButton>
            </template>
        </Panel>
        <Modal v-if="showModal" type="danger" title="An admin user can manage the entire app" info="Be careful with admin users" close-button-text="Close" @close="showModal = !showModal" action-button-text="Create admin user" @action="showModal = !showModal; submit()" />
    </form>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Input from "../../../Shared/Input";
import LoadingButton from "../../../Shared/LoadingButton";
import Panel from "../../../Shared/Panel";
import Title from "../../../Shared/Title";
import Modal from "../../../Shared/Modal";

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

