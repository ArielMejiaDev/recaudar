<template>
    <div class="bg-gray-200 min-h-screen font-base">

        <div class="flex flex-col md:flex-row">

            <Sidebar></Sidebar>

            <div class="w-full md:flex-1">
                <nav class="hidden md:flex justify-between items-center bg-white p-4 shadow-sm h-16">
                    <div>
                        <SearchInput v-model="search" name="search" />
                    </div>
                    <div class="flex items-center ">

                        <InertiaLink href="#" class="text-gray-700 rounded-full hover:bg-gray-200 mx-6 p-2">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="bell fill-current w-6 h-6"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>
                        </InertiaLink>

                        <div  class="relative">
                            <button @click="dropdownOpen = !dropdownOpen" class="relative z-10 block h-10 w-10 rounded-full overflow-hidden shadow focus:outline-none">
                                <Avatar :src="$page.auth.user.avatar" :alt="$page.auth.user.name + ' avatar'" />
                            </button>

                            <div v-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                            <div v-show="dropdownOpen" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20 shadow-sm">
                                <InertiaLink @click.passive="dropdownOpen = !dropdownOpen" :href="route('profile.show')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</InertiaLink>
                                <a @click="$inertia.post(route('logout'))" href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                            </div>
                        </div>
                    </div>
                </nav>
                <main scroll-region>
                    <!-- Replace with your content -->
                    <div class="px-4 md:px-16 py-6 lg:py-8">
                        <Alert/>
                        <slot />
                    </div>
                    <!-- /End replace -->
                </main>
            </div>
        </div>

    </div>
</template>

<script>
import Sidebar from "../../Partials/Sidebar";
import SearchInput from "../SearchInput";
import Avatar from "../Avatar";
import Alert from "../Alert";

export default {
    name: "Layout",
    data: () => ({
        dropdownOpen: false,
        search: null,
    }),
    components: {
        Sidebar,
        SearchInput,
        Avatar,
        Alert,
    },
}
</script>
