<template>
<div>
    <div v-if="src" class="flex-shrink-0">
        <img ref="image" class="rounded-full object-cover" :class="[
            size === 'sm' || size === null ? 'h-10 w-10' : null,
            size === 'md' ? 'h-20 w-20' : null,
            size === 'lg' ? 'h-32 w-32' : null,
            size === 'xl' ? 'h-40 w-40' : null,
        ]" :src="src" :alt="alt"/>
    </div>

    <div v-if="name" class="flex-shrink-0" >
        <div class="rounded-full font-bold text-lg flex justify-center items-center"
             :class="[
                size === 'sm' || size === null ? 'h-10 w-10' : null,
                size === 'md' ? 'h-20 w-20' : null,
                size === 'lg' ? 'h-32 w-32' : null,
                size === 'xl' ? 'h-40 w-40' : null,
                type === 'default' || type === null ? 'text-indigo-900 bg-indigo-200' : null,
                type === 'info' ? 'text-blue-900 bg-blue-200' : null,
                type === 'success' ? 'text-green-900 bg-green-200' : null,
                type === 'warning' ? 'text-yellow-900 bg-yellow-200' : null,
                type === 'danger' ? 'text-red-900 bg-red-200' : null,
            ]"
        >{{ userInitials }}</div>
    </div>

</div>
</template>

<script>
    export default {
        name: "Avatar",
        props: {
            src: String,
            alt: String,
            size: {
                type: String,
                default: 'sm',
                validator: function(value) {
                    return ['sm', 'md', 'lg', 'xl'].includes(value)
                }
            },
            name: null,
            type: {
                type: String,
                default: 'default',
                validator: function(value) {
                    return ['default', 'info', 'success', 'warning', 'danger'].includes(value)
                }
            },
        },
        computed: {
            userInitials() {
                return this.name.match(/[A-Z]/g).slice(0, 2).join('');
            },
        },
    }
</script>

<style scoped>

</style>
