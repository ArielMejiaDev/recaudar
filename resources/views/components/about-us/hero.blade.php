<div class="relative flex flex-col items-center justify-center min-h-screen bg-white bg-cover min-w-screen">
    <div class="flex flex-col items-center justify-center mx-auto lg:flex-row lg:max-w-6xl px-0 lg:px-5 xl:p-0">
        <div class="container relative z-20 flex flex-col w-full sm:px-0 md:px-10 lg:px-5 xl:px-0 pb-1 lg:pr-12 mb-16 text-2xl text-gray-700 lg:w-1/2 sm:items-center lg:items-start lg:mb-0">
            <h1 class="relative z-20 text-5xl font-extrabold leading-none text-gray-800 xl:text-6xl sm:text-center lg:text-left mt-4 lg:mt-0">Somos el<br class="md:hidden lg:block"> <span class="text-pink">corazón de la caridad.</span></h1>
            <p class="relative z-20 block mt-6 text-base text-gray-600 xl:text-xl sm:text-center lg:text-left">
                Conectamos organizaciones y donadores de una manera fácil y segura para cambiar el mundo.
            </p>
            <div class="relative flex flex-col sm:flex-row lg:flex-col xl:flex-row mt-4">
                <a href="#quienes-somos" class="flex items-center self-start justify-center px-5 py-3 mt-5 text-base font-medium leading-tight text-white transition duration-150 ease-in-out bg-pink border border-transparent rounded-full shadow hover:bg-melon focus:outline-none focus:border-melon focus:shadow-outline-pink md:py-4 md:text-lg md:px-10">Quienes somos?</a>
                <a @click.prevent="showModal = true" href="#" class="relative flex items-center self-start justify-center py-3 pl-10 pr-5 mt-5 sm:ml-5 md:ml-0 xl:ml-5 text-base font-medium leading-tight text-pink transition duration-150 ease-in-out bg-gray-100 border-transparent rounded-full shadow-sm md:pl-16 md:pr-10 hover:text-melon focus:outline-none md:py-4 md:text-lg xl:text-xl">
                    <svg class="absolute left-0 w-6 h-6 ml-3 md:w-10 md:h-10" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                    <span class="text-pink">Mas de nosotros</span>
                </a>
            </div>
        </div>
        <div class="relative w-full px-5 rounded-lg cursor-pointer md:w-2/3 lg:w-1/2 group xl:px-0">
            <div class="absolute top-0 left-0 w-11/12 -mt-20 opacity-50">
                <svg class="w-full h-full ml-4 text-purple-100" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="M45,-78C58.3,-70.3,69,-58.2,75.2,-44.4C81.3,-30.7,82.9,-15.3,83.5,0.4C84.2,16,83.8,32.1,76.5,43.9C69.2,55.7,55.1,63.3,41.2,69.4C27.3,75.4,13.6,80,-0.7,81.2C-15.1,82.5,-30.1,80.3,-41.2,72.6C-52.2,64.9,-59.2,51.6,-67.1,38.5C-75.1,25.5,-83.9,12.8,-83.8,0C-83.8,-12.7,-74.9,-25.4,-65.8,-36.4C-56.7,-47.4,-47.4,-56.7,-36.4,-65.7C-25.4,-74.7,-12.7,-83.5,1.6,-86.2C15.9,-89,31.8,-85.7,45,-78Z" transform="translate(100 100)" />
                </svg>
            </div>
            <div class="relative overflow-hidden rounded-md shadow-2xl cursor-pointer group">
                <div @click.prevent="showModal = true" class="absolute flex items-center justify-center w-full h-full">
                    <span class="flex items-center justify-center w-20 h-20 bg-pink rounded-full shadow-2xl">
                        <svg class="w-auto h-8 ml-1 text-white fill-current" viewBox="0 0 52 66" xmlns="http://www.w3.org/2000/svg"><path d="M50 30.7L4.1.6C2.6-.4.8.9.8 2.9v60.3c0 2 1.8 3.3 3.3 2.3L50 35.3c1.5-1 1.5-3.6 0-4.6z" fill-rule="nonzero"/></svg>
                    </span>
                </div>
                <img src="https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1650&q=80" class="z-10 object-cover w-full h-full">
            </div>
        </div>
    </div>
</div>
