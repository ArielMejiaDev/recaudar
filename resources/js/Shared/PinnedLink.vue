<template>
        <div class="w-full xl:w-4/12 px-3">
            <div v-if="isOpen" @click.prevent="isOpen = !isOpen" class="xl:hidden bg-black bg-opacity-25 absolute inset-0 z-10"></div>
            <div class="flex items-center bg-white rounded-lg text-gray-800 shadow transition duration-500 ease-in-out hover:shadow-lg">
                <!--Initials-->
                <InertiaLink :href="link || '#'" class="cursor-pointer h-full w-2/12 py-4 px-8 text-lg font-semibold rounded-l-lg text-white flex items-center justify-center" :class="randomColor">{{ initials }}</InertiaLink>
                <!--End Initials-->
                <!--Text -->
                <InertiaLink :href="link || '#'" class="cursor-pointer px-3 mr-auto py-0 my-0 w-full h-full flex flex-col items-start">
                    <h4 class="text-gray-800 font-semibold text-xs leading-tight">{{ excerpt(title) }}</h4>
                    <small class="text-xs text-gray-500 text-xs leading-tight" v-if="info">{{ excerpt(info) }}</small>
                </InertiaLink>
                <!--End Text-->
                <div class="relative p-3">
                    <!--Dots-->
                    <a href="#" @click.prevent="isOpen = !isOpen" class="cursor-pointer text-gray-500">
                        <svg fill="currentColor" class="w-5 h-5" style="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0-6a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"></path></svg>
                    </a>
                    <!--End Dots-->
                    <transition name="fade">
                        <template v-if="isOpen">
                            <!-- Dropdown menu-->
                            <div class="options absolute bg-white text-gray-600 origin-top-right right-0 mt-6 w-56 rounded-md shadow-lg overflow-hidden z-10">
                                <!--Edit Icon-->
                                <InertiaLink :href="editLink || '#'" class="flex py-3 px-2 text-sm font-bold hover:bg-gray-100">
                                    <span class="mr-auto">{{ editLinkText || 'Edit' }}</span>
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5" style="">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </InertiaLink>
                                <!--End Edit Icon-->

                                <a href="#" @click.prevent="confirmation = !confirmation; isOpen = !isOpen" class="flex py-3 px-2 text-sm font-bold bg-red-400 text-white">
                                    <span class="mr-auto">{{ deleteLinkText || 'Delete' }}</span>
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5" style="">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
<!--                            end dropdown menu-->
                        </template>
                    </transition>
                </div>
            </div>

            <Modal
                v-if="confirmation"
                :type="this.modal.type || 'danger'"
                :title="this.modal.title || 'Are you sure to delete?'"
                :info="this.modal.info || 'This action cannot be revert.'"
                :action-button-text="this.modal.actionButtonText || 'Delete'"
                :close-button-text="this.modal.closeButtonText || 'Cancel'"
                @close="confirmation = !confirmation"
                @action="destroy"
            />

        </div>
</template>

<script>
import Modal from "./Modal";

export default {
    name: "PinnedLink",
    data() {
        return {
            isOpen: false,
            confirmation: false,
            text: 'acme inc',
        }
    },
    components: {
        Modal,
    },
    props: {
        title: {
            type: String,
            required: true,
        },
        titleExcerpt: {
            type: Number,
            default: 20,
        },
        info: String,
        link: String,
        editLink: String,
        editLinkText: {
            type: String,
            default: 'Edit',
        },
        deleteLink: String,
        deleteLinkText: {
            type: String,
            default: 'Delete',
        },
        modal: {
            type: null,
            title: null,
            info: null,
            closeButtonText: null,
            actionButtonText: null,
        }
    },
    computed: {
        initials() {
            if(this.title.includes(' ')) {
                return this.title.match(/[A-Z]/g).slice(0, 2).join('');
            }
            return this.title.slice(0, 2);
        },
        randomColor() {
            const colors = ['bg-green-500', 'bg-blue-800', 'bg-purple-500', 'bg-red-500', 'bg-indigo-500', 'bg-orange-500', 'bg-pink-500', 'bg-teal-500'];
            return colors[Math.floor(Math.random()*colors.length)];
        },
    },
    methods: {
        excerpt(content, length = this.titleExcerpt) {
            if (content.length > length) {
                return content.substr(content, length) + '...';
            }
            return content;
        },
        destroy() {
            this.confirmation = !this.confirmation;
            this.$inertia.delete(this.deleteLink);
        }
    },
}
</script>
