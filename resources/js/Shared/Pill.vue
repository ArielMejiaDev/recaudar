<template>
    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
          :class="[
              type === 'default' || type === null ? 'bg-indigo-200 text-indigo-800' : null,
              type === 'info' ? 'bg-blue-200 text-blue-800' : null,
              type === 'success' ? 'bg-green-200 text-green-800' : null,
              type === 'warning' ? 'bg-yellow-200 text-yellow-800' : null,
              type === 'danger' ? 'bg-red-200 text-red-800' : null,
          ]">
        <slot></slot>
    </span>
</template>

<script>
    export default {
        name: "Pill",
        props: {
            type: {
                type: String,
                default: 'default',
            },
        }
    }
</script>

<style scoped>

</style>
