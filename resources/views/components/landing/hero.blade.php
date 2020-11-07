
<div class="h-screen relative md:flex md:flex-col font-body bg-cover bg-no-repeat bg-center"
     style="background-image: url({{ asset('images/landing/hero/bg.jpeg') }});">

    <x-navbar-transparent />

    <!-- overlay -->
    <div class="absolute inset-0 bg-black opacity-75 z-0"></div>

    <div class="relative z-10 w-full h-full flex flex-col items-center justify-center text-white px-3 container mx-auto">
        <h1 class="text-center text-4xl lg:text-7xl font-bold tracking-wider">{{ trans('Be part of the change!') }}</h1>
        <p class="text-xl text-center mt-4 font-normal tracking-wide font-display">
            {{ trans('Choose the project of your interest, donate easy and safe.') }} <br>
            {{ trans('Enjoy the experience of helping, all in one place.') }}
        </p>
        <a class="mt-4 md:mt-12 bg-pink rounded text-white hover:bg-red-600 px-8 py-4 text-2xl focus:outline-none" href="{{ route('teams-page') }}">{{ trans('I want to donate') }}</a>
    </div>

</div>
