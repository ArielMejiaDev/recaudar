<template>
    <div class="mb-4">
        <label v-if="label" class="text-sm text-gray-600 block mb-1" :for="name">{{ label }}</label>
        <input :id="name" :value="value" @input="$emit('input', $event.target.value)" :name="name" :type="type" class="w-full form-input rounded-lg" :required="required" :autocomplete="autocomplete" :placeholder="placeholder" :disabled="disabled" :class="disabled ? 'bg-gray-200' : null">
        <div v-if="errors.length" class="text-red-600 text-xs font-bold my-1">{{ errors[0] }}</div>
    </div>
</template>

<script>
export default {
    name: "Input",
    data: () => ({
        data: null,
    }),
    props: {
        value: null,
        name: null,
        label: String,
        type: {
            type: String,
            default: 'text',
        },
        required: {
            type: Boolean,
            default: true,
        },
        autocomplete: {
            type: String,
            default: 'off',
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        placeholder: String,
        errors: {
            type: Array,
            default: () => [],
        },
    },
}
</script>

