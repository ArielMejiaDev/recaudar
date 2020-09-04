<template>
    <div class="bg-white rounded-lg text-left overflow-hidden shadow sm:align-middle">

        <div v-if="$slots.header" class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <slot name="header"></slot>
        </div>

        <div class="bg-white">
            <slot></slot>
            <div v-if="$slots.body" class="px-4 py-5 sm:p-6">
                <slot name="body"></slot>
            </div>
        </div>

        <div v-if="$slots.footer" class="bg-gray-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <slot name="footer"></slot>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Panel"
    }
</script>

<style scoped>

</style>
