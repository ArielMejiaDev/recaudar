<template>
    <Panel>
        <template v-slot:header>
            <Title :info="trans.subtitle">{{ trans.donation_button }}</Title>
        </template>
        <template v-slot:body>
            <div class="flex flex-col">
                <div class="p-4 bg-gray-200 text-gray-700 rounded shadow overflow-x-scroll md:overflow-auto">
                    <code class="text-xs md:text-base" v-text="`&lt;iframe src=&quot;${url}/donation-button/${team.slug}&quot; height=&quot;100&quot; width=&quot;100&quot; frameborder=&quot;0&quot;&gt;&lt;/iframe&gt;`"></code>
                </div>
            </div>
        </template>
        <template v-slot:footer>



                <div class="relative flex items-center text-gray-500 cursor-pointer hover:text-gray-600" @mouseleave="hover = false">
                    <button @click="copyUrlToClipboard" class="py-2 px-4 rounded bg-indigo-500 text-indigo-100 hover:bg-indigo-600 hover:text-white ml-auto">{{ trans.copy }}</button>
                    <div class="relative">
                        <div class="absolute bottom-0 inline-block p-1 mb-10 -ml-12 text-white bg-gray-700 rounded-lg" v-if="hover">
                            <transition name="fade">
                                <span class="inline-block text-xs leading-tight relative z-10">
                                    {{ trans.copied }}!
                                </span>
                            </transition>
                            <span class="absolute bottom-0 right-0 w-5 h-5 -mb-1 transform rotate-45 bg-gray-700" style="left:50%;"></span>
                        </div>
                    </div>
                </div>

        </template>
    </Panel>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import Panel from "../../../Shared/Panel";
import Title from "../../../Shared/Title";

export default {
    name: "Index",
    metaInfo: "Donation Button",
    layout: SidebarLayout,
    components: {
        Panel,
        Title,
    },
    data() {
        return {
            url: process.env.MIX_APP_URL,
            hover: false,
        }
    },
    props: {
        team: Object,
        trans: Object,
    },
    methods: {
        copyUrlToClipboard(){
            const url = `<iframe src="${this.url}/donation-button/${this.team.slug}" height="100" width="100" frameborder="0"></iframe>`;
            const el = document.createElement('input');
            el.value = url;
            el.setAttribute('readonly', '');
            el.style.position = 'absolute';
            el.style.left = '-9999px';
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            this.hover = true;
            document.body.removeChild(el);
        }
    }
}
</script>
