<template>
    <div>

        <form @submit.prevent="submitProfileDataForm">
            <Panel>
                <template v-slot:header>
                    <Title>{{ trans.profile }}</Title>
                </template>
                <template v-slot:body>

                    <div class="w-full flex flex-col md:flex-row">

                        <div class="w-full md:w-1/3 md:mr-1">
                            <Input v-model="profileDataForm.name" name="name" :label="trans.name" :errors="$page.errors.name" />
                        </div>
                        <div class="w-full md:w-1/3 md:mx-1">
                            <Input v-model="profileDataForm.beneficiaries" name="beneficiaries" :label="trans.beneficiaries" :errors="$page.errors.beneficiaries" />
                        </div>
                        <div class="w-full md:w-1/3 md:ml-1">
                            <Input v-model="profileDataForm.public" name="public" :label="trans.public" :errors="$page.errors.public" />
                        </div>
                    </div>

                    <div class="w-full flex flex-col md:flex-row">
                        <div class="w-full md:w-1/3 md:mr-1">
                            <Select v-model="profileDataForm.status" name="status" :label="trans.status" :placeholder="`${$page.global_trans.select} ${trans.status}`" :errors="$page.errors.status">
                                <option value="pending">{{ trans.pending }}</option>
                                <option value="approved">{{ trans.approved }}</option>
                            </Select>
                        </div>
                        <div class="w-full md:w-1/3 md:mx-1">
                            <Select v-model="profileDataForm.category" name="category" :label="trans.category" :placeholder="`${$page.global_trans.select} ${trans.category}`" :errors="$page.errors.category">
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
                            <Select v-model="profileDataForm.theme" name="theme" :label="trans.theme" :placeholder="`${$page.global_trans.select} ${trans.theme}`" :errors="$page.errors.theme">
                                <option value="classic">{{ trans.theme }} {{ trans.classic }}</option>
                                <option value="condensed">{{ trans.theme }} {{ trans.condensed }}</option>
                                <option value="columns">{{ trans.theme }} {{ trans.columns }}</option>
                            </Select>
                        </div>
                    </div>
                    <Input v-model="profileDataForm.impact" name="impact" :label="trans.impact" :errors="$page.errors.impact" />
                    <Input v-model="profileDataForm.use_of_funds" name="use_of_funds" :label="trans.use_of_funds" :errors="$page.errors.use_of_funds" />
                    <Textarea v-model="profileDataForm.description" name="description" :label="trans.description" :errors="$page.errors.description"></Textarea>
                </template>

                <template v-slot:footer>
                    <LoadingButton :loading="loadingProfileData">
                        {{ $page.global_trans.update }} {{ trans.profile }}
                    </LoadingButton>
                </template>
            </Panel>
        </form>

        <form @submit.prevent="submitMediaForm" class="mt-16">
            <Panel>
                <template v-slot:header>
                    <Title class="flex items-start">
                        <div class="text-gray-800 mr-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        Media
                    </Title>
                </template>
                <template v-slot:body>
                    <AvatarUploader v-model="mediaForm.logo" class="mb-4" name="logo" label="Logo" :current-file="team.logo" :options="{ showButton:true, buttonText:trans.upload }" :errors="$page.errors.logo" />
                    <ImageUploader v-model="mediaForm.banner" name="banner" label="Banner" :current-file="team.banner" :errors="$page.errors.banner" />
                </template>
                <template v-slot:footer>
                    <LoadingButton :loading="loadingMedia">
                        {{ $page.global_trans.update }} {{ trans.media }}
                    </LoadingButton>
                </template>
            </Panel>
        </form>

        <form @submit.prevent="submitContactDataForm" class="mt-16">
            <Panel>
                <template v-slot:header>
                    <Title>{{ trans.contact }}</Title>
                </template>
                <template v-slot:body>
                    <div class="w-full flex flex-col md:flex-row">
                        <Input class="w-full md:w-1/3 md:mr-1" v-model="contactDataForm.contact" name="contact" :label="trans.contact" :errors="$page.errors.contact" />
                        <Input class="w-full md:w-1/3 md:mx-1" v-model="contactDataForm.contact_phone" name="contact_phone" :label="trans.contact_phone" :errors="$page.errors.contact_phone" />
                        <Input class="w-full md:w-1/3 md:ml-1" v-model="contactDataForm.contact_email" name="contact_email" :label="trans.contact_email" :errors="$page.errors.contact_email" />
                    </div>
                    <Input v-model="contactDataForm.office_address" name="office_address" :label="trans.office_address" :errors="$page.errors.office_address" />
                </template>
                <template v-slot:footer>
                    <LoadingButton :loading="loadingContactData">
                        {{ $page.global_trans.update }} {{ trans.contact }}
                    </LoadingButton>
                </template>
            </Panel>
        </form>

        <form @submit.prevent="submitLegalDataForm" class="mt-16">
            <Panel>
                <template v-slot:header>
                    <Title>{{ trans.financial_data }}</Title>
                </template>
                <template v-slot:body>
                    <div class="w-full flex flex-col md:flex-row">
                        <Input class="w-full md:w-1/3 md:mr-1" v-model="legalDataForm.legal_representative" name="legal_representative" :label="trans.legal_representative" :errors="$page.errors.legal_representative" />
                        <Input class="w-full md:w-1/3 md:mx-1" v-model="legalDataForm.tax_number" name="tax_number" :label="trans.tax_number" :errors="$page.errors.tax_number" />
                        <Select class="w-full md:w-1/3 md:ml-1" v-model="legalDataForm.country" name="country" :label="trans.country" :errors="$page.errors.country">
                            <option value="Guatemala">Guatemala</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Panama">Panama</option>
                            <option value="Costa Rica">Costa Rica</option>
                        </Select>
                    </div>
                    <div class="w-full flex flex-col md:flex-row">
                        <Input class="w-full md:w-1/2 md:mr-1" v-model="legalDataForm.account_number" name="account_number" :label="trans.account_number" :errors="$page.errors.account_number" />
                        <Input class="w-full md:w-1/2 md:ml-1" v-model="legalDataForm.bank" name="bank" :label="trans.bank" :errors="$page.errors.bank" />
                    </div>
                </template>
                <template v-slot:footer>
                    <LoadingButton :loading="loadingLegalDataForm">
                        {{ $page.global_trans.update }} {{ trans.financial_data }}
                    </LoadingButton>
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
import AvatarUploader from "../../../Shared/AvatarUploader";
import ImageUploader from "../../../Shared/ImageUploader";

export default {
    metaInfo: { title: 'Edit team' },
    layout: SidebarLayout,
    name: "Edit",
    components: {
        Panel,
        Title,
        Input,
        Select,
        AvatarUploader,
        ImageUploader,
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
                impact: this.team.impact,
                use_of_funds: this.team.use_of_funds,
                description: this.team.description,
            },
            mediaForm: {
                logo: this.team.logo,
                banner: this.team.banner,
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
                country: this.team.country,
                account_number: this.team.account_number,
                bank: this.team.bank,
            },
            loadingProfileData: false,
            loadingMedia: false,
            loadingContactData: false,
            loadingLegalDataForm: false,
        }
    },
    props: {
        team: Object,
        trans: Object,
    },
    methods: {
        submitProfileDataForm() {
            this.loadingProfileData = true;
            const route = this.route('admin.teams.update-profile', { team:this.team.id });
            this.$inertia.put(route, this.profileDataForm).then(() => this.loadingProfileData = false);
        },
        submitMediaForm() {
            this.loadingMedia = true;
            const route = this.route('admin.teams.update-media', { team:this.team.id });
            const form = new FormData();
            form.append('logo', this.mediaForm.logo || '');
            form.append('banner', this.mediaForm.banner || '');
            form.append('_method', 'put');
            this.$inertia.post(route, form).then(() => this.loadingMedia = false);
        },
        submitContactDataForm() {
            this.loadingContactData = true;
            const route = this.route('admin.teams.update-contact', { team:this.team.id });
            this.$inertia.put(route, this.contactDataForm).then(() => this.loadingContactData = false);
        },
        submitLegalDataForm() {
            this.loadingLegalDataForm = true;
            const route = this.route('admin.teams.update-legal-data', { team:this.team.id });
            this.$inertia.put(route, this.legalDataForm).then(() => this.loadingLegalDataForm = false);
        }
    }
}
</script>
