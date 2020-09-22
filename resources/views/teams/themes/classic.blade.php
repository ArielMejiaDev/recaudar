@extends('layout')

@section('content')

    <section class="h-auto xl:h-screen text-gray-700 body-font overflow-hidden relative flex flex-col items-center justify-center bg-gray-200">

        <x-landing.navbar-dark />

        <svg class="text-gray-300 fill-current absolute z-0" style="top: -100px; right: -200px" height="600px" width="600px" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M40.1,-46.1C54.7,-35.4,71.4,-25.5,72.8,-13.4C74.3,-1.4,60.5,12.8,51.3,30.4C42.1,47.9,37.4,68.9,25.4,76C13.3,83.2,-6,76.5,-19.1,65.9C-32.2,55.3,-39,40.9,-46,27.3C-53,13.7,-60.2,0.9,-62.4,-15.2C-64.6,-31.4,-61.8,-50.9,-50.6,-62.2C-39.4,-73.5,-19.7,-76.7,-3.5,-72.5C12.7,-68.3,25.4,-56.8,40.1,-46.1Z" transform="translate(100 100)" />
        </svg>

        <svg class="text-gray-300 fill-current absolute z-0" style="bottom: -100px; left: -300px" height="600px" width="600px" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M39.2,-40.8C54.4,-33.9,72.8,-25,74.4,-13.5C75.9,-2.1,60.5,12,48.3,23.1C36.2,34.3,27.4,42.5,17.1,45.8C6.8,49.1,-4.9,47.4,-14.8,42.9C-24.7,38.4,-32.8,31,-43.3,21C-53.8,11.1,-66.6,-1.5,-67.8,-14.9C-69,-28.4,-58.4,-42.7,-45.2,-50C-32,-57.2,-16,-57.2,-2,-54.8C12,-52.5,24,-47.6,39.2,-40.8Z" transform="translate(100 100)" />
        </svg>

        <svg class="text-gray-300 fill-current absolute z-0" style="bottom: -300px; right: 200px" height="600px" width="600px" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M36.1,-41.3C46.5,-34.2,54.7,-22.6,59.8,-8.4C64.8,5.8,66.8,22.7,60,34.8C53.2,46.8,37.7,54,22.3,58.4C6.8,62.9,-8.7,64.6,-19.6,58.6C-30.6,52.6,-37,38.8,-45.2,25.6C-53.3,12.4,-63.3,-0.3,-63,-12.7C-62.8,-25.2,-52.3,-37.5,-40.1,-44.3C-27.9,-51.1,-13.9,-52.5,-0.6,-51.8C12.8,-51.1,25.6,-48.4,36.1,-41.3Z" transform="translate(100 100)" />
        </svg>

        <div class="container px-5 py-24 mx-auto relative z-10">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">

                @if ($team->banner)
                    <img alt="Foundation image" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded bg-red-500" src="{{ $team->banner }}">
                @else
                    <img alt="Foundation image" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="https://dummyimage.com/400x400">
                @endif

                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ $team->public }}</h2>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $team->name }}</h1>

                    <div class="flex mb-4">
                    <span class="flex py-2 border-l-2 border-gray-200">
                        <a href="{{ $team->facebook_account }}" target="_blank" class="text-gray-500">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                            </svg>
                        </a>
                        <a href="{{ $team->twitter_account }}" target="_blank" class="ml-2 text-gray-500">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                            </svg>
                        </a>
                        <a href="{{ $team->instagram_account }}" target="_blank" class="ml-2 text-gray-500">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                            </svg>
                        </a>
                    </span>
                    </div>

                    <p class="leading-relaxed">{{ $team->description }}</p>

                    <p class="leading-relaxed my-3">{{ $team->impact }}</p>

                    @forelse ($plans as $plan)
                        <div class="flex items-center p-4 border-b-2 border-gray-200 hover:bg-gray-300">

                            <span class="title-font font-bold tracking-tighter text-xs uppercase text-gray-900">{{ $plan->title }}</span>

                            <a href="#" class="flex items-center ml-auto text-pink hover:text-red-600">
                                Donar Q @money($plan->amount_in_local_currency)
                                <div class="fill-current">
                                    <svg class="w-4 h-4 ml-2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </div>
                            </a>

                        </div>

                        <hr>
                    @empty
                        <span class="title-font font-bold tracking-tighter text-xs uppercase text-gray-900">No hay aportes disponibles.</span>
                    @endforelse

                </div>

            </div>

        </div>

    </section>

    <x-landing.footer />

@endsection
