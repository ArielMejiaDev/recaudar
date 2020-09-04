<template>
    <div class="w-full flex items-center justify-end">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button type="submit" :disabled="loading" :class="buttonColorResolver" class="inline-flex justify-center w-full rounded-md border-2 border-transparent px-4 py-2 text-base leading-6 font-medium text-white shadow-sm focus:outline-none transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                <div v-if="loading" class="btn-spinner mr-2" ></div>
                <slot />
            </button>
        </span>
    </div>
</template>

<script>
export default {
    name: 'LoadingButton',
    props: {
        loading: Boolean,
        type: {
            type: String,
            default: 'default',
            validator: function(value) {
                return ['default', 'info', 'success', 'warning', 'danger'].includes(value);
            }
        }
    },
    computed: {
        buttonColorResolver() {
            return [
                this.type === 'default' ? 'bg-indigo-600 hover:bg-indigo-500 focus:border-indigo-700 focus:bg-indigo-500' : null,
                this.type === 'info' ? 'bg-blue-600 hover:bg-blue-500 focus:border-blue-700 focus:bg-blue-500' : null,
                this.type === 'success' ? 'bg-green-600 hover:bg-green-500 focus:border-green-700 focus:bg-green-500' : null,
                this.type === 'warning' ? 'bg-yellow-600 hover:bg-yellow-500 focus:border-yellow-700 focus:bg-yellow-500' : null,
                this.type === 'danger' ? 'bg-red-600 hover:bg-red-500 focus:border-red-700 focus:bg-red-500' : null,
            ]
        }
    }
}
</script>
