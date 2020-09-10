<template>
    <div>
        <label :for="name" class="text-sm leading-5 font-medium text-gray-700 block mb-1 text-left">{{ format(label) }}</label>
        <button type="button" class="w-full focus:outline-none rounded-lg overflow-hidden" :class="areaBorder" @click.stop="openFileDialogBox">
            <!--    Dashed area to click and select a file-->
            <template>
                <div @click.stop="openFileDialogBox"
                    class="relative cursor-pointer bg-gray-100 shadow w-full text-gray-500 flex flex-col items-center justify-center h-40 sm:h-48 md:h-64 lg:h-72 overflow-hidden">

                    <div v-show="addFile" class="h-full w-full">
                        <img ref="preview" @click.stop="openFileDialogBox" :src="dataCurrentFile" class="object-cover w-full h-full z-0" alt="preview" >
                        <div class="bg-black opacity-0 lg:hover:opacity-100 bg-opacity-0 hover:bg-opacity-50 flex items-center justify-center absolute inset-0 text-gray-100">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="photograph w-12 h-12"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                        </div>
                    </div>

                    <div v-show="!addFile" class="flex flex-col justify-center items-center">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="photograph w-12 h-12"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                        <span @click.stop="openFileDialogBox" href="#" class="hover:underline text-sm leading-5 font-medium text-blue-700 block mb-1">{{ options.buttonText || 'Upload a picture' }}</span>
                        <span class="text-sm leading-5 font-medium block mb-2">PNG, JPG, GIF</span>
                    </div>

                </div>
            </template>
            <!--    End of dashed area to click and select a file-->
            <input ref="upload" type="file" class="hidden" :id="name" :name="name" @change="attach" accept="image/*" >
        </button>
        <p v-if="errors" class="my-2 text-red-600 font-medium text-sm">{{ errors[0] }}</p>
    </div>
</template>

<script>
export default {
    name: "ImageUploader",
    data() {
        return {
            addFile: false,
            dataCurrentFile: null,
        }
    },
    props: {
        currentFile: null,
        errors: null,
        options: {
            type: Object,
            default: function() {
                return {
                    buttonText: 'Upload a picture',
                }
            },
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
    },
    computed: {
        areaBorder() {
            return {
                'border-2 border-dashed border-gray-500 focus:border-blue-500': !this.addFile,
                'focus:shadow-outline': this.currentFile,
            }
        },
    },
    methods: {
        attach() {
            this.addFile = true;
            this.validateUploadedFile();
        },
        validateUploadedFile() {
            const file = this.$refs['upload'].files[0];
            return this.loadPreview(file);
            // if(file.type.includes('image')) {
            //     return this.loadPreview(file);
            // }
        },
        loadPreview(file) {
            const preview = this.$refs.preview;
            const reader  = new FileReader();
            reader.onloadend = () => this.dataCurrentFile = reader.result;
            this.$emit('input', this.$refs.upload.files[0]);
            if (file) {
                preview.classList.remove('hidden');
                return reader.readAsDataURL(file);
            }
        },
        format(string) { // Curate the string to show a proper label
            let newString = this.replace(string, '_')
            newString = this.replace(newString, '-')
            return newString;
        },
        openFileDialogBox() {
            return this.$refs.upload.click();
        },
        replace(string, character) { // helper to format the label
            return string.replace(character, ' ')
        },
    },

    created() {
        if(this.currentFile) {
            this.addFile = true;
            this.dataCurrentFile = this.currentFile;
        }
        return this.dataCurrentFile;
    },
}
</script>
