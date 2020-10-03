<template>
<div>
    <form @submit.prevent="submit">
        <Panel>
            <template v-slot:header>
                <Title>{{ trans.update_a_team }}</Title>
            </template>

            <template v-slot:body>

                <Title class="mb-4" :info="trans.the_data_in_this_section_will_be_displayed_on_the_profile_page">{{ trans.profile }}</Title>

                <div class="w-full flex flex-col md:flex-row">

                    <div class="w-full w-1/3 md:mr-1">
                        <Input name="name" v-model="form.name" :label="trans.organization_name" :errors="$page.errors.name" />
                    </div>

                    <div class="w-full w-1/3 md:mx-1">
                        <Input name="beneficiaries" v-model="form.beneficiaries" :label="trans.beneficiaries" type="number" :errors="$page.errors.beneficiaries" />
                    </div>

                    <div class="w-full w-1/3 md:ml-1">
                        <Input name="public" v-model="form.public" :label="trans.public" :errors="$page.errors.public" />
                    </div>

                </div>

                <div class="w-full flex flex-col md:flex-row">
                    <Select class="w-full w-1/2 md:mr-1" name="category" v-model="form.category" :label="trans.category" :placeholder="`${$page.global_trans.select} ${trans.category}`" :errors="$page.errors.category">
                        <option value="Salud">Salud</option>
                        <option value="Educación">Educación</option>
                        <option value="Ambientales">Ambientales</option>
                        <option value="Social">Social</option>
                        <option value="Nutrición">Nutrición</option>
                        <option value="Pobreza">Pobreza</option>
                        <option value="Animales">Animales</option>
                        <option value="Otros">Otros</option>
                    </Select>

                    <Input class="w-full md:w-1/2 md:ml-1" name="impact" v-model="form.impact" :label="trans.impact" :errors="$page.errors.impact" />
                </div>

                <Input name="use_of_funds" v-model="form.use_of_funds" :label="trans.use_of_funds" :errors="$page.errors.use_of_funds" />

                <Textarea name="description" v-model="form.description" :label="trans.description" :errors="$page.errors.description" />

                <hr class="mb-6 mt-12">

                <Title class="mb-8" info="This information would not be shown publicly.">{{ trans.contact }}</Title>

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

                <Title class="mb-8" :info="trans.this_information_will_not_be_publicly_visible">{{ trans.financial_data}}</Title>

                <div class="w-full flex flex-col md:flex-row">

                    <div class="w-full w-1/3 md:mr-1">
                        <Input name="legal_representative" v-model="form.legal_representative" :label="trans.legal_representative" :errors="$page.errors.legal_representative" />
                    </div>

                    <div class="w-full w-1/3 md:mx-1">
                        <Input name="tax_number" v-model="form.tax_number" :label="trans.tax_number" :errors="$page.errors.tax_number" />
                    </div>

                    <div class="w-full w-1/3 md:ml-1">
                        <Select name="country" v-model="form.country" :label="trans.country" :errors="$page.errors.country">
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

            </template>

            <template v-slot:footer>
                <LoadingButton :loading="sending">{{ $page.global_trans.update }}</LoadingButton>
            </template>

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

export default {
    metaInfo: { title: 'Edit a team' },
    name: "Edit",
    data() {
        return {
            form: {
                name: this.team.name,
                beneficiaries: this.team.beneficiaries,
                public: this.team.public,
                category: this.team.category,
                impact: this.team.impact,
                use_of_funds: this.team.use_of_funds,
                description: this.team.description,
                contact: this.team.contact,
                contact_phone: this.team.contact_phone,
                contact_email: this.team.contact_email,
                office_address: this.team.office_address,
                legal_representative: this.team.legal_representative,
                tax_number: this.team.tax_number,
                country: this.team.country,
                bank: this.team.bank,
                account_number: this.team.account_number,
            },
            sending: false,
        }
    },
    remember: 'form',
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
    },
    methods: {
        submit() {
            this.sending = true;
            this.$inertia.put(this.route('teams.update', this.team.slug), this.form).then(() => this.sending = false);
        },
    },
    props: {
        team: Object,
        trans: Object,
    },
}
</script>
