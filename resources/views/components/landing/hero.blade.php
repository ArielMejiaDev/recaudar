
<div class="h-screen relative md:flex md:flex-col font-body"
     style="background: url({{ asset('images/landing/hero/bg.jpeg') }});background-position: center; background-repeat: no-repeat;background-size: cover">

    <x-landing.navbar />

    <!-- overlay -->
    <div class="absolute inset-0 bg-black opacity-50 z-0"></div>

    <div class="relative z-10 w-full h-full flex flex-col items-center justify-center text-white px-3 container mx-auto">
        <h1 class="text-center text-4xl lg:text-7xl font-bold tracking-wider">¡Sé parte del cambio!</h1>
        <p class="text-xl text-center mt-4 font-normal tracking-wide font-display">
            Escoge el proyecto de tu interés, dona fácil y seguro. <br>
            Disfruta la experiencia de ayudar, todo en un solo lugar.
        </p>
        <a class="mt-4 md:mt-12 bg-pink rounded text-white hover:bg-red-600 px-8 py-4 text-2xl focus:outline-none" href="{{ route('teams-page') }}">Quiero donar</a>
    </div>

</div>
