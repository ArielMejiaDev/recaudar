<template>
<div>
    <form @submit.prevent="confirmation = !confirmation">
        <Panel>
            <template v-slot:header>
                <Title info="This information is necessary to create a team profile.">Create a Team</Title>
            </template>

            <template v-slot:body>

                <div class="w-full flex flex-col md:flex-row">
                    <div class="w-full w-1/2 md:mr-1">
                        <Input name="name" v-model="form.name" label="Organization name" placeholder="The organization name." :errors="$page.errors.name" />
                    </div>

                    <div class="w-full w-1/2 md:ml-1">
                        <Select name="category" v-model="form.category" label="Category" placeholder="Select the organization category" :errors="$page.errors.category">
                            <option value="null" disabled selected>Select a category</option>
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
                </div>

                <Textarea name="description" v-model="form.description" label="Description" placeholder="Add an organization description..." :errors="$page.errors.description" />

                <div class="w-full flex flex-col md:flex-row">
                    <div class="w-full w-1/2 md:mr-1">
                        <Input name="public" v-model="form.public" label="Target Public" placeholder="Public" :errors="$page.errors.public" />
                    </div>

                    <div class="w-full w-1/2 md:ml-1">
                        <Input name="beneficiaries" v-model="form.beneficiaries" label="Beneficiaries" type="number" placeholder="Add number of beneficiaries" :errors="$page.errors.beneficiaries" />
                    </div>
                </div>

                <Textarea name="impact" v-model="form.impact" label="Impact" placeholder="Add a brief organization impact" :errors="$page.errors.impact" />

                <div class="w-full flex flex-col md:flex-row">
                    <div class="w-full w-1/2 md:mr-1">
                        <Input name="legal_representative" v-model="form.legal_representative" label="Legal Representative" placeholder="Add the name of the legal representative" :errors="$page.errors.legal_representative" />
                    </div>

                    <div class="w-full w-1/2 md:ml-1">
                        <Input name="tax_number" v-model="form.tax_number" label="Tax Number" placeholder="Add the organization tax number." :errors="$page.errors.tax_number" />
                    </div>
                </div>

                <Input name="office_address" v-model="form.office_address" label="Office Address" placeholder="Add office address" :errors="$page.errors.office_address" />

                <Textarea name="use_of_funds" v-model="form.use_of_funds" label="Use of funds" placeholder="How the organization use the funds..." :errors="$page.errors.use_of_funds" />

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


            </template>

            <template v-slot:footer>
                <LoadingButton :loading="sending">Create</LoadingButton>
            </template>

            <Modal
                v-if="confirmation"
                type="danger"
                title="The team must be appoved to manage your team and plans."
                info="You will receive an email when your team is confirmed."
                action-button-text="Ok"
                @action="submit();confirmation = !confirmation"
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

export default {
    metaInfo: { title: 'Create a team' },
    name: "Create",
    remember: 'form',
    data() {
        return {
            form: {
                name: null,
                category: null,
                description: null,
                public: null,
                beneficiaries: null,
                impact: null,
                legal_representative: null,
                tax_number: null,
                office_address: null,
                use_of_funds: null,
                contact: null,
                contact_phone: null,
                contact_email: null,
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
    },
    methods: {
        submit() {
            this.sending = true;
            this.$inertia.post(this.route('teams.store'), this.form).then(() => this.sending = false);
        },
    },
}
</script>
