@extends('layout')

@section('content')

    <div x-data="form()" class="relative">

        <section class="text-gray-700 body-font relative overflow-hidden bg-gray-200">

            <x-landing.navbar-dark />

            <svg class="absolute fill-current text-gray-300 z-0" style="top: -125px; left: -25px" width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                <g transform="translate(300,300)">
                    <path d="M112.7,-140.9C144.9,-107.4,169,-70.7,184.5,-26.1C200,18.5,206.9,71,185.7,106.6C164.4,142.2,114.9,160.8,65.9,176.7C17,192.6,-31.4,205.8,-75.7,195.2C-120.1,184.6,-160.5,150.3,-194,105.6C-227.5,60.8,-254.1,5.7,-248.8,-47.2C-243.5,-100.1,-206.3,-150.8,-159.5,-181.7C-112.7,-212.6,-56.4,-223.8,-8,-214.2C40.3,-204.7,80.6,-174.3,112.7,-140.9Z" />
                </g>
            </svg>

            <svg class="absolute z-0 fill-current text-gray-300" style="top: 225px; right: -325px" height="600" width="600" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path d="M57.4,-47.4C68.1,-32.4,66,-8.9,57,6.1C48,21,32.2,27.5,14.6,39.6C-3,51.6,-22.4,69.2,-40.3,67C-58.1,64.8,-74.5,42.7,-76.9,20.8C-79.4,-1.2,-67.9,-23.1,-52.8,-39.1C-37.6,-55,-18.8,-65.1,2.3,-66.9C23.4,-68.7,46.8,-62.3,57.4,-47.4Z" transform="translate(100 100)" />
            </svg>

            <svg class="absolute z-0 fill-current text-gray-300" style="bottom: 225px; left: -325px" height="600" width="600" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path d="M35.7,-28.8C50,-21.4,68,-10.7,69.4,1.3C70.7,13.4,55.4,26.7,41,41.9C26.7,57,13.4,74,-2.3,76.2C-17.9,78.5,-35.7,66,-47.9,50.9C-60.2,35.7,-66.8,17.9,-68.7,-1.9C-70.5,-21.6,-67.7,-43.2,-55.5,-50.6C-43.2,-58,-21.6,-51.2,-5.5,-45.7C10.7,-40.3,21.4,-36.2,35.7,-28.8Z" transform="translate(100 100)" />
            </svg>

            <svg class="absolute z-0 fill-current text-gray-300" style="bottom: 25px; right: -125px" height="600" width="600" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path d="M48,-40.2C62.4,-33.6,74.3,-16.8,76.6,2.3C78.9,21.4,71.5,42.7,57.1,49.3C42.7,55.9,21.4,47.8,1.3,46.5C-18.7,45.2,-37.5,50.7,-53.9,44.1C-70.3,37.5,-84.5,18.7,-84.1,0.4C-83.7,-18,-68.9,-36,-52.4,-42.6C-36,-49.2,-18,-44.3,-0.6,-43.7C16.8,-43.1,33.6,-46.8,48,-40.2Z" transform="translate(100 100)" />
            </svg>


            <div class="container px-5 py-4 mx-auto flex flex-col mt-20 lg:my-32">

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
                            <a href="#more" class="text-pink cursor-pointer font-semibold inline-flex items-center fill-current hover:text-deeppink">Mas sobre nosotros
                                <svg class="ml-1 h-4 w-4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                            </a>
                        </div>

                    </div>

                </div>

                <div id="more" class="z-10">

                <x-dynamic-list-of-plans :team="$team" />

                </div>

            </div>

        </section>

        <x-checkout :team="$team" :locale="$locale" :variablePlanId="$variablePlanId" />

    </div>

    <x-landing.footer />

@endsection
