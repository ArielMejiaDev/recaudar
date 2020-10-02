@extends('layout')

@section('content')

    <section class="text-gray-700 body-font overflow-hidden relative flex flex-col items-center justify-start bg-gray-200">

        <x-landing.navbar-dark />

        <svg class="text-gray-300 fill-current absolute z-0" style="top: -100px; right: -200px" height="600px" width="600px" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M40.1,-46.1C54.7,-35.4,71.4,-25.5,72.8,-13.4C74.3,-1.4,60.5,12.8,51.3,30.4C42.1,47.9,37.4,68.9,25.4,76C13.3,83.2,-6,76.5,-19.1,65.9C-32.2,55.3,-39,40.9,-46,27.3C-53,13.7,-60.2,0.9,-62.4,-15.2C-64.6,-31.4,-61.8,-50.9,-50.6,-62.2C-39.4,-73.5,-19.7,-76.7,-3.5,-72.5C12.7,-68.3,25.4,-56.8,40.1,-46.1Z" transform="translate(100 100)" />
        </svg>

        <svg class="text-gray-300 fill-current absolute z-0" style="bottom: -100px; left: -300px" height="600px" width="600px" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M39.2,-40.8C54.4,-33.9,72.8,-25,74.4,-13.5C75.9,-2.1,60.5,12,48.3,23.1C36.2,34.3,27.4,42.5,17.1,45.8C6.8,49.1,-4.9,47.4,-14.8,42.9C-24.7,38.4,-32.8,31,-43.3,21C-53.8,11.1,-66.6,-1.5,-67.8,-14.9C-69,-28.4,-58.4,-42.7,-45.2,-50C-32,-57.2,-16,-57.2,-2,-54.8C12,-52.5,24,-47.6,39.2,-40.8Z" transform="translate(100 100)" />
        </svg>

        <svg class="hidden lg:block text-gray-300 fill-current absolute z-0" style="bottom: -300px; right: -200px" height="600px" width="600px" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M36.1,-41.3C46.5,-34.2,54.7,-22.6,59.8,-8.4C64.8,5.8,66.8,22.7,60,34.8C53.2,46.8,37.7,54,22.3,58.4C6.8,62.9,-8.7,64.6,-19.6,58.6C-30.6,52.6,-37,38.8,-45.2,25.6C-53.3,12.4,-63.3,-0.3,-63,-12.7C-62.8,-25.2,-52.3,-37.5,-40.1,-44.3C-27.9,-51.1,-13.9,-52.5,-0.6,-51.8C12.8,-51.1,25.6,-48.4,36.1,-41.3Z" transform="translate(100 100)" />
        </svg>

        <div class="container mx-auto p-0 md:p-4 relative z-10 mt-20">

            <section class="text-gray-700 body-font lg:mt-10">

                <div class="container px-2 py-2 mx-auto">

                    <h1 class="w-full text-center mb-4 text-gray-700 font-semibold uppercase tracking-tight text-2xl lg:text-5xl">{{ __('CATEGORIES') }}</h1>

                    <div class="relative flex align-items-center justify-center">
                        <div class="flex justify-center my-4 lg:my-8 overflow-x-auto mx-0">
                            <button class="fill-current text-gray-900 absolute left-0 text-sm top-0 bottom-0 md:hidden">
                                <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 19l-7-7 7-7"></path></svg>
                            </button>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'salud' ? 'bg-pink': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-pink focus:bg-pink mx-2" href="{{ route('teams-page', ['categoria' => 'salud']) }}">Salud</a>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'educacion' ? 'bg-pink': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-pink focus:bg-pink mx-2" href="{{ route('teams-page', ['categoria' => 'educacion']) }}">Educacion</a>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'medio-ambiente' ? 'bg-pink': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-pink focus:bg-pink mx-2" href="{{ route('teams-page', ['categoria' => 'ambientales']) }}">Ambientales</a>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'social' ? 'bg-pink': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-pink focus:bg-pink mx-2" href="{{ route('teams-page', ['categoria' => 'social']) }}">Social</a>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'nutricion' ? 'bg-pink': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-pink focus:bg-pink mx-2" href="{{ route('teams-page', ['categoria' => 'nutricion']) }}">Nutricion</a>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'pobreza' ? 'bg-pink': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-pink focus:bg-pink mx-2" href="{{ route('teams-page', ['categoria' => 'pobreza']) }}">Pobreza</a>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'animales' ? 'bg-pink': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-pink focus:bg-pink mx-2" href="{{ route('teams-page', ['categoria' => 'animales']) }}">Animales</a>
                            <a class="py-1 px-2 rounded {{ request()->categoria === 'otros' ? 'bg-pink': 'bg-red-400' }} text-white text-xs lg:text-sm tracking-tighter uppercase hover:bg-pink focus:bg-pink mx-2" href="{{ route('teams-page', ['categoria' => 'otros']) }}">Otros</a>
                            <button class="fill-current text-gray-900 absolute right-0 text-sm top-0 bottom-0 md:hidden">
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
                                        <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="https://dummyimage.com/720x400" alt="{{ $team->name }}">
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

                                            <a class="text-pink hover:text-melon hover:underline inline-flex items-center md:mb-2 lg:mb-0" href="{{ route('profile-page', $team) }}">Donar aquí
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




    <x-landing.footer />



@endsection
