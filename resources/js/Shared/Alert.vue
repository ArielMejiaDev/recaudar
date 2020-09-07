<template>
    <div>
        <transition name="fade">
            <div v-if="$page.flash.success && show" class="mb-8 flex items-center justify-between bg-green-200 rounded w-full">
                <div class="flex items-center text-green-700">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="check w-6 h-6 fill-current ml-4 mr-2 flex-shrink"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <div class="py-4 text-sm font-bold">{{ $page.flash.success }}</div>
                </div>
                <button type="button" class="group mr-2 p-2 text-green-700 focus:outline-none" @click="show = false">
                    <svg class="block w-2 h-2 fill-green-700 fill-current" xmlns="http://www.w3.org/2000/svg" width="235.908" height="235.908" viewBox="278.046 126.846 235.908 235.908"><path d="M506.784 134.017c-9.56-9.56-25.06-9.56-34.62 0L396 210.18l-76.164-76.164c-9.56-9.56-25.06-9.56-34.62 0-9.56 9.56-9.56 25.06 0 34.62L361.38 244.8l-76.164 76.165c-9.56 9.56-9.56 25.06 0 34.62 9.56 9.56 25.06 9.56 34.62 0L396 279.42l76.164 76.165c9.56 9.56 25.06 9.56 34.62 0 9.56-9.56 9.56-25.06 0-34.62L430.62 244.8l76.164-76.163c9.56-9.56 9.56-25.06 0-34.62z" /></svg>
                </button>
            </div>
        </transition>

        <transition name="fade">
            <div v-if="$page.flash.info && show" class="mb-8 flex items-center justify-between bg-blue-200 rounded w-full">
                <div class="flex items-center text-blue-700">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="check w-6 h-6 fill-current ml-4 mr-2 flex-shrink"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <div class="py-4 text-blue-700 text-sm font-bold">{{ $page.flash.info }}</div>
                </div>
                <button type="button" class="group mr-2 p-2 text-blue-700 focus:outline-none" @click="show = false">
                    <svg class="block w-2 h-2 fill-blue-700 fill-current" xmlns="http://www.w3.org/2000/svg" width="235.908" height="235.908" viewBox="278.046 126.846 235.908 235.908"><path d="M506.784 134.017c-9.56-9.56-25.06-9.56-34.62 0L396 210.18l-76.164-76.164c-9.56-9.56-25.06-9.56-34.62 0-9.56 9.56-9.56 25.06 0 34.62L361.38 244.8l-76.164 76.165c-9.56 9.56-9.56 25.06 0 34.62 9.56 9.56 25.06 9.56 34.62 0L396 279.42l76.164 76.165c9.56 9.56 25.06 9.56 34.62 0 9.56-9.56 9.56-25.06 0-34.62L430.62 244.8l76.164-76.163c9.56-9.56 9.56-25.06 0-34.62z" /></svg>
                </button>
            </div>
        </transition>

        <transition name="fade">
            <div v-if="$page.flash.warning && show" class="mb-8 flex items-center justify-between bg-yellow-200 rounded w-full">
                <div class="flex items-center text-yellow-700">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="check w-6 h-6 fill-current ml-4 mr-2 flex-shrink"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <div class="py-4 text-sm font-bold">{{ $page.flash.warning }}</div>
                </div>
                <button type="button" class="group mr-2 p-2 focus:outline-none text-yellow-700" @click="show = false">
                    <svg class="block w-2 h-2 fill-yellow-800 fill-current" xmlns="http://www.w3.org/2000/svg" width="235.908" height="235.908" viewBox="278.046 126.846 235.908 235.908"><path d="M506.784 134.017c-9.56-9.56-25.06-9.56-34.62 0L396 210.18l-76.164-76.164c-9.56-9.56-25.06-9.56-34.62 0-9.56 9.56-9.56 25.06 0 34.62L361.38 244.8l-76.164 76.165c-9.56 9.56-9.56 25.06 0 34.62 9.56 9.56 25.06 9.56 34.62 0L396 279.42l76.164 76.165c9.56 9.56 25.06 9.56 34.62 0 9.56-9.56 9.56-25.06 0-34.62L430.62 244.8l76.164-76.163c9.56-9.56 9.56-25.06 0-34.62z" /></svg>
                </button>
            </div>
        </transition>

        <div v-if="($page.flash.error || Object.keys($page.errors).length > 0) && show" class="mb-8 flex items-center justify-between bg-red-200 rounded w-full">
            <div class="flex items-center text-red-500">
                <svg viewBox="0 0 20 20" fill="currentColor" class="x-circle ml-4 mr-2 flex-shrink-0 w-6 h-6 fill-current"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                <div v-if="$page.flash.error" class="py-4 text-red-500 text-sm font-bold">{{ $page.flash.error }}</div>
                <div v-else class="py-4 text-red-700 text-sm font-bold">
                    <span v-if="$page.errors.error">{{ $page.errors.error[0] }}</span>
                    <span v-else-if="Object.keys($page.errors).length === 1">There is one error.</span>
                    <span v-else>There are {{ Object.keys($page.errors).length }} errors.</span>
                </div>
            </div>
            <button type="button" class="group mr-2 p-2 text-red-700 focus:outline-none" @click="show = false">
                <svg class="block w-2 h-2 fill-red-800 fill-current" xmlns="http://www.w3.org/2000/svg" width="235.908" height="235.908" viewBox="278.046 126.846 235.908 235.908"><path d="M506.784 134.017c-9.56-9.56-25.06-9.56-34.62 0L396 210.18l-76.164-76.164c-9.56-9.56-25.06-9.56-34.62 0-9.56 9.56-9.56 25.06 0 34.62L361.38 244.8l-76.164 76.165c-9.56 9.56-9.56 25.06 0 34.62 9.56 9.56 25.06 9.56 34.62 0L396 279.42l76.164 76.165c9.56 9.56 25.06 9.56 34.62 0 9.56-9.56 9.56-25.06 0-34.62L430.62 244.8l76.164-76.163c9.56-9.56 9.56-25.06 0-34.62z" /></svg>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Alert',
    data() {
        return {
            show: true,
        }
    },
    watch: {
        '$page.flash': {
            handler() {
                this.show = true
            },
            deep: true,
        },
    },
}
</script>
