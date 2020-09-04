<template>
    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b border-gray-200 hover:bg-gray-100">
        <dt class="text-sm leading-5 font-medium text-gray-500">{{ label }}</dt>
        <dd v-if="value" class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">{{ value }}</dd>
        <dd v-else>
            <slot></slot>
        </dd>
    </div>
</template>

<script>
export default {
    name: "ListItem",
    props: {
        label: {
            type: String,
            required: true,
        },
        value: {
            type: String,
        },
    },
}
</script>

<style scoped>

</style>
