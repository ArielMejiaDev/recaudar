@extends('layout')

@section('content')

    <x-navbar-pink />

    <section x-data="form()" class="lg:min-h-screen text-gray-700 body-font overflow-hidden relative flex flex-col items-center justify-center bg-gray-200">

        <x-landing.blobs />

        <div class="container px-5 py-10 mx-auto relative z-10">
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
                        @if($team->facebook_account)
                        <a href="{{ $team->facebook_account }}" target="_blank" class="text-gray-500">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                            </svg>
                        </a>
                        @endif

                        @if($team->twitter_account)
                        <a href="{{ $team->twitter_account }}" target="_blank" class="ml-2 text-gray-500">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                            </svg>
                        </a>
                        @endif

                        @if($team->instagram_account)
                        <a href="{{ $team->instagram_account }}" target="_blank" class="ml-2 text-gray-500">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                            </svg>
                        </a>
                        @endif
                    </span>
                    </div>

                    <p class="leading-relaxed">{{ $team->description }}</p>

                    <p class="leading-relaxed my-3">{{ $team->impact }}</p>

                </div>

            </div>

            <div class="mt-16 lg:w-4/5 mx-auto">
                <x-dynamic-list-of-plans :team="$team" />
            </div>

            <x-checkout :team="$team" :locale="$locale" :variablePlanId="$variablePlanId" />

        </div>

    </section>

    <x-footer />

@endsection
