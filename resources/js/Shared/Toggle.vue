<template>
    <div class="flex flex-col justify-start my-4">

        <!-- Toggle Button -->
        <label :for="name" class="flex items-center cursor-pointer">

            <!-- toggle -->
            <div class="relative">
                <!-- input -->
                <input :id="name" @change="changeToggle" :name="name" type="checkbox" class="hidden" />
                <!-- line -->
                <div
                    class="toggle__line w-10 h-4 rounded-full shadow-inner"
                    :class="[
                        !toggle ? 'bg-gray-400' : null,
                         toggle && type === null ? 'bg-indigo-400 opacity-50' : null,
                         toggle && type === 'default' ? 'bg-indigo-400 opacity-50' : null,
                         toggle && type === 'info' ? 'bg-blue-400 opacity-50' : null,
                         toggle && type === 'success' ? 'bg-green-400 opacity-50' : null,
                         toggle && type === 'warning' ? 'bg-yellow-400 opacity-50' : null,
                         toggle && type === 'danger' ? 'bg-red-400 opacity-50' : null,
                    ]"></div>
                <!-- dot -->
                <div style="top: -.25rem;left: -.25rem;"
                     :class="[
                         toggle ? 'toggle__dot' : null,
                         toggle && type === null ? 'bg-indigo-500' : null,
                         toggle && type === 'default' ? 'bg-indigo-500' : null,
                         toggle && type === 'info' ? 'bg-blue-500' : null,
                         toggle && type === 'success' ? 'bg-green-500' : null,
                         toggle && type === 'warning' ? 'bg-yellow-500' : null,
                         toggle && type === 'danger' ? 'bg-red-500' : null,
                     ]"
                     class="transition-all duration-500 ease-in-out absolute w-6 h-6 bg-white rounded-full shadow inset-y-0 left-0"></div>
            </div>

            <span v-if="!link && label" class="text-sm leading-5 font-medium text-gray-700 block ml-2">{{ label }}</span>
            <a :href="link" target="_blank" v-else class="text-sm leading-5 font-medium text-blue-500 block ml-2 hover:underline hover:text-blue-600">{{ label }}</a>

        </label>

        <p v-text="getErrors()"
           class="my-2 text-red-600 font-medium text-sm"
           v-if="errors && errors[name] !== null">
        </p>

    </div>
</template>

<script>
    export default {
        name: "Toggle",
        data: () => ({
            toggle: false,
            errorString: null,
        }),
        props: {
            name: {
                type: String,
                required: true,
            },
            value: null,
            type: {
                type: String,
                default: 'default',
                validator: function(value) {
                    return ['default', 'info', 'success', 'warning', 'danger'].includes(value);
                }
            },
            label: {
                type: String,
                default: null,
            },
            link: null,
            errors: null,
        },
        methods: {
            changeToggle() {
                this.toggle = ! this.toggle;
                this.$emit('input', this.toggle);
                if(this.errors && this.errors[this.name]) {
                    this.errors[this.name] = null;
                }
            },
            getErrors() {
                if(this.errors && this.errors[this.name]) {
                    return this.errors[this.name][0];
                }
            },
        },
        created() {
            this.getErrors();
        },
    }
</script>

<style scoped>
    input:checked ~ .toggle__dot {
        transform: translateX(100%);
    }
</style>
