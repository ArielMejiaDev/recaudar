<template>
    <h3 class="text-lg leading-6 font-medium text-xl text-gray-900">
        <slot></slot>
        <p v-if="info" class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">{{ info }}</p>
    </h3>
</template>

<script>
export default {
    name: "Title",
    props: {
        info: String,
    }
}
</script>

<style scoped>

</style>
