@extends('layout')

@section('content')

    <x-navbar-pink />

    <section x-data="{ selectedPlan: 2 }" class="text-gray-700 body-font overflow-hidden">
        <div class="container px-5 py-24 mx-auto">

            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">@lang('Pricing')</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">@lang('Explore the right plan for your organization.')</p>
{{--                <div class="flex mx-auto border-2 border-red-500 rounded overflow-hidden mt-6">--}}
{{--                    <button class="py-1 px-4 bg-red-500 text-white focus:outline-none">Monthly</button>--}}
{{--                    <button class="py-1 px-4 focus:outline-none">Annually</button>--}}
{{--                </div>--}}
            </div>

            <div class="flex flex-wrap -m-4">

                <div class="p-4 xl:w-1/3 md:w-1/2 w-full">
                    <div @click="selectedPlan = 1" :class="selectedPlan === 1 ? 'border-pink' : 'border-gray-300'" class="cursor-pointer h-full p-6 rounded-lg border-2 flex flex-col relative overflow-hidden">
                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium uppercase">@lang('basic')</h2>
                        <h1 class="text-5xl text-gray-900 pb-4 mb-4 border-b border-gray-200 leading-none">@lang('Free')</h1>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                              </svg>
                            </span>@lang('Self-managing site with subdomain (organization.recaudar.org).')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                              </svg>
                            </span>@lang('3 Themes for profiles.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Security SSL certificate.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Checkout for donations.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Creation of links for donation.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Donation with variable amount.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Details of transactions.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Up to 1 administration users.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Up to 5 donation plans.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Biweekly deposits.')
                        </p>
                        @guest()
                            <a href="{{ route('register') }}" :class="selectedPlan === 1 ? 'bg-melon hover:bg-pink' : 'bg-gray-500 hover:bg-gray-600' " class="flex items-center mt-auto text-white border-0 py-2 px-4 w-full focus:outline-none rounded">@lang('Select a plan')
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @endguest
                        @auth()
                            <a href="#" :class="selectedPlan === 1 ? 'bg-melon hover:bg-pink' : 'bg-gray-500 hover:bg-gray-600' " class="flex items-center mt-auto text-white border-0 py-2 px-4 w-full focus:outline-none rounded">@lang('Select a plan')
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @endauth
                        <p class="text-xs text-gray-500 mt-3">@lang('The rate 8% + Q2.00 per transaction.')</p>
                    </div>
                </div>

                <div class="p-4 xl:w-1/3 md:w-1/2 w-full">
                    <div @click="selectedPlan = 2" :class="selectedPlan === 2 ? 'border-pink' : 'border-gray-300'" class="cursor-pointer h-full p-6 rounded-lg border-2 flex flex-col relative overflow-hidden">
                        <span class="bg-pink text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl">POPULAR</span>
                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium">PRO</h2>
                        <h1 class="text-5xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                            <span>$13</span>
                            <span class="text-lg ml-1 font-normal text-gray-500">/@lang('monthly')</span>
                        </h1>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Self-managing site with subdomain (organization.recaudar.org).')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('3 Themes for profiles.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Security SSL certificate.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Checkout for donations.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Creation of links for donation.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Donation with variable amount.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Details of transactions.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Up to 3 administration users.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Up to 10 donation plans.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Weekly deposits.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Donation button for your website.')
                        </p>
                        @guest()
                            <a href="{{ route('register') }}" :class="selectedPlan === 2 ? 'bg-melon hover:bg-pink' : 'bg-gray-500 hover:bg-gray-600'" class="flex items-center mt-auto text-white border-0 py-2 px-4 w-full focus:outline-none rounded">@lang('Select a plan')
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @endguest
                        @auth()
                            <a href="#" :class="selectedPlan === 2 ? 'bg-melon hover:bg-pink' : 'bg-gray-500 hover:bg-gray-600'" class="flex items-center mt-auto text-white border-0 py-2 px-4 w-full focus:outline-none rounded">@lang('Select a plan')
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @endauth
                        <p class="text-xs text-gray-500 mt-3">@lang('The rate 5.5% + Q2.00 per transaction.')</p>
                    </div>
                </div>

                <div class="p-4 xl:w-1/3 md:w-1/2 w-full">
                    <div @click="selectedPlan = 3" :class="selectedPlan === 3 ? 'border-pink' : 'border-gray-300' " class="cursor-pointer h-full p-6 rounded-lg border-2 flex flex-col relative overflow-hidden">
                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium uppercase">@lang('Premium')</h2>
                        <h1 class="text-5xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                            <span class="text-5xl ml-1 font-normal text-gray-500">@lang('Coming soon')</span>
                        </h1>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Self-managing site with subdomain (organization.recaudar.org).')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('3 Themes for profiles.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Security SSL certificate.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Checkout for donations.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Creation of links for donation.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Donation with variable amount.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Details of transactions.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Unlimited admin users.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Unlimited donation plans.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Weekly deposits.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Donation button for your website.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Integration with payment gateways.')
                        </p>
                        <p class="flex items-start text-gray-600 my-2">
                            <span class="w-4 h-4 mr-2 mt-1 inline-flex items-center justify-center bg-gray-500 text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>@lang('Volunteer module.')
                        </p>
                            <div class="flex items-center mt-auto text-white border-0 py-2 px-4 bg-gray-500 hover:bg-gray-600 w-full focus:outline-none rounded">
                                @lang('Coming soon')
                            </div>
                        <p class="text-xs text-gray-500 mt-3">@lang('The transaction fee 1% + the percentage of the payment gateway.')</p>
                    </div>
                </div>

            </div>



        </div>
    </section>

    <x-footer />

@endsection

