<template>
    <InertiaLink :href="link" :class="colorResolver"
   class="inline-flex justify-center rounded-md border px-4 py-2 text-base leading-6 font-medium shadow-sm focus:outline-none transition ease-in-out duration-150 sm:text-sm sm:leading-5">
        {{ text }}
    </InertiaLink>
</template>

<script>
export default {
    name: "LinkButton",
    props: {
        text: {
            type: String,
            required: true,
        },
        link: String,
        type: {
            type: String,
            default: 'default',
            validator: function(value) {
                return ['default', 'neutral', 'info', 'success', 'warning', 'danger'].includes(value);
            }
        }
    },
    computed: {
        colorResolver() {
            return [
                this.type === 'default' ? 'border-indigo-300 bg-indigo-500 text-white hover:text-gray-200 hover:border-indigo-700 focus:border-indigo-700' : null,
                this.type === 'neutral' ? 'border-gray-300 bg-white text-gray-700 hover:text-gray-500 focus:border-blue-300' : null,
                this.type === 'info' ? 'border-blue-300 bg-blue-500 text-white hover:text-gray-200 hover:border-blue-700 focus:border-blue-700' : null,
                this.type === 'success' ? 'border-green-300 bg-green-500 text-white hover:text-gray-200 hover:border-green-700 focus:border-green-700' : null,
                this.type === 'warning' ? 'border-orange-300 bg-orange-500 text-white hover:text-gray-200 hover:border-orange-700 focus:border-orange-700' : null,
                this.type === 'danger' ? 'border-red-300 bg-red-500 text-white hover:text-gray-200 hover:border-red-700 focus:border-red-700' : null,
            ];
        }
    }
}
</script>

<style scoped>

</style>
