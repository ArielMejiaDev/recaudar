@isset($team)

    <div class="h-auto lg:h-screen bg-gray-200 relative overflow-hidden flex items-center py-10 lg:py-0 font-body">

        <svg
            class="fill-current text-gray-300 absolute z-0" width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg"
            style="top: -250px; right: -320px"
        >
            <g transform="translate(300,300)">
                <path d="M119.8,-100.7C153.6,-53.2,178.2,-3.4,167.3,35.8C156.5,75,110.1,103.7,54.8,140.8C-0.6,177.8,-64.9,223.1,-121.6,211.6C-178.2,200,-227,131.5,-233.1,64.7C-239.2,-2.1,-202.5,-67.1,-156.5,-117.5C-110.5,-167.8,-55.2,-203.4,-6.1,-198.5C43,-193.6,86,-148.3,119.8,-100.7Z"  />
            </g>
        </svg>

        <svg
            class="fill-current text-gray-300 absolute z-0" width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg"
            style="bottom: -300px; left: -25px">
            <g transform="translate(300,300)">
                <path d="M163.5,-130.7C193.1,-93.3,185.3,-26.4,173,44.3C160.7,115,143.9,189.5,105.6,200.8C67.4,212,7.7,160.1,-57.7,126.2C-123.1,92.3,-194.1,76.4,-217.9,32.5C-241.7,-11.4,-218.2,-83.3,-174,-124.1C-129.8,-164.8,-64.9,-174.4,1,-175.2C67,-176.1,134,-168.2,163.5,-130.7Z" />
            </g>
        </svg>

        <div class="container mx-auto h-full flex flex-col lg:items-center lg:justify-between lg:flex-row z-10 lg:px-10 lg:py-24">

            <div class="w-full lg:w-4/12 ">

                <div class="flex flex-col items-center text-center md:text-left">

                    <p class="text-blue-900 text-xl sm:text-3xl font-bold tracking-wide">
                        Dona con 3 simples pasos en menos de 5 minutos
                        a organizaciones sin fines de lucro que ayudan a Guatemala a ser un mejor país.
                    </p>

                </div>

            </div>

            <div class="w-full lg:w-7/12">

                <a href="#" class="rounded-lg shadow-2xl overflow-hidden block m-2 md:mt-20 md:mx-20">
                    <img class="w-full h-64 object-cover lg:h-full" src="{{ $team->banner }}" alt="Foundation image">
                </a>

                <div class="flex justify-center">
                    <a href="#" class="mt-4 md:mt-12 bg-pink rounded text-white hover:bg-red-600 px-8 py-4 text-2xl focus:outline-none">Ver Fundación</a>
                </div>

            </div>

        </div>

    </div>
@endisset
