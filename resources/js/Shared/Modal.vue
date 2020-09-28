<template>
    <transition name="fade">

        <div v-if="showComponent" @keydown.esc="close()" class="fixed inset-0 w-full h-screen flex items-center justify-center bg-semi-75 z-10" @click.self="close">

            <div @click.prevent="close" class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>

            <div class="relative w-full max-w-2xl bg-white shadow-lg rounded-lg">
                <button aria-label="close" class="absolute top-0 right-0 text-xl text-gray-500 my-2 mx-4 focus:outline-none" @click.prevent="close">×</button>
                <slot />

                <div>

                    <div class="sm:flex sm:items-start px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                        <div
                             :class="[
                                 type === 'default' || type === null ? 'bg-indigo-100' : null,
                                 type === 'info' ? 'bg-blue-100' : null,
                                 type === 'success' ? 'bg-green-100' : null,
                                 type === 'warning' ? 'bg-yellow-100' : null,
                                 type === 'danger' ? 'bg-danger-100' : null,
                             ]"
                             class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">

                            <svg v-if="type === null || type === 'default'" class="h-6 w-6 fill-current text-indigo-600" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"/>
                            </svg>

                            <svg v-if="type === 'info'" class="h-6 w-6 fill-current text-blue-600" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"/>
                            </svg>

                            <svg v-if="type === 'success'" class="h-6 w-6 fill-current text-green-600" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"/>
                            </svg>

                            <svg v-if="type === 'warning'" class="h-6 w-6 fill-current text-yellow-600" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"/>
                            </svg>

                            <svg v-if="type === 'danger'" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>

                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">{{ title }}</h3>
                            <div class="mt-2">
                                <p class="text-sm leading-5 text-gray-500">{{ info }}</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="bg-gray-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg">
                    <span v-if="actionButtonText" class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button ref="action" @click.prevent="action" type="button"
                                :class="[
                                    type === 'default' || type === null ? 'bg-indigo-600 hover:bg-indigo-500 focus:border-indigo-700' : null,
                                    type === 'info'    ? 'bg-blue-600 hover:bg-blue-500 focus:border-blue-700'     : null,
                                    type === 'success' ? 'bg-green-600 hover:bg-green-500 focus:border-green-700'   : null,
                                    type === 'warning' ? 'bg-yellow-600 hover:bg-yellow-500 focus:border-yellow-700' : null,
                                    type === 'danger'  ? 'bg-red-600 hover:bg-red-500 focus:border-red-700'       : null,
                                ]"
                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium text-white shadow-sm focus:outline-none focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                          {{ actionButtonText }}
                        </button>
                    </span>
                    <span v-if="closeButtonText" class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button @click.prevent="close" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                          {{ closeButtonText }}
                        </button>
                    </span>
                </div>

            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name: "Modal",
    data: () => ({
        showComponent: false,
    }),
    props: {
        time: {
            type: Number,
            default: 60000,
        },
        type: {
            type: String,
            default: 'default',
        },
        title: {
            type: String,
            required: true,
        },
        info: {
            type: String,
        },
        closeButtonText: null,
        actionButtonText: null,
    },
    watch: {
        show(value) {
            if (value) {
                this.showModal();
                return document.querySelector('body').classList.add('overflow-hidden');
            }
            document.querySelector('body').classList.remove('overflow-hidden');
        },
        showComponent() {
            this.$nextTick(() => {
                let actionButtonReference = this.$refs['action'];
                if (actionButtonReference) {
                    actionButtonReference.focus()
                }
            });
        },
    },
    methods: {
        showModal() {
            setTimeout(() => {
                this.showComponent = true;
            }, 300);
        },
        hideModal() {
            this.showComponent = false;
        },
        close() {
            this.$emit('close');
            this.hideModal();
        },
        action() {
            this.$emit('action');
            this.hideModal();
        },
    },
    created() {
        this.showModal();
    },
}
</script>
