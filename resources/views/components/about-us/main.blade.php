<div id="quienes-somos" class="lg:px-8 mx-auto flex flex-col-reverse lg:flex-row items-center mt-6 lg:mt-0 lg:min-h-screen min-w-screen bg-gray-200">
    <div class="w-full md:w-2/3 p-5 lg:p-10 lg:w-1/2">
        <div class="flex flex-col overflow-hidden shadow-2xl rounded-lg">
            <div class="h-8 bg-gray-900 text-white flex items-center">
                <div class="w-3 h-3 rounded-full ml-3 bg-red-400"></div>
                <div class="w-3 h-3 rounded-full ml-2 bg-yellow-400"></div>
                <div class="w-3 h-3 rounded-full ml-2 bg-green-400"></div>
            </div>
            <img src="{{ asset('images/about-us/app_screenshot.png')  }}" class="w-full h-full object-cover">
        </div>
    </div>
    <div class="relative w-full md:w-2/3 lg:w-1/2 h-full p-5 lg:pl-12">
        <p class="text-sm uppercase font-bold text-melon tracking-wide">Recaudar</p>
        <h2 class="text-4xl font-bold text-gray-900 mt-5 leading-tight">
            Quienes somos
        </h2>
        <p class="text-gray-600 text-base mt-3">
            Somos una empresa social que permite a las organizaciones sin fines de lucro generar ingresos recurrentes y
            hacer más eficientes sus procesos a través de una plataforma digital.
            En Recaudar.com cualquier persona puede hacer donaciones con tarjeta de crédito o débito, desde cualquier parte del mundo,
            a la iniciativa que más le apasione ayudar.
        </p>
        <a href="#pilares" class="underline font-medium flex items-center inline-block text-primary hover:text-darkprimary mt-8">
            <span>Nuestra plataforma se basa en 3 pilares importantes.</span>
            <svg class="w-4 h-4  ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
        </a>
    </div>
</div>
