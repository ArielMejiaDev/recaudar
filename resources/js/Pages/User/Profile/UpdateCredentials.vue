<template>
    <form @submit.prevent="confirmation = !confirmation">


        <div class="w-full flex flex-col lg:flex-row items-start">

            <div class="w-full lg:w-4/12 mb-6 lg:mb-0 lg:pr-12">
                <Title :info="trans.this_are_the_credentials_to_login">
                    {{ trans.profile }}
                </Title>
            </div>

            <div class="w-full lg:w-8/12">
                <Panel class="w-full">
                    <template v-slot:header>
                        <Title>{{ trans.change_credentials }}</Title>
                    </template>

                    <template v-slot:body>
                        <Input :label="trans.name" name="name" v-model="form.name" :errors="$page.errors.name" />
                        <Input :label="trans.email" name="email" type="email" v-model="form.email" :errors="$page.errors.email" />
                    </template>

                    <template v-slot:footer>
                        <LoadingButton :loading="sending">{{ $page.global_trans.update }}</LoadingButton>
                    </template>
                </Panel>
            </div>

        </div>

        <Modal
            v-if="confirmation"
            :title="$page.global_trans.are_you_sure_to_update_the_record"
            :close-button-text="$page.global_trans.cancel"
            :action-button-text="$page.global_trans.update"
            @close="confirmation = false"
            @action="submit();confirmation = false" />

    </form>
</template>

<script>
import Panel from "../../../Shared/Panel";
import Title from "../../../Shared/Title";
import Modal from "../../../Shared/Modal";
import Input from "../../../Shared/Input";
import LoadingButton from "../../../Shared/LoadingButton";

export default {
    name: "EditUser",
    data: () => ({
        form: {
            name: null,
            email: null,
        },
        sending: false,
        confirmation: false,
    }),
    props: {
        trans: Object,
    },
    components: {
        Panel,
        Title,
        Input,
        LoadingButton,
        Modal,
    },
    methods: {
        submit() {
            this.sending = true;
            this.$inertia.put(this.route('profile.update-credentials'), this.form).then(() => this.sending = false);
        },
    },
    created() {
        this.form.name = this.$page.auth.user.name;
        this.form.email = this.$page.auth.user.email;
    }
}
</script>

<style scoped>

</style>
