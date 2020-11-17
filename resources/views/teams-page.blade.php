@extends('layout')

@section('content')

    <x-navbar-pink />

    <section class="text-gray-700 body-font overflow-hidden relative flex flex-col items-center justify-start bg-gray-200">

        <x-blobs />

        <div class="container mx-auto p-4 relative z-10">

            <section class="text-gray-700 body-font lg:mt-10">

                <div class="container px-2 py-2 mx-auto">

                    <h1 class="w-full text-center mb-4 text-gray-700 font-semibold uppercase tracking-tight text-2xl lg:text-5xl">{{ trans('Categories') }}</h1>

                    <div class="relative flex align-items-center justify-center">
                        <div class="flex justify-center my-4 lg:my-8 overflow-x-auto mx-0">
                            <button class="fill-current text-gray-900 absolute left-0 text-sm top-0 bottom-0 md:hidden focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 19l-7-7 7-7"></path></svg>
                            </button>
                            <a class="py-1 px-2 rounded {{ request()->categoria === null ? 'bg-primary': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-primary focus:bg-primary mx-2" href="{{ route('teams-page') }}">
                                {{ trans('All') }}
                            </a>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'salud' ? 'bg-primary': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-primary focus:bg-primary mx-2" href="{{ route('teams-page', ['categoria' => 'salud']) }}">
                                {{ trans('Health') }}
                            </a>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'educacion' ? 'bg-primary': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-primary focus:bg-primary mx-2" href="{{ route('teams-page', ['categoria' => 'educacion']) }}">
                                {{ trans('Education') }}
                            </a>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'medio-ambiente' ? 'bg-primary': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-primary focus:bg-primary mx-2" href="{{ route('teams-page', ['categoria' => 'ambientales']) }}">
                                {{ trans('Environment') }}
                            </a>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'social' ? 'bg-primary': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-primary focus:bg-primary mx-2" href="{{ route('teams-page', ['categoria' => 'social']) }}">
                                {{ trans('Social') }}
                            </a>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'nutricion' ? 'bg-primary': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-primary focus:bg-primary mx-2" href="{{ route('teams-page', ['categoria' => 'nutricion']) }}">
                                {{ trans('Nutrition') }}
                            </a>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'pobreza' ? 'bg-primary': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-primary focus:bg-primary mx-2" href="{{ route('teams-page', ['categoria' => 'pobreza']) }}">
                                {{ trans('Poverty') }}
                            </a>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'animales' ? 'bg-primary': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-primary focus:bg-primary mx-2" href="{{ route('teams-page', ['categoria' => 'animales']) }}">
                                {{ trans('Animals') }}
                            </a>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'otros' ? 'bg-primary': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-primary focus:bg-primary mx-2" href="{{ route('teams-page', ['categoria' => 'otros']) }}">
                                {{ trans('Others') }}
                            </a>

                            <button class="fill-current text-gray-900 absolute right-0 text-sm top-0 bottom-0 md:hidden focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7"></path></svg>
                            </button>
                        </div>

                    </div>


                    <div class="flex flex-wrap -m-4">

                        @forelse ($teams as $team)

                            <div class="p-4 lg:w-1/3">

                                <div class="h-full bg-gray-100 shadow-xl rounded-lg overflow-hidden">

                                    @if ($team->banner)
                                        <a href="{{ route('profile-page', $team) }}">
                                            <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ $team->banner }}" alt="{{ $team->name }}">
                                        </a>
                                    @else
                                        <a href="{{ route('profile-page', $team) }}">
                                            <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="https://dummyimage.com/720x400" alt="{{ $team->name }}">
                                        </a>
                                    @endif

                                    <div class="p-6">
                                        <h2 class="tracking-widest text-xs title-font font-medium text-gray-500 mb-1">
                                            {{ $team->public }}
                                        </h2>
                                        <a href="{{ route('profile-page', $team) }}">
                                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $team->name }}</h1>
                                        </a>

                                        <p class="leading-relaxed mb-3">@excerpt($team->description)</p>

                                        <div class="flex items-center flex-wrap ">

                                            <a class="text-primary hover:text-darkprimary hover:underline inline-flex items-center md:mb-2 lg:mb-0" href="{{ route('profile-page', $team) }}">Donar aquí
                                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12h14"></path>
                                                    <path d="M12 5l7 7-7 7"></path>
                                                </svg>
                                            </a>

                                            <span class="text-gray-600 fill-current mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-base pl-3 py-1 border-l-2 border-gray-300">
                                            <svg class="w-5 h-5 mr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>{{ $team->beneficiaries }}
                                        </span>

                                        </div>

                                    </div>
                                </div>

                            </div>

                        @empty
                            <div class="my-10 w-full flex flex-col items-center justify-center">
                                <div class="text-gray-700 fill-current mb-10">
                                    <svg class="w-20" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h2 class="tracking-wide text-3xl title-font font-medium text-center text-gray-900 mb-1 font-body">No hay fundaciones disponibles en este momento.</h2>
                            </div>
                        @endforelse

                    </div>

                </div>

            </section>

        </div>


        <div class="my-20 relative z-10 bg-gray-100">
            {{ $teams->links() }}
        </div>

    </section>




    <x-footer />



@endsection
