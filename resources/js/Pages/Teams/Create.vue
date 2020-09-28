<template>
<div>
    <form @submit.prevent="confirmation = !confirmation">
        <Panel>
            <template v-slot:header>
                <Title>Create a Team</Title>
            </template>

            <template v-slot:body>

                <Title class="mb-4" info="This data would be shown in team profile page.">Profile</Title>

                <div class="w-full flex flex-col md:flex-row">

                    <div class="w-full flex flex-col md:flex-row">
                        <div class="w-full md:w-1/3 md:mr-1">
                            <Input name="name" v-model="form.name" label="Organization name" placeholder="The organization name." :errors="$page.errors.name" />
                        </div>

                        <div class="w-full md:w-1/3 md:mx-1">
                            <Input name="beneficiaries" v-model="form.beneficiaries" label="Beneficiaries" type="number" placeholder="Add number of beneficiaries" :errors="$page.errors.beneficiaries" />
                        </div>

                        <div class="w-full md:w-1/3 md:ml-1">
                            <Input name="public" v-model="form.public" label="Public" placeholder="Public" :errors="$page.errors.public" />
                        </div>
                    </div>

                </div>

                <div class="w-full flex flex-col md:flex-row">

                    <div class="w-full md:w-1/2 md:mr-1">
                        <Select name="category" v-model="form.category" label="Category" placeholder="Select the organization category" :errors="$page.errors.category">
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

                    <Input class="w-full md:w-1/2 md:ml-1" name="impact" v-model="form.impact" label="Impact" placeholder="Add a brief organization impact" :errors="$page.errors.impact" />

                </div>

                <Input name="use_of_funds" v-model="form.use_of_funds" label="Use of funds" placeholder="How the organization use the funds..." :errors="$page.errors.use_of_funds" />

                <Textarea name="description" v-model="form.description" label="Description" placeholder="Add an organization description..." :errors="$page.errors.description" />

                <hr class="mb-6 mt-12">

                <Title class="mb-8" info="This information would not be shown publicly.">Contact</Title>

                <div class="w-full flex flex-col md:flex-row">
                    <div class="w-full w-1/3 md:mr-1">
                        <Input name="contact" v-model="form.contact" label="Contact" placeholder="Add a contact name" :errors="$page.errors.contact" />
                    </div>

                    <div class="w-full w-1/3 md:mx-1">
                        <Input name="contact_phone" v-model="form.contact_phone" label="Contact Phone" placeholder="Add contact phone" :errors="$page.errors.contact_phone" type="phone" />
                    </div>

                    <div class="w-full w-1/3 md:ml-1">
                        <Input name="contact_email" v-model="form.contact_email" label="Contact Email" placeholder="Add contact email" :errors="$page.errors.contact_email" type="email" />
                    </div>
                </div>

                <Input name="office_address" v-model="form.office_address" label="Office Address" placeholder="Add office address" :errors="$page.errors.office_address" />

                <hr class="mb-6 mt-12">

                <Title class="mb-8" info="This information would not be shown publicly.">Financial data</Title>

                <div class="w-full flex flex-col md:flex-row">
                    <div class="w-full w-1/3 md:mr-1">
                        <Input name="legal_representative" v-model="form.legal_representative" label="Legal Representative" placeholder="Add the name of the legal representative" :errors="$page.errors.legal_representative" />
                    </div>

                    <div class="w-full w-1/3 md:ml-1">
                        <Input name="tax_number" v-model="form.tax_number" label="Tax Number" placeholder="Add the organization tax number." :errors="$page.errors.tax_number" />
                    </div>

                    <div class="w-full w-1/3 md:ml-1">
                        <Select name="country" v-model="form.country" label="Country" placeholder="Country where team is established." :errors="$page.errors.country">
                            <option value="Guatemala">Guatemala</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Panama">Panama</option>
                            <option value="Costa Rica">Costa Rica</option>
                        </Select>
                    </div>
                </div>

                <div class="w-full flex flex-col md:flex-row">
                    <Input class="w-full md:w-1/2 md:mr-1" v-model="form.account_number" name="account_number" label="Bank account number" placeholder="Add an account number" :errors="$page.errors.account_number" />
                    <Input class="w-full md:w-1/2 md:ml-1" v-model="form.bank" name="bank" label="Bank" placeholder="Add a bank" :errors="$page.errors.bank" />
                </div>

                <div class="flex">
                    <Toggle v-model="form.terms" :link="route('terms-for-teams')" class="mr-4" type="info" name="terms" label="Accept terms & conditions" value="false" errors="$page.errors.terms" />
                </div>

            </template>

            <template v-slot:footer>
                <LoadingButton :loading="sending">Create</LoadingButton>
            </template>

            <Modal
                v-if="confirmation"
                type="danger"
                :title="form.terms === false ? 'You must accept terms to create a team' : 'The team must be appoved to manage your team and plans.'"
                :info="form.terms === false ? '' : 'You will receive an email when your team is confirmed.'"
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
