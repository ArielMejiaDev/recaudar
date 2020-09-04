<template>

    <div class="fixed block alert" style="">
        <transition name="fade">
            <div v-if="showComponent" class="flex md:max-w-sm w-full mx-auto bg-white shadow-md rounded-none md:rounded-lg overflow-hidden">

                <div class="flex justify-center items-center w-12"
                     :class="[
                         type === 'default' || type === null ? 'bg-indigo-500'  : null,
                         type === 'info'    ? 'bg-blue-500'   : null,
                         type === 'success' ? 'bg-green-500'  : null,
                         type === 'warning' ? 'bg-yellow-500' : null,
                         type === 'danger'  ? 'bg-red-500'    : null,
                     ]">

                    <svg v-if="type === 'success'" class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"/>
                    </svg>

                    <svg v-if="type === 'info' || type === 'default' || type === null" class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"/>
                    </svg>

                    <svg v-if="type === 'warning'" class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"/>
                    </svg>

                    <svg v-if="type === 'danger'" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>

                </div>

                <div class="-mx-3" :class="[info ? 'py-2 px-4' : 'p-4']">
                    <div class="mx-3">
                        <span class="font-semibold"
                          :class="[
                            type === 'default' || type === null ? 'text-indigo-500'  : null,
                            type === 'info'    ? 'text-blue-500'    : null,
                            type === 'success' ? 'text-green-500'   : null,
                            type === 'warning' ? 'text-yellow-500'  : null,
                            type === 'danger'  ? 'text-red-500'     : null,
                          ]"
                        >{{ title }}</span>
                        <p class="text-gray-600 text-sm" v-if="info">{{ info }}</p>
                    </div>
                </div>

            </div>
        </transition>
    </div>

</template>

<script>
    export default {
        name: "Toast",
        data: () => ({
            showComponent: false,
        }),
        props: {
            title: {
                type: String,
                required: true,
            },
            info: {
                type: String,
            },
            type: {
                type: String,
                default: 'default',
            },
            time: {
                type: Number,
                default: 4000,
            },
        },
        methods: {
            showAlert() {
                setTimeout(() => {
                    this.showComponent = true
                    this.hideAlert();
                }, 500);
            },
            hideAlert() {
                setTimeout(() => this.showComponent = false, this.time);
            },
        },
        created() {
            this.showAlert();
        },
    }
</script>

