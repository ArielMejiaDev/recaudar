@extends('layout')

@section('content')

    <x-navbar-pink />

    <section x-data="form()" class="lg:h-screen flex items-center text-gray-700 body-font relative overflow-hidden bg-gray-200">

        <x-landing.blobs />

        <div class="container px-5 py-10 mx-auto">

            <div class="flex flex-col">

                <div class="h-1 bg-gray-200 rounded overflow-hidden">
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

                    </span>

                    <p class="mt-2 md:mt-10 w-full leading-relaxed text-base">{{ $team->description }}</p>
                </div>

            </div>

            <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">

                @foreach ($team->availablePlans() as $plan)

                    <div class="p-4 w-full lg:w-1/3 sm:mb-0 mb-6 z-10">


                        @isset ($plan->banner)
                            <a href="#" @click.prevent="selectPlan({{ $plan }})" class="rounded-lg h-64 overflow-hidden block cursor-pointer relative shadow-xl">
                                <img alt="content" class="object-cover object-center h-full w-full" src="{{ $plan->banner }}">
                                <div class="bg-gray-900 opacity-0 text-gray-100 absolute inset-0 flex items-center justify-center text-3xl font-medium tracking-widest uppercase hover:opacity-100 hover:bg-opacity-75 z-0">
                                    <p class="text-sm font-bold tracking-wide bg-pink px-8 py-4">{{ trans('Donate') }}</p>
                                </div>
                            </a>
                        @endisset

                        @if ($plan->title)
                            <a href="#" @click.prevent="selectPlan({{ $plan }})" class="text-xl font-medium title-font text-gray-900 mt-5 hover:underline block">{{ $plan->title }}</a>
                        @else
                            <a href="#" class="text-xl font-medium title-font text-gray-900 mt-5 hover:underline block">No hay aportes disponibles.</a>
                        @endif

                        @if ($plan->info)
                            <p class="text-base leading-relaxed mt-2">{{ $plan->info }}</p>
                        @endif

                        <a @click.prevent="selectPlan({{ $plan }})" class="text-pink inline-flex items-center mt-3 hover:text-melon hover:underline" href="#">
                            {{ trans('Donate') }} <span class="ml-2" x-text="money_format({{ $plan->amount_in_local_currency }})"></span>
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </a>

                    </div>

                @endforeach

            </div>

        </div>

        <x-checkout :team="$team" :locale="$locale" :variablePlanId="$variablePlanId" />

    </section>

    <x-footer />

@endsection
