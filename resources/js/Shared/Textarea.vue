<template>
    <div class="mb-4">
        <label v-if="label" class="text-sm text-gray-600 block mb-1" :for="name">{{ label }}</label>

        <textarea style="resize: none" :id="name" :value="value" :name="name"
            @input="$emit('input', $event.target.value)"
            class="w-full form-input rounded-lg my-0" :required="required"
            :autocomplete="autocomplete" :placeholder="placeholder" :rows="rows"></textarea>

        <div v-if="errors.length" class="text-red-600 text-xs font-bold mb-2">{{ errors[0] }}</div>
    </div>
</template>

<script>
export default {
    name: "Textarea",
    data: () => ({
        data: null,
    }),
    props: {
        value: String,
        name: null,
        label: String,
        required: {
            type: Boolean,
            default: true,
        },
        autocomplete: {
            type: String,
            default: 'off',
        },
        placeholder: String,
        rows: {
            type: Number,
            default: 5,
        },
        errors: {
            type: Array,
            default: () => [],
        },
    },
}
</script>


