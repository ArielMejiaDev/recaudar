<template>
    <aside class="w-full md:w-64 bg-gray-800 md:min-h-screen">
        <div class="flex items-center justify-between bg-gray-900 p-4 h-16">
            <a :href="route('welcome')" class="flex items-center">

                <img class="w-32 ml-6" src="/logo.svg" alt="logo">

<!--                <span class="text-gray-300 text-xl font-semibold mx-2">{{ $page.appName }}</span>-->
            </a>
            <div class="flex md:hidden">
                <button type="button" @click="isOpen = !isOpen"
                        class="text-gray-300 hover:text-gray-500 focus:outline-none focus:text-gray-500">
                    <svg class="fill-current w-8" fill="none" stroke-linecap="round" stroke-linejoin="round"
                         stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="px-2 py-6 md:block" :class="isOpen? 'block': 'hidden'">

            <!--Admin links-->
            <template v-if="$page.auth.user.role == 'app_admin' || $page.auth.user.role == 'app_editor' || $page.auth.user.role == 'app_financial'">

                <ul>
                    <li class="px-2 py-3 text-gray-300 hover:bg-gray-900 rounded" :class="route().current('admin.dashboard') ? 'bg-gray-900' : null">
                        <InertiaLink @click.passive="isOpen = !isOpen;" :href="route('admin.dashboard')" class="flex items-center">
                            <Icon name="home" class="text-gray-500 mr-2" />
                            {{ $page.global_trans.home }}
                        </InertiaLink>
                    </li>
                    <li v-if="$page.auth.user.role == 'app_admin' || $page.auth.user.role == 'app_editor'" class="px-2 py-3 hover:bg-gray-900 rounded mt-2" :class="route().current('admin.teams*') ? 'bg-gray-900' : null">
                        <InertiaLink @click.passive="isOpen = !isOpen;" :href="route('admin.teams.index')" class="flex items-center text-gray-300">
                            <Icon class="text-gray-500 mr-2" name="users"/>
                            {{ $page.global_trans.teams }}
                        </InertiaLink>
                    </li>
                    <li v-if="$page.auth.user.role == 'app_admin'" class="px-2 py-3 hover:bg-gray-900 rounded mt-2" :class="route().current('admin.charges*') ? 'bg-gray-900' : null">
                        <InertiaLink @click.passive="isOpen = !isOpen;" :href="route('admin.charges.index')" class="flex items-center text-gray-300">
                            <Icon class="text-gray-500 mr-2" name="collection" />
                            {{ $page.global_trans.charges }}
                        </InertiaLink>
                    </li>
                    <li v-if="$page.auth.user.role == 'app_admin' || $page.auth.user.role == 'app_financial'" class="px-2 py-3 hover:bg-gray-900 rounded mt-2" :class="route().current('admin.transactions*') ? 'bg-gray-900' : null">
                        <InertiaLink @click.passive="isOpen = !isOpen;" :href="route('admin.transactions.index')" class="flex items-center text-gray-300">
                            <Icon class="text-gray-500 mr-2" name="switch" />
                            {{ $page.global_trans.transactions }}
                        </InertiaLink>
                    </li>
                    <li v-if="$page.auth.user.role == 'app_admin'" class="px-2 py-3 hover:bg-gray-900 rounded mt-2" :class="route().current('admin.users_without_team') ? 'bg-gray-900' : null">
                        <InertiaLink @click.passive="isOpen = !isOpen;" :href="route('admin.users_without_team')" class="flex items-center text-gray-300">
                            <Icon class="text-gray-500 mr-2" name="user-remove" />
                            {{ $page.global_trans.users_without_team }}
                        </InertiaLink>
                    </li>
                </ul>

            </template>
                <!--End Admin links-->

            <!--User links-->
            <template v-else>

                <ul v-if="route().current('teams.index') || route().current('teams.create') || route().current('teams.edit') || route().current('profile.show')">
                    <li class="px-2 py-3 hover:bg-gray-900 rounded mt-2" :class="route().current('teams.*') ? 'bg-gray-900' : null">
                        <InertiaLink @click.passive="isOpen = !isOpen;" :href="route('teams.index')" class="flex items-center text-gray-300">
                            <Icon name="users" class="text-gray-500 mr-2" />
                            {{ $page.global_trans.teams }}
                        </InertiaLink>
                    </li>
                </ul>
                <ul v-else>
                    <li class="px-2 py-3 hover:bg-gray-900 rounded mt-2">
                        <a :href="route('profile-page', { team: $page.team.slug})" target="_blank" class="flex items-center text-gray-300">
                            <Icon name="external-link" class="text-gray-500 mr-2" />
                            {{ $page.global_trans.profile }}
                        </a>
                    </li>
                    <li class="px-2 py-3 text-gray-300 hover:bg-gray-900 rounded" :class="route().current('teams.dashboard') ? 'bg-gray-900' : null">
                        <InertiaLink @click.passive="isOpen = !isOpen;" :href="route('teams.dashboard', {team: $page.team['slug']})" class="flex items-center">
                            <Icon name="home" class="text-gray-500 mr-2" />
                            {{ $page.global_trans.home }}
                        </InertiaLink>
                    </li>
                    <li v-if="$page.auth.user.role === 'Admin'" class="px-2 py-3 hover:bg-gray-900 rounded mt-2" :class="route().current('teams.users*') ? 'bg-gray-900' : null">
                        <InertiaLink @click.passive="isOpen = !isOpen;" :href="route('teams.users.index', $page.team['slug'])" class="flex items-center text-gray-300">
                            <Icon name="users" class="text-gray-500 mr-2" />
                            {{ $page.global_trans.team }}
                        </InertiaLink>
                    </li>
                    <li v-if="$page.auth.user.role === 'Admin' || $page.auth.user.role === 'Editor'" class="px-2 py-3 hover:bg-gray-900 rounded mt-2" :class="route().current('teams.profile*') ? 'bg-gray-900' : null">
                        <InertiaLink @click.passive="isOpen = !isOpen;" :href="route('teams.profile', $page.team['slug'])" class="flex items-center text-gray-300">
                            <Icon class="w-6 text-gray-500 mr-2" name="info" />
                            {{ $page.global_trans.team_profile }}
                        </InertiaLink>
                    </li>
                    <li v-if="$page.auth.user.role === 'Admin' || $page.auth.user.role === 'Editor'" class="px-2 py-3 hover:bg-gray-900 rounded mt-2" :class="route().current('teams.plans*') ? 'bg-gray-900' : null">
                        <InertiaLink @click.passive="isOpen = !isOpen;" :href="route('teams.plans.index', $page.team['slug'])" class="flex items-center text-gray-300">
                            <Icon name="directory" class="text-gray-500 mr-2" />
                            {{ $page.global_trans.plans }}
                        </InertiaLink>
                    </li>
                    <li v-if="$page.auth.user.role === 'Admin' || $page.auth.user.role === 'Financial'" class="px-2 py-3 hover:bg-gray-900 rounded mt-2" :class="route().current('teams.transactions*') ? 'bg-gray-900' : null">
                        <InertiaLink @click.passive="isOpen = !isOpen;" :href="route('teams.transactions.index', $page.team['slug'])" class="flex items-center text-gray-300">
                            <Icon name="switch" class="text-gray-500 mr-2" />
                            {{ $page.global_trans.transactions }}
                        </InertiaLink>
                    </li>
                    <li v-if="$page.auth.user.role === 'Admin' || $page.auth.user.role === 'Editor'" class="px-2 py-3 hover:bg-gray-900 rounded mt-2" :class="route().current('teams.donation_button*') ? 'bg-gray-900' : null">
                        <InertiaLink @click.passive="isOpen = !isOpen;" :href="route('teams.donation_button', $page.team['slug'])" class="flex items-center text-gray-300">
                            <Icon name="code" class="text-gray-500 mr-2" />
                            {{ $page.global_trans.donation_button }}
                        </InertiaLink>
                    </li>
                    <li v-if="$page.auth.user.role === 'Admin'" class="px-2 py-3 hover:bg-gray-900 rounded mt-2" :class="route().current('teams.switch-plan*') ? 'bg-gray-900' : null">
                        <InertiaLink @click.passive="isOpen = !isOpen;" :href="route('teams.switch-plan.show', $page.team['slug'])" class="flex items-center text-gray-300">
                            <Icon name="switch-vertical" class="text-gray-500 mr-2" />
                            {{ $page.global_trans.switch_plan }}
                        </InertiaLink>
                    </li>
                </ul>

            </template>
            <!--End User links-->

            <div class="border-t border-gray-700 -mx-2 mt-2 md:hidden"></div>

            <ul class="mt-6 md:hidden">
                <li class="px-2 py-3 hover:bg-gray-900 rounded mt-2" :class="route().current('profile*') ? 'bg-gray-900' : null">
                    <InertiaLink @click.passive="isOpen = !isOpen" href="/profile" class="flex items-center mx-2 text-gray-300">
                        {{ $page.global_trans.profile }}
                    </InertiaLink>
                </li>
                <li @click.prevent="logout" class="px-2 py-3 hover:bg-gray-900 rounded mt-2">
                    <button class="mx-2 text-gray-300" @click="$inertia.post(route('logout'))">
                        {{ $page.global_trans.logout }}
                    </button>
                </li>
            </ul>

        </div>
    </aside>
</template>

<script>
    import Icon from "../Shared/Icon";
    import axios from "axios";

    export default {
        name: "Sidebar",
        data() {
            return {
                isOpen: false
            }
        },
        components: {
            Icon,
        },
        methods: {
            logout() {
                axios.post(this.route('logout').url(), {}).finally(() => window.location.href = '/');
            }
        }
    }
</script>
