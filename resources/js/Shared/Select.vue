<template>
    <div class="mb-4">
        <label v-if="label" class="text-sm text-gray-600 block mb-1" :for="name">{{ label }}:</label>
        <select :id="name" :name="name" ref="input" v-model="selected" class="w-full form-select rounded-lg" :required="required">
          <option value="null" disabled selected v-if="placeholder">{{ placeholder }}</option>
            <slot />
        </select>
        <div v-if="errors.length" class="text-red-600 text-xs font-bold my-1">{{ errors[0] }}</div>
    </div>
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        id: String,
        name: null,
        value: [String, Number, Boolean],
        label: String,
        placeholder: String,
        required: {
            type: Boolean,
            default: true,
        },
        errors: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            selected: this.value,
        }
    },
    watch: {
        selected(selected) {
            this.$emit('input', selected)
        },
    },
}
</script>
