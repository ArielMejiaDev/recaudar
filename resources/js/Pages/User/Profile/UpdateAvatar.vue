<template>
    <div class="w-full flex flex-col lg:flex-row items-start mt-16">

        <div class="w-full lg:w-4/12 mb-6 lg:mb-0 lg:pr-12">
            <Title info="This avatar would be public.">Change Avatar.</Title>
        </div>

        <div class="w-full lg:w-8/12">
            <form @submit.prevent="submit">
                <Panel class="w-full">
                    <template v-slot:header>
                        <Title info="This would be your profile image.">Change Avatar</Title>
                    </template>
                    <template v-slot:body>
                        <AvatarUploader :current-file="$page.auth.user.avatar" name="avatar" v-model="form.avatar" :errors="$page.errors.avatar" />
                    </template>
                    <template v-slot:footer>
                        <LoadingButton :loading="sending">Change avatar</LoadingButton>
                    </template>
                </Panel>
            </form>
        </div>

    </div>
</template>

<script>
import Panel from "../../../Shared/Panel";
import Title from "../../../Shared/Title";
import AvatarUploader from "../../../Shared/AvatarUploader";
import LoadingButton from "../../../Shared/LoadingButton";
import Modal from "../../../Shared/Modal";

export default {
    name: "EditAvatar",
    data() {
        return {
            form: {
                avatar: null,
            },
            sending: false,
            confirmation: null,
        }
    },
    components: {
        Panel,
        Title,
        AvatarUploader,
        LoadingButton,
        Modal,
    },
    methods: {
        submit() {
            this.sending = true;
            const form = new FormData();
            // this.form.avatar.forEach((file) => form.append('avatar[]', file));  // For multiple files
            form.append('avatar', this.form.avatar);
            form.append('_method', 'put');
            this.$inertia.post(this.route('profile.update-avatar'), form).then(() => {
                this.sending = false;
                this.confirmation = false;
            });
        },
    },
}
</script>

<style scoped>

</style>
