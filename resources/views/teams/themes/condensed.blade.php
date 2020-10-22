@extends('layout')

@section('content')

    <div x-data="form()" class="relative">

        <x-checkout :team="$team" :locale="$locale" :variablePlanId="$variablePlanId" />

        <x-navbar-pink />

        <section class="lg:min-h text-gray-700 body-font relative overflow-hidden bg-gray-200">

            <x-landing.blobs :style="'alternative'" />

            <div class="container px-5 py-4 mx-auto flex flex-col lg:my-10">

                <div class="lg:w-full mx-auto z-10">

                    <div class="rounded-lg h-64 overflow-hidden shadow-lg mt-0 lg:mt-8 hidden md:block">

                        @if ($team->banner)
                            <img alt="content" class="object-cover object-center h-full w-full" src="{{ $team->banner }}">
                        @else
                            <img alt="content" class="object-cover object-center h-full w-full" src="https://dummyimage.com/720x600">
                        @endif

                    </div>

                    <div class="flex flex-col sm:flex-row mt-10">

                        <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8">

                            @if ($team->logo)
                                <div class="rounded-full inline-flex items-center justify-center bg-gray-200 text-gray-400">
                                    <img src="{{ $team->logo }}" class="mr-3 rounded bg-gray-400" alt="logo {{ $team->name }}">
                                </div>
                            @endif

                            <div class="flex flex-col items-center text-center justify-center">

                                <h2 class="font-medium title-font mt-4 text-gray-900 text-lg">{{ $team->name }}</h2>
                                <div class="w-12 h-1 bg-pink rounded mt-2 mb-4"></div>

                                <div class="flex items-center justify-center my-6">
                                    @if($team->facebook_account)
                                    <a href="{{ $team->facebook_account }}" target="_blank" class="text-gray-500">
                                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                        </svg>
                                    </a>
                                    @endif

                                    @if($team->twitter_account)
                                    <a href="{{ $team->twitter_account }}" target="_blank" class="ml-3 text-gray-500">
                                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                        </svg>
                                    </a>
                                    @endif

                                    @if($team->instagram_account)
                                    <a href="{{ $team->instagram_account }}" target="_blank" class="ml-3 text-gray-500">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                                        </svg>
                                    </a>
                                    @endif
                                </div>

                                <p class="text-base text-gray-600">{{ $team->impact }}</p>
                            </div>

                        </div>

                        <div class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-gray-300 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
                            <p class="leading-relaxed text-lg mb-4">{{ $team->description }}</p>
                            <a href="#more" class="text-pink cursor-pointer font-semibold inline-flex items-center fill-current hover:text-deeppink">
                                {{ trans('More about us') }}
                                <svg class="ml-1 h-4 w-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                            </a>
                        </div>

                    </div>

                </div>

                <div id="more" class="z-10">

                <div class="mt-8">
                    <x-dynamic-list-of-plans :team="$team" />
                </div>

                </div>

            </div>

        </section>

        <x-footer />

    </div>



@endsection
