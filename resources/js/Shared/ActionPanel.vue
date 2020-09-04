<template>
    <Panel class="mt-4 p-4">
        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
            {{ title }}
        </h3>

        <div class="flex" :class="{ 'flex-col': stacked, 'items-center justify-between': !stacked }">

            <div class="mt-2">
                <p class="text-sm leading-5 text-gray-500" :class="{ 'w-3/4': !stacked }">
                    {{ info }}
                </p>
            </div>

            <div :class="{ 'w-1/4 flex justify-end mx-2': !stacked, 'mt-4': stacked }">
                <button @click.prevent="isClicking = ! isClicking" v-if="!isClicking" type="button" class="inline-flex justify-center rounded-md border border-transparent px-4 py-2 leading-6 shadow-sm focus:outline-none transition ease-in-out duration-150 sm:text-sm sm:leading-5 font-md" :class="buttonColorResolver">
                    {{ actionText || 'Execute' }}
                </button>
                <button @click="isClicking = !isClicking" v-if="isClicking" type="button" class="inline-flex justify-center rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Cancel
                </button>
                <button v-if="isClicking" @click="submitAction" class="ml-4 focus:outline-none" type="button" :class="linkColorResolver">
                    {{ actionText || 'Execute' }}
                </button>
            </div>

        </div>
    </Panel>
</template>

<script>
import Panel from "./Panel";

export default {
    name: 'ActionPanel',
    data: () => ({
        isClicking: false
    }),
    computed: {
        buttonColorResolver() {
            return [
                this.type === null ? 'bg-indigo-600 focus:border-indigo-700 hover:bg-indigo-500 text-indigo-100' : null,
                this.type === 'default' ? 'bg-indigo-600 focus:border-indigo-700 hover:bg-indigo-500 text-gray-100' : null,
                this.type === 'info' ? 'bg-blue-600 focus:border-blue-700 hover:bg-blue-500 text-white' : null,
                this.type === 'success' ? 'bg-green-600 focus:border-green-700 hover:bg-green-500 text-white' : null,
                this.type === 'warning' ? 'bg-orange-400 focus:border-orange-600 hover:bg-orange-500 text-white' : null,
                this.type === 'danger' ? 'bg-red-600 focus:border-red-700 hover:bg-red-500 text-white' : null,
            ];
        },
        linkColorResolver() {
            return [
                this.type === null ? 'text-indigo-600 font-semibold text-base hover:text-indigo-500 focus:text-indigo-500' : null,
                this.type === 'default' ? 'text-indigo-600 font-semibold text-base hover:text-indigo-500 focus:text-indigo-500' : null,
                this.type === 'info' ? 'text-blue-500 font-semibold text-base hover:text-blue-600 focus:text-blue-700' : null,
                this.type === 'success' ? 'text-green-500 font-semibold text-base hover:text-green-600 focus:text-green-700' : null,
                this.type === 'warning' ? 'text-orange-500 font-semibold text-base hover:text-orange-600 focus:text-orange-700' : null,
                this.type === 'danger' ? 'text-red-500 font-semibold text-base hover:text-red-600 focus:text-red-700' : null,
            ];
        },
    },
    props: {
        title: {
            type: String,
            required: true,
        },
        info: String,
        type: {
            type: String,
            default: 'default',
            validator: function(value) {
                return ['default', 'info', 'success', 'warning', 'danger'].includes(value);
            }
        },
        stacked: {
            type: Boolean,
            default: false,
        },
        actionText: {
            type: String,
            default: 'Execute',
        },
    },
    components: {
        Panel,
    },
    methods: {
        submitAction() {
            this.isClicking = false;
            this.$emit('action');
        }
    }
}
</script>

<style>

</style>
