<template>
    <div>

        <form @submit.prevent="submitProfileDataForm">
            <Panel>
                <template v-slot:header>
                    <Title>Profile</Title>
                </template>
                <template v-slot:body>

                    <div class="w-full flex flex-col md:flex-row">

                        <div class="w-full md:w-1/3 md:mr-1">
                            <Input v-model="profileDataForm.name" name="name" label="Name" placeholder="Team name" :errors="$page.errors.name" />
                        </div>
                        <div class="w-full md:w-1/3 md:mx-1">
                            <Input v-model="profileDataForm.beneficiaries" name="beneficiaries" label="Beneficiaries" placeholder="Add beneficiaries" :errors="$page.errors.beneficiaries" />
                        </div>
                        <div class="w-full md:w-1/3 md:ml-1">
                            <Input v-model="profileDataForm.public" name="public" label="Public" placeholder="Add public" :errors="$page.errors.public" />
                        </div>
                    </div>

                    <div class="w-full flex flex-col md:flex-row">
                        <div class="w-full md:w-1/3 md:mr-1">
                            <Select v-model="profileDataForm.status" name="status" label="Status" placeholder="Select a status" :errors="$page.errors.status">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                            </Select>
                        </div>
                        <div class="w-full md:w-1/3 md:mx-1">
                            <Select v-model="profileDataForm.category" name="category" label="Category" placeholder="Select a category" :errors="$page.errors.category">
                                <option value="Salud">Salud</option>
                                <option value="Educacion">Educación</option>
                                <option value="Ambientales">Ambientales</option>
                                <option value="Social">Social</option>
                                <option value="Nutricion">Nutrición</option>
                                <option value="Pobreza">Pobreza</option>
                                <option value="Animales">Animales</option>
                                <option value="Otros">Otros</option>
                            </Select>
                        </div>
                        <div class="w-full md:w-1/3 md:ml-1">
                            <Select v-model="profileDataForm.theme" name="theme" label="Theme" placeholder="Add a theme" :errors="$page.errors.theme">
                                <option value="classic">Classic</option>
                                <option value="condensed">Condensed</option>
                                <option value="columns">Columns</option>
                            </Select>
                        </div>
                    </div>
                    <Input v-model="profileDataForm.impact" name="impact" label="Impact" placeholder="Add Impact" :errors="$page.errors.impact" />
                    <Textarea v-model="profileDataForm.description" name="description" label="Description" placeholder="Add a description" :errors="$page.errors.description"></Textarea>
                </template>

                <template v-slot:footer>
                    <LoadingButton :loading="loading">
                        Update profile
                    </LoadingButton>
                </template>
            </Panel>
        </form>

        <form @submit.prevent="submitContactDataForm" class="mt-16">
            <Panel>
                <template v-slot:header>
                    <Title>Contact</Title>
                </template>
                <template v-slot:body>
                    <div class="w-full flex flex-col md:flex-row">
                        <Input class="w-full md:w-1/3 md:mr-1" v-model="contactDataForm.contact" name="contact" label="Contact" placeholder="Add a contact" :errors="$page.errors.contact" />
                        <Input class="w-full md:w-1/3 md:mx-1" v-model="contactDataForm.contact_phone" name="contact_phone" label="Contact Phone" placeholder="Add a contact phone" :errors="$page.errors.contact_phone" />
                        <Input class="w-full md:w-1/3 md:ml-1" v-model="contactDataForm.contact_email" name="contact_email" label="Contact Email" placeholder="Add Contact Email" :errors="$page.errors.contact_email" />
                    </div>
                    <Input v-model="contactDataForm.office_address" name="office_address" label="Office Address" placeholder="Add office address" :errors="$page.errors.office_address" />
                </template>
                <template v-slot:footer>
                    <LoadingButton>Update contact data</LoadingButton>
                </template>
            </Panel>
        </form>

        <form @submit.prevent="submitLegalDataForm" class="mt-16">
            <Panel>
                <template v-slot:header>
                    <Title>Legal data</Title>
                </template>
                <template v-slot:body>
                    <div class="w-full flex flex-col md:flex-row">
                        <Input class="w-full md:w-1/2 md:mr-1" v-model="legalDataForm.legal_representative" name="legal_representative" label="Legal Representative" placeholder="Add legal representative" :errors="$page.errors.legal_representative" />
                        <Input class="w-full md:w-1/2 md:ml-1" v-model="legalDataForm.tax_number" name="tax_number" label="Tax number" placeholder="Add tax number" :errors="$page.errors.tax_number" />
                    </div>
                    <Input v-model="legalDataForm.use_of_funds" name="use_of_funds" label="Use of funds" placeholder="Add a use of funds" :errors="$page.errors.use_of_funds" />
                </template>
                <template v-slot:footer>
                    <LoadingButton>Update legal data</LoadingButton>
                </template>
            </Panel>
        </form>

    </div>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Panel from "../../../Shared/Panel";
import Title from "../../../Shared/Title";
import Input from "../../../Shared/Input";
import Select from "../../../Shared/Select";
import Textarea from "../../../Shared/Textarea";
import LoadingButton from "../../../Shared/LoadingButton";

export default {
    metaInfo: { title: 'Edit team' },
    layout: SidebarLayout,
    name: "Edit",
    components: {
        Panel,
        Title,
        Input,
        Select,
        Textarea,
        LoadingButton,
    },
    data() {
        return {
            profileDataForm: {
                name: this.team.name,
                beneficiaries: this.team.beneficiaries,
                public: this.team.public,
                status: this.team.status,
                category: this.team.category,
                theme: this.team.theme,
                description: this.team.description,
                impact: this.team.impact,
            },
            contactDataForm: {
                contact: this.team.contact,
                contact_phone: this.team.contact_phone,
                contact_email: this.team.contact_email,
                office_address: this.team.office_address,
            },
            legalDataForm: {
                legal_representative: this.team.legal_representative,
                tax_number: this.team.tax_number,
                use_of_funds: this.team.use_of_funds,
            },
            loading: false,
        }
    },
    props: {
        team: Object,
    },
    methods: {
        submitProfileDataForm() {
            this.loading = true;
            const route = this.route('admin.teams.update-profile', { team:this.team.id });
            this.$inertia.put(route, this.profileDataForm).then(() => this.loading = false);
        },
        submitContactDataForm() {
            this.loading = true;
            const route = this.route('admin.teams.update-contact', { team:this.team.id });
            this.$inertia.put(route, this.contactDataForm).then(() => this.loading = false);
        },
        submitLegalDataForm() {
            this.loading = true;
            const route = this.route('admin.teams.update-legal-data', { team:this.team.id });
            this.$inertia.put(route, this.legalDataForm).then(() => this.loading = false);
        }
    }
}
</script>
