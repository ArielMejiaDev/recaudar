<template>
<div>
    <label class="text-sm leading-5 font-medium text-gray-700 block mb-2" :for="name">{{ format(label) }}</label>

    <input ref="upload" type="file" :name="name" :id="name" @change="attach" class="hidden" accept="image/*">

    <div class="flex items-center">
        <div
            @click="$refs.upload.click()" class="cursor-pointer flex justify-center content-center flex-wrap bg-gray-300 rounded-full overflow-hidden mr-8" :class="imageHolder">
            <img alt="preview" ref="preview" class="object-cover h-full w-full" :src="preview" @error="throwImageNotFoundException">
        </div>

        <button @click="$refs.upload.click()" v-if="options.showButton" type="button" class="cursor-pointer inline-flex justify-center w-auto rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            {{ options.buttonText || 'Upload' }}
        </button>
    </div>

    <p v-if="errors" class="my-2 text-red-600 font-medium text-sm">{{ errors[0] }}</p>
</div>
</template>

<script>
import preview from "./assets/image-icon.svg";

export default {
    name: "AvatarUploader",
    data: () => ({
        addFile: false,
        preview: preview,
    }),
    props: {
        currentFile: null,
        errors: null,
        name: {
            type: String,
            required: true,
        },
        label: {
            type: String,
            default: function() {
                return this.name.charAt(0).toUpperCase() + this.name.slice(1);
            },
        },
        options: {
            type: Object,
            default: function() {
                return {
                    buttonText: 'Upload',
                    showButton: true,
                    wrongFileException: 'Please select an image.',
                }
            },
        },
        size: {
            type: String,
            default: 'sm',
        },
    },
    methods: {
        attach() {
            this.errorMessage = null;
            this.$emit('input', this.$refs['upload'].files[0]);
            this.validateUploadedFile();
        },
        validateUploadedFile() {
            const file    = this.$refs['upload'].files[0];
            if(file.type.includes('image')) {
                return this.loadPreview(file);
            }
            this.errorMessage = this.options.wrongFileException || 'Please select an image';
        },
        format(string) {
            let newString = this.replace(string, '_')
            newString = this.replace(newString, '-')
            return newString;
        },
        loadPreview(file) {
            const preview = this.$refs.preview;
            const reader  = new FileReader();
            reader.onloadend = () => this.preview = reader.result;
            if (file) {
                this.addFile = true;
                return reader.readAsDataURL(file);
            }
        },
        replace(string, character) {
            return string.replace(character, ' ')
        },
        throwImageNotFoundException(event) {
            let defaultImageSourceOnError = this.preview;
            if(this.currentFileIsPresent) {
                defaultImageSourceOnError = this.currentFile;
            }
            event.target.src = defaultImageSourceOnError;
            this.errorMessage = this.options.extensionErrorMessage || 'Please select an image.';
        },
    },
    computed: {
        currentFileIsPresent() {
            return this.currentFile;
        },
        imageHolder() {
            return {
                'h-12 w-12': this.imageIsSmall,
                'h-20 w-20': this.imageIsMedium,
                'h-32 w-32': this.imageIsLarge,
                'h-40 w-40': this.imageIsExtraLarge,
                'p-0': this.currentFileIsPresent,
            }
        },
        imageIsExtraLarge() {
            return this.size === 'xl';
        },
        imageIsLarge() {
            return this.size === 'lg';
        },
        imageIsMedium() {
            return this.size  === 'md';
        },
        imageIsSmall() {
            return this.size === 'sm';
        },
    },
    created() {
        if(this.currentFile) {
            return this.preview = this.currentFile;
        }
    },
}
</script>
