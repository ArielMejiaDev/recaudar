@extends('layout')

@section('content')

    <section class="text-gray-700 body-font relative overflow-hidden bg-gray-200">

        <x-landing.navbar-dark />

        <svg class="text-gray-300 fill-current absolute z-0" style="top: -100px; right: -200px" height="600px" width="600px" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M40.1,-46.1C54.7,-35.4,71.4,-25.5,72.8,-13.4C74.3,-1.4,60.5,12.8,51.3,30.4C42.1,47.9,37.4,68.9,25.4,76C13.3,83.2,-6,76.5,-19.1,65.9C-32.2,55.3,-39,40.9,-46,27.3C-53,13.7,-60.2,0.9,-62.4,-15.2C-64.6,-31.4,-61.8,-50.9,-50.6,-62.2C-39.4,-73.5,-19.7,-76.7,-3.5,-72.5C12.7,-68.3,25.4,-56.8,40.1,-46.1Z" transform="translate(100 100)" />
        </svg>

        <svg class="text-gray-300 fill-current absolute z-0" style="bottom: -100px; left: -300px" height="600px" width="600px" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M39.2,-40.8C54.4,-33.9,72.8,-25,74.4,-13.5C75.9,-2.1,60.5,12,48.3,23.1C36.2,34.3,27.4,42.5,17.1,45.8C6.8,49.1,-4.9,47.4,-14.8,42.9C-24.7,38.4,-32.8,31,-43.3,21C-53.8,11.1,-66.6,-1.5,-67.8,-14.9C-69,-28.4,-58.4,-42.7,-45.2,-50C-32,-57.2,-16,-57.2,-2,-54.8C12,-52.5,24,-47.6,39.2,-40.8Z" transform="translate(100 100)" />
        </svg>

        <svg class="text-gray-300 fill-current absolute z-0" style="bottom: -200px; right: 200px" height="600px" width="600px" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M36.1,-41.3C46.5,-34.2,54.7,-22.6,59.8,-8.4C64.8,5.8,66.8,22.7,60,34.8C53.2,46.8,37.7,54,22.3,58.4C6.8,62.9,-8.7,64.6,-19.6,58.6C-30.6,52.6,-37,38.8,-45.2,25.6C-53.3,12.4,-63.3,-0.3,-63,-12.7C-62.8,-25.2,-52.3,-37.5,-40.1,-44.3C-27.9,-51.1,-13.9,-52.5,-0.6,-51.8C12.8,-51.1,25.6,-48.4,36.1,-41.3Z" transform="translate(100 100)" />
        </svg>

        <div class="container px-5 py-24 mx-auto">

            <div class="flex flex-col">

                <div class="h-1 bg-gray-200 rounded overflow-hidden mt-6 lg:mt-32 mb-6">
                    <div class="w-24 h-full bg-pink"></div>
                </div>

                <div class="flex items-baseline flex-wrap sm:flex-row flex-col py-6 mb-0 md:mb-12 z-10">

                    <h1 class="sm:w-2/5 text-gray-900 font-medium title-font text-2xl mb-2 sm:mb-0 flex items-center">
                        @if ($team->logo)
                            <img src="{{ $team->logo }}" class="mr-3 rounded bg-gray-400 h-20 w-20 rounded-full mr-6 shadow-lg" alt="logo {{ $team->name }}">
                        @endif
                        {{ $team->name }}
                    </h1>

                    <span class="sm:w-3/5 flex items-center justify-end leading-relaxed text-base sm:pl-10 pl-0 text-right">

                        <a href="{{ $team->facebook_account }}" target="_blank" class="text-gray-500">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                            </svg>
                        </a>

                        <a href="{{ $team->twitter_account }}" target="_blank" class="ml-3 text-gray-500">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                            </svg>
                        </a>

                        <a href="{{ $team->instagram_account }}" target="_blank" class="ml-3 text-gray-500">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                            </svg>
                        </a>

                    </span>

                    <p class="mt-2 md:mt-10 w-full leading-relaxed text-base">{{ $team->description }}</p>
                </div>

            </div>

            <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">

                @foreach ($team->plans as $plan)

                    <div class="p-4 w-full lg:w-1/3 sm:mb-0 mb-6 z-10">

                        <a href="#" class="rounded-lg h-64 overflow-hidden block cursor-pointer relative shadow-xl">
                            @isset ($plan->banner)
                                <img alt="content" class="object-cover object-center h-full w-full" src="{{ $plan->banner }}">
                            @else
                                <img alt="content" class="object-cover object-center h-full w-full" src="https://dummyimage.com/1203x503">
                            @endisset
                            <div class="bg-gray-900 opacity-0 text-gray-100 absolute inset-0 flex items-center justify-center text-3xl font-medium tracking-widest uppercase hover:opacity-100 hover:bg-opacity-75 z-0">
                                <p class="text-sm font-bold tracking-wide bg-pink px-8 py-4">Donar</p>
                            </div>
                        </a>

                        @if ($plan->title)
                            <a href="checkout/{{ $plan->title }}" class="text-xl font-medium title-font text-gray-900 mt-5 hover:underline block">{{ $plan->title }}</a>
                        @else
                            <a href="#" class="text-xl font-medium title-font text-gray-900 mt-5 hover:underline block">No hay aportes disponibles.</a>
                        @endif

                        @if ($plan->info)
                            <p class="text-base leading-relaxed mt-2">{{ $plan->info }}</p>
                        @endif

                        <a class="text-deeppink inline-flex items-center mt-3 hover:text-red-600" href="#">
                            Donar Q @money($plan->amount_in_local_currency)
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </a>

                    </div>

                @endforeach

            </div>

        </div>


        {{-- <div class="container px-5 py-6 mx-auto flex items-center flex-col lg:flex-row">
            <div class="inline-flex sm:ml-auto sm:mt-0 justify-center lg:justify-start w-full mr-auto z-10 sm:my-2">
                @if(config('social.facebook_account_link'))
                <a href="{{ config('social.facebook_account_link') }}" target="_blank" class="text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                @endif
                @if(config('social.twitter_account_link'))
                <a href="{{ config('social.twitter_account_link') }}" target="_blank" class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                    </svg>
                </a>
                @endif
                @if(config('social.instagram_account_link'))
                <a href="{{ config('social.instagram_account_link') }}" target="_blank" class="ml-3 text-gray-500">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                @endif
            </div>
            <p class="text-sm text-gray-500 sm:my-2 mt-2 mr-0 lg:mr-4 w-20 text-center z-10">© {{ now()->year }}</p>
            <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900 mt-2 z-10">
                <img class="w-6 h-6" src="{{ asset('assets/logo-icon.svg') }}" alt="Logo">
                <img class="ml-3 w-12 h-12" src="{{ asset('assets/logo.svg') }}" alt="Recaudar.com">
            </a>
        </div> --}}


    </section>

    <x-landing.footer />

@endsection
