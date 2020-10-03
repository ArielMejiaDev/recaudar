<template>
<div>
    <form @submit.prevent="confirmation = !confirmation">
        <Panel>
            <template v-slot:header>
                <Title>{{ trans.create_a_team }}</Title>
            </template>

            <template v-slot:body>

                <Title class="mb-4" :info="trans.the_data_in_this_section_will_be_displayed_on_the_profile_page">{{ trans.profile }}</Title>

                <div class="w-full flex flex-col md:flex-row">

                    <div class="w-full flex flex-col md:flex-row">
                        <div class="w-full md:w-1/3 md:mr-1">
                            <Input name="name" v-model="form.name" :label="trans.organization_name" :errors="$page.errors.name" />
                        </div>

                        <div class="w-full md:w-1/3 md:mx-1">
                            <Input name="beneficiaries" v-model="form.beneficiaries" :label="trans.beneficiaries" type="number" :errors="$page.errors.beneficiaries" />
                        </div>

                        <div class="w-full md:w-1/3 md:ml-1">
                            <Input name="public" v-model="form.public" :label="trans.public" :errors="$page.errors.public" />
                        </div>
                    </div>

                </div>

                <div class="w-full flex flex-col md:flex-row">

                    <div class="w-full md:w-1/2 md:mr-1">
                        <Select name="category" v-model="form.category" :label="trans.category" :placeholder="`${$page.global_trans.select} ${trans.category}`" :errors="$page.errors.category">
                            <option value="Salud">Salud</option>
                            <option value="Educación">Educación</option>
                            <option value="Ambientales">Ambientales</option>
                            <option value="Social">Social</option>
                            <option value="Nutrición">Nutrición</option>
                            <option value="Pobreza">Pobreza</option>
                            <option value="Animales">Animales</option>
                            <option value="Otros">Otros</option>
                        </Select>
                    </div>

                    <Input class="w-full md:w-1/2 md:ml-1" name="impact" v-model="form.impact" :label="trans.impact" :errors="$page.errors.impact" />

                </div>

                <Input name="use_of_funds" v-model="form.use_of_funds" :label="trans.use_of_funds" :errors="$page.errors.use_of_funds" />

                <Textarea name="description" v-model="form.description" :label="trans.description" :errors="$page.errors.description" />

                <hr class="mb-6 mt-12">

                <Title class="mb-8" :info="trans.this_information_will_not_be_publicly_visible">{{ trans.contact }}</Title>

                <div class="w-full flex flex-col md:flex-row">
                    <div class="w-full w-1/3 md:mr-1">
                        <Input name="contact" v-model="form.contact" :label="trans.contact" :errors="$page.errors.contact" />
                    </div>

                    <div class="w-full w-1/3 md:mx-1">
                        <Input name="contact_phone" v-model="form.contact_phone" :label="trans.contact_phone" :errors="$page.errors.contact_phone" type="phone" />
                    </div>

                    <div class="w-full w-1/3 md:ml-1">
                        <Input name="contact_email" v-model="form.contact_email" :label="trans.contact_email" :errors="$page.errors.contact_email" type="email" />
                    </div>
                </div>

                <Input name="office_address" v-model="form.office_address" :label="trans.office_address" :errors="$page.errors.office_address" />

                <hr class="mb-6 mt-12">

                <Title class="mb-8" :info="trans.this_information_will_not_be_publicly_visible">{{ trans.financial_data }}</Title>

                <div class="w-full flex flex-col md:flex-row">
                    <div class="w-full w-1/3 md:mr-1">
                        <Input name="legal_representative" v-model="form.legal_representative" :label="trans.legal_representative" :errors="$page.errors.legal_representative" />
                    </div>

                    <div class="w-full w-1/3 md:mx-1">
                        <Input name="tax_number" v-model="form.tax_number" :label="trans.tax_number" :errors="$page.errors.tax_number" />
                    </div>

                    <div class="w-full w-1/3 md:ml-1">
                        <Select name="country" v-model="form.country" :label="trans.country" :placeholder="`${$page.global_trans.select} ${trans.country}`" :errors="$page.errors.country">
                            <option value="Guatemala">Guatemala</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Panama">Panama</option>
                            <option value="Costa Rica">Costa Rica</option>
                        </Select>
                    </div>
                </div>

                <div class="w-full flex flex-col md:flex-row">
                    <Input class="w-full md:w-1/2 md:mr-1" v-model="form.account_number" name="account_number" :label="trans.account_number" :errors="$page.errors.account_number" />
                    <Input class="w-full md:w-1/2 md:ml-1" v-model="form.bank" name="bank" :label="trans.bank" :errors="$page.errors.bank" />
                </div>

                <div class="flex">
                    <Toggle v-model="form.terms" :link="route('terms-for-teams')" class="mr-4" type="info" name="terms" :label="trans.accept_terms" value="false" errors="$page.errors.terms" />
                </div>

            </template>

            <template v-slot:footer>
                <LoadingButton :loading="sending">{{ $page.global_trans.create }}</LoadingButton>
            </template>

            <Modal
                v-if="confirmation"
                type="danger"
                :title="form.terms === false ? trans.you_must_accept_terms_to_create_a_team : trans.you_will_receive_an_email_when_the_organization_is_approved"
                action-button-text="Ok"
                @close="confirmation = ! confirmation"
                @action="submit()"
            />

        </Panel>
    </form>
</div>
</template>

<script>
import SidebarLayout from "../../Shared/Layouts/SidebarLayout";
import Panel from "../../Shared/Panel";
import Title from "../../Shared/Title";
import Input from "../../Shared/Input";
import Select from "../../Shared/Select";
import Textarea from "../../Shared/Textarea";
import AvatarUploader from "../../Shared/AvatarUploader";
import ImageUploader from "../../Shared/ImageUploader";
import LoadingButton from "../../Shared/LoadingButton";
import Modal from "../../Shared/Modal";
import Toggle from "../../Shared/Toggle";

export default {
    metaInfo: { title: 'Create a team' },
    name: "Create",
    remember: 'form',
    data() {
        return {
            form: {
                name: null,
                beneficiaries: null,
                public: null,
                category: null,
                impact: null,
                use_of_funds: null,
                description: null,
                contact: null,
                contact_phone: null,
                contact_email: null,
                office_address: null,
                legal_representative: null,
                tax_number: null,
                country: null,
                bank: null,
                account_number: null,
                terms: false,
            },
            sending: false,
            confirmation: false,
        }
    },
    layout: SidebarLayout,
    props: {
        trans: Object,
    },
    components: {
        Panel,
        Title,
        Input,
        Select,
        Textarea,
        AvatarUploader,
        ImageUploader,
        LoadingButton,
        Modal,
        Toggle,
    },
    methods: {
        submit() {
            if(this.form.terms === false) {
                return this.confirmation = ! this.confirmation;
            }
            this.sending = true;
            this.$inertia.post(this.route('teams.store'), this.form).then(() => {
                this.sending = false;
                this.confirmation = ! this.confirmation;
            });
        },
    },
}
</script>
