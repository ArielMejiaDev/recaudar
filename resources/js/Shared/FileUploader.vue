<template>
<div>
    <label class="text-sm leading-5 font-medium text-gray-700 block mb-2">{{ format(label) }}</label>
<!--Block of loaded files selected by the user-->
    <transition-group name="fade">
        <template v-if="fileIsSelected">
            <div v-for="(file, index) in selectedFiles" :key="index" class="pl-3 pr-4 py-3 flex items-center justify-between text-sm leading-5">
                <div class="w-0 flex-1 flex items-center">
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2 flex-1 w-0 truncate">{{ fileNameFormat(file.name) }}</span>
                </div>
            </div>
        </template>
    </transition-group>
<!--Block of loaded files selected by the user-->

<!-- List of files from current files prop array -->
    <div class="border border-gray-200 rounded-md" v-if="noFileSelectedAndNoCurrentFile">
        <div v-for="(file, index) in currentFiles" :key="index" class="pl-3 pr-4 py-3 flex items-center justify-between text-sm leading-5 hover:bg-gray-100 border-b border-gray-100">
            <div class="w-0 flex-1 flex items-center">
                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                </svg>
                <span class="ml-2 flex-1 w-0 truncate">{{ fileNameFormat(file) }}</span>
            </div>
            <div class="ml-4 flex-shrink-0">
                <!-- This link only load if is prop download is present-->
                <a v-if="download" :href="file" download class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">{{ options.downloadLinkText }}</a>
                <!-- Default link -->
                <a v-else :href="file" target="_blank" class="cursor-pointer font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">{{ options.viewLinkText }}</a>
            </div>
        </div>
    </div>
<!-- End of List of files from current files prop array -->

    <button @click="$refs.upload.click()" type="button" class="cursor-pointer inline-flex justify-center w-auto rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5 mt-2">
        {{ options.buttonText }}
    </button>
    <input :id="name" ref="upload" type="file" :name="name" @change="attach" :multiple="multiple" class="hidden">
    <p v-if="errors" class="my-2 text-red-600 font-medium text-sm">{{ errorMessage }}</p>
</div>
</template>

<script>
export default {
    name: "UploadFile",
    data: () => ({
        addFiles: false,
        errorMessage: null,
        file: false,
        selectedFiles: null,
    }),
    props: {
        currentFiles: null,
        download: {
            type: Boolean,
            default: false,
        },
        errors: null,
        multiple: {
            type: Boolean,
            default: false,
        },
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
                    viewLinkText: 'View',
                    downloadLinkText: 'Download',
                    buttonText: 'Upload',
                }
            },
        },
        value: null,
    },
    computed: {
        fileIsSelected() {
            return this.addFiles;
        },
        noFileSelectedAndNoCurrentFile() {
            return !this.addFiles && this.currentFiles;
        }
    },
    methods: {
        attach() {
            this.errorMessage = null;
            this.addFiles = true;
            this.selectedFiles = this.$refs.upload.files;
            if(this.multiple) {
                return this.emmitMultipleFiles();
            }
            return this.emmitSingleFile();
        },
        emmitMultipleFiles() {
            const files = this.$refs['upload'].files;
            let attachments = [];
            for (let i = 0; i < files.length ; i++) {
                attachments.push(files[i]);
            }
            return this.$emit('input', attachments);
        },
        emmitSingleFile() {
            return this.$emit('input', this.$refs['upload'].files[0]);
        },
        getErrors() {
            if(this.errors && this.errors[this.name]) {
                this.errorMessage = this.errors[this.name][0];
                return this.errorMessage;
            }
        },
        fileNameFormat(content, length = 20) {
            if (content.length > length) {
                const fileName = content.substr(content, length) + '... .';
                const fileExtension = content.split('.').pop();
                return fileName + fileExtension;
            }
            return content;
        },
        format(string) {
            let newString = this.replace(string, '_');
            newString = this.replace(newString, '-');
            return newString;
        },
        replace(string, character) {
            return string.replace(character, ' ');
        },
    },
    watch: {
        errors() {
            this.getErrors();
        }
    },
    created() {
        this.getErrors();
    },
}
</script>
