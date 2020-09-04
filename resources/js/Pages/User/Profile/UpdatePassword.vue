<template>
    <div class="w-full flex flex-col lg:flex-row items-start mt-16">

        <div class="w-full lg:w-4/12 mb-6 lg:mb-0 lg:pr-12">
            <Title info="Be careful, if you change the password, this change cannot be revert.">Change password</Title>
        </div>

        <div class="w-full lg:w-8/12">
            <form @submit.prevent="confirmation = !confirmation">
                <Panel class="w-full">
                    <template v-slot:header>
                        <Title info="You must confirm the new password to update it.">Change Password</Title>
                    </template>
                    <template v-slot:body>
                        <Input name="password" label="Current password" :required="false" type="password" placeholder="type your current password."  v-model="form.password" :errors="$page.errors.password" />
                        <Input name="new_password" label="New password" :required="false" type="password" placeholder="type your new password."  v-model="form.new_password" :errors="$page.errors.new_password" />
                        <Input name="new_password_confirmation" label="Confirm new password" :required="false" type="password" placeholder="type your new password again."  v-model="form.new_password_confirmation" :errors="$page.errors.new_password_confirmation" />
                    </template>
                    <template v-slot:footer>
                        <LoadingButton :loading="sending" type="danger">Change password</LoadingButton>
                    </template>
                </Panel>
            </form>
        </div>

        <Modal
            v-if="confirmation"
            type="danger"
            title="Are you sure?"
            info="This change cannot be revert!"
            close-button-text="Close"
            action-button-text="Change Password"
            @close="confirmation = !confirmation"
            @action="submit" />

    </div>
</template>

<script>
import Panel from "../../../Shared/Panel";
import Input from "../../../Shared/Input";
import Title from "../../../Shared/Title";
import LoadingButton from "../../../Shared/LoadingButton";
import Modal from "../../../Shared/Modal";

export default {
    name: "ChangePassword",
    data() {
        return {
            form: {
                password: null,
                new_password: null,
                new_password_confirmation: null,
            },
            sending: false,
            confirmation: null,
        }
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
            this.sending = true;
            this.$inertia.put(this.route('profile.update-password'), this.form).then(() => {
                this.sending = false;
                this.confirmation = false;
            });
        },
    },
}
</script>

<style scoped>

</style>
