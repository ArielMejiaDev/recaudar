<template>
    <div class="flex flex-col mb-4">
        <label v-if="label" class="text-sm text-gray-600 block mb-1" :for="name">{{ label }}</label>

        <div class="relative">

            <div class="absolute flex border border-transparent left-0 top-0 h-full w-10 overflow-hidden">
                <div class="flex items-center justify-center rounded-tl rounded-bl z-10 bg-gray-100 text-gray-600 text-lg h-full w-full">
                    <slot name="icon"></slot>
                </div>
            </div>

            <input :id="name" :value="value" @input="$emit('input', $event.target.value)" :name="name" :type="type" :min="min" :max="max" :step="step" class="relative form-input rounded-lg w-full pl-12" :required="required" :autocomplete="autocomplete" :placeholder="placeholder" :disabled="disabled" :class="disabled ? 'bg-gray-200' : null" >

        </div>
        <div v-if="errors.length" class="text-red-600 text-xs font-bold my-1">{{ errors[0] }}</div>
    </div>
</template>

<script>
export default {
    name: "IconInput",
    data: () => ({
        data: null,
    }),
    props: {
        value: String,
        name: null,
        icon: null,
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
        step: String,
        min: String,
        max: String,
        errors: {
            type: Array,
            default: () => [],
        },
    },
}
</script>

