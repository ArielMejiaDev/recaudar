<template>
    <div class="py-8">

        <!--title-->
        <div v-if="title">
            <h2 class="text-2xl font-semibold leading-tight">{{ title }}</h2>
        </div>
        <!--endtitle-->


        <div class="flex items-center my-3" :class="searchbox.show ? 'justify-between' : 'justify-end'">

            <!--Searchbox-->
            <div class="flex-1 pr-4" v-if="searchbox.show || false">
                <div class="relative md:w-1/3">
                    <input :value="value" @input="$emit('input', $event.target.value)" type="search" class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" :placeholder="searchbox.placeholder || 'Search'">
                    <div class="absolute top-0 left-0 inline-flex items-center p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <circle cx="10" cy="10" r="7"></circle>
                            <line x1="21" y1="21" x2="15" y2="15"></line>
                        </svg>
                    </div>
                </div>
            </div>
            <!--Searchbox-->

            <!--Action-->
            <div v-if="action.show || false">
                <div class="shadow rounded-lg flex">
                    <div class="relative">
                        <InertiaLink :href="action.link || '#'" :class="colorResolver" class="rounded-lg inline-flex items-center focus:outline-none focus:shadow-outline font-semibold py-2 px-2 md:px-4">
                            {{ action.text || 'Create' }}
                        </InertiaLink>
                    </div>
                </div>
            </div>
            <!--End Action-->

        </div>


        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">

                <!--table-->
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th v-for="(header, index) in headers" :key="index" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ header }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <slot name="tableData"></slot>
                    </tbody>
                </table>
                <!--endtable-->

                <!--Pagination-->
                <div v-if="pagination.links"  class="hidden xl:block">
                    <div class="w-full flex items-center justify-end xs:mt-0 bg-gray-100">
                        <div class="mr-4 my-4">
                            <InertiaLink
                                v-for="(link, index) in pagination.links" :key="index" :href="link.url ? link.url : '#'"
                                class="w-full border border-gray-300 px-1 py-1 lg:px-4 lg:py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                :class="paginationFormatResolver(link)">
                                {{ link.label }}
                            </InertiaLink>
                        </div>
                    </div>
                </div>


                <div v-if="pagination.links" class="block xl:hidden">
                    <div class="w-full flex items-center justify-end xs:mt-0 bg-gray-100">
                        <div class="my-4 mr-4">
                            <InertiaLink
                                :href="pagination.links[0].url || '#'"
                                class="w-full border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                :class="paginationFormatResolver(pagination.links[0])">
                                {{ pagination.links[0].label }}
                            </InertiaLink>
                            <InertiaLink
                                :href="pagination.links.slice(-1)[0].url || '#'"
                                class="w-full border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                :class="paginationFormatResolver(pagination.links.slice(-1)[0])">
                                {{ pagination.links.slice(-1)[0].label }}
                            </InertiaLink>
                        </div>
                    </div>
                </div>
                <!--                End Pagination-->


                <!--Simple Pagination-->
                <div v-else
                    class="px-5 py-2 bg-gray-100 border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    <div class="w-full flex items-center xs:mt-0" :class="pagination.prevLink === null ? 'justify-end' : 'justify-between'">
                        <InertiaLink v-if="pagination.prevLink !== null" :class="pagination.prevLink === null ? 'bg-opacity-25' : null" :href="pagination.prevLink || '#'" class="text-sm hover:bg-gray-200 text-gray-500 font-semibold py-0 px-2 rounded cursor-pointer">
                            ${$page.global_trans.previous}
                        </InertiaLink>
                        <InertiaLink v-if="pagination.nextLink !== null" :class="pagination.nextLink === null ? 'bg-opacity-25' : null" :href="pagination.nextLink || '#'" class="text-sm hover:bg-gray-200 text-gray-500 font-semibold py-0 px-2 rounded cursor-pointer">
                            ${$page.global_trans.next}
                        </InertiaLink>
                    </div>
                </div>
                <!--End Simple Pagination-->

            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "Table",
    methods: {
        paginationFormatResolver(link) {
            return [
                link.label === 'Previous' || link.label === 'Anterior'  ? 'rounded-l-lg' : null,
                link.label === 'Next' || link.label === 'Siguiente' ? 'rounded-r-lg' : null,
                link.active ? 'bg-gray-200' : 'bg-white',
                link.url === null ? 'text-opacity-50' : null,
            ]
        }
    },
    computed: {
        colorResolver() {
            return [
                this.action.type === 'default' ? 'bg-white hover:bg-gray-100 text-gray-500 hover:text-blue-500' : null,
                this.action.type === null ? 'bg-white hover:bg-gray-100 text-gray-500 hover:text-blue-500' : null,
                this.action.type === 'info' ? 'bg-blue-500 hover:bg-blue-600 text-gray-100 hover:text-white' : null,
                this.action.type === 'success' ? 'bg-green-500 hover:bg-green-600 text-gray-100 hover:text-white' : null,
                this.action.type === 'warning' ? 'bg-yellow-500 hover:bg-yellow-600 text-gray-100 hover:text-white' : null,
                this.action.type === 'danger' ? 'bg-red-500 hover:bg-red-600 text-gray-100 hover:text-white' : null,
            ];
        },
    },
    props: {
        value: null,
        title: String,
        headers: Array,
        searchbox: {
            type: Object,
            default: function() {
                return {
                    show: true,
                    placeholder: 'Search',
                }
            }
        },
        pagination: {
            type: Object,
            default: function() {
                return {
                    show: true,
                    links: null,
                    prevLink: null,
                    nextLink: null,
                }
            }
        },
        action: {
            type: Object,
            default: function() {
                return {
                    show: false,
                    type: 'default',
                    text: 'Create',
                    link: '#',
                }
            }
        },
    },
}
</script>

<style scoped>

</style>
