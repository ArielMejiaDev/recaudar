<template>
<div>

<!--    Pagination-->

    <!--Web-->
    <div v-if="config.links" class="hidden xl:block">
        <div class="w-full flex items-center justify-end xs:mt-0">
            <div class="">
                <InertiaLink
                    v-for="(link, index) in config.links" :key="index"
                    :href="link.url ? link.url : '#'"
                    class="w-full border border-gray-300 px-1 py-1 lg:px-4 lg:py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                    :class="paginationFormatResolver(link)">
                    {{ link.label }}
                </InertiaLink>
            </div>
        </div>
    </div>

    <!--Mobile-->
    <div v-if="config.links" class="block xl:hidden">
        <div class="w-full flex items-center justify-end xs:mt-0">
            <div class="">
                <InertiaLink
                    :href="config.links[0].url || '#'"
                    class="w-full border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                    :class="paginationFormatResolver(config.links[0])">
                    {{ config.links[0].label }}
                </InertiaLink>
                <InertiaLink
                    :href="config.links.slice(-1)[0].url || '#'"
                    class="w-full border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                    :class="paginationFormatResolver(config.links.slice(-1)[0])">
                    {{ config.links.slice(-1)[0].label }}
                </InertiaLink>
            </div>
        </div>
    </div>
    <!--End Mobile-->
<!--End Pagination-->

<!--Simple Pagination-->
    <div v-else class="w-full flex items-center justify-center">
        <div class="inline-flex">
            <InertiaLink v-if="config.prevLink !== null" :href="config.prevLink" class="w-full border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                         :class="[
                             config.prevLink === null ? 'bg-opacity-25' : null,
                             config.nextLink === null ? 'rounded' : 'rounded-l'
                         ]">
                {{ config.prevLinkText || '<' }}
            </InertiaLink>
            <InertiaLink v-if="config.nextLink !== null" :href="config.nextLink" class="w-full border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                         :class="[
                    config.nextLink === null ? 'bg-opacity-25' : null,
                    config.prevLink === null ? 'rounded' : 'rounded-r',
                ]"
            >
                {{ config.nextLinkText || '>' }}
            </InertiaLink>
        </div>
    </div>
<!--EndSimplePagination-->
</div>

</template>

<script>
export default {
    name: 'Pagination',
    props: {
        config: {
            type: Object,
            default: {
                links: null,
                prevLinkText: 'Prev',
                nextLinkText: 'Next',
                prevLink: null,
                nextLink: null,
            },
        },
    },
    methods: {
        paginationFormatResolver(link) {
            return [
                link.label === 'Previous' ? 'rounded-l-lg' : null,
                link.label === 'Next' ? 'rounded-r-lg' : null,
                link.active ? 'bg-gray-200' : 'text-gray-500',
                link.url === null ? 'text-opacity-50' : null,
            ]
        }
    },
}
</script>
