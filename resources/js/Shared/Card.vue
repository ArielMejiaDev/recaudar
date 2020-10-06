<template>
<div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
    <div class="flex-auto p-5">
        <div class="flex flex-wrap">
            <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                <h5 class="text-gray-600 font-medium text-sm">{{ title }}</h5>
                <div class="flex items-baseline">
                    <span class="font-semibold text-4xl text-gray-800">{{ number }}</span>
                    <Pill v-if="pill" :type="type" class="ml-auto">{{ pill }}</Pill>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Pill from "./Pill";

export default {
    name: "Card",
    components: {
        Pill,
    },
    props: {
        title: null,
        number: null,
        pill: null,
        info: null,
        type: {
            type: String,
            default: 'default',
            validator: function(value) {
                return ['default', 'info', 'success', 'warning', 'danger'].includes(value);
            }
        }
    },
}
</script>

