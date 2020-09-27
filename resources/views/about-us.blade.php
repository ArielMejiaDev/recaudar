@extends('layout')

@section('content')

    <div x-data="{showModal: false}">

        <div x-show="showModal" x-cloak @click="showModal = !showModal" class="bg-gray-900 bg-opacity-50 absolute inset-0 z-40 flex items-center justify-center">
            <div x-show.transition="showModal" class="bg-white rounded-lg shadow text-gray-800 w-full mx-4 lg:w-3/4 overflow-hidden">
                <iframe class="w-full h-56 lg:h-128" src="https://www.youtube.com/embed/jkx1m1UjT4I" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>

        <x-landing.navbar-green />

        <div class="relative bg-white overflow-hidden mt-20">

            <div class="max-w-screen-xl mx-auto">
                <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                    <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <polygon points="50,0 100,0 50,100 0,100" />
                    </svg>

                    <div class="relative pt-6 px-4 sm:px-6 lg:px-8"></div>

                    <main class="mt-10 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                        <div class="sm:text-center lg:text-left">
                            <h2 class="font-display text-4xl tracking-tight leading-10 font-extrabold text-gray-900 sm:text-5xl sm:leading-none md:text-6xl mb-16">
                                Somos el
                                <br class="xl:hidden" />
                                <span class="text-pink">corazón de la caridad</span>
                            </h2>
                            <p class="text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0 mb-16">
                                Conectamos organizaciones y
                                donadores de una manera fácil y segura para cambiar el mundo.
                            </p>

                            <button @click="showModal = ! showModal" class="w-full lg:w-auto flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-pink bg-red-200 hover:text-red-100 hover:bg-pink focus:outline-none focus:shadow-outline-none focus:border-red-300 transition duration-150 ease-in-out md:py-4 md:text-lg md:px-10">
                                Mas de nosotros
                                <span class="fill-current">
                                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6 ml-1"><path data-v-efdb9988="" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                </span>
                            </button>

                        </div>
                    </main>
                </div>
            </div>
            <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" alt="" />
            </div>
        </div>

        <div class="bg-gray-100">
            <div class="max-w-screen-xl mx-auto">
                <div class="flex items-center justify-center p-4 md:py-40">
                    <div class="w-full md:w-8/12 text-gray-900">
                        <h3 class="font-body font-semibold text-xl tracking-wider">Quienes somos ?</h3>
                        <p class="mt-8 font-display text-gray-700">
                            Recaudar.com es una empresa con enfoque social con la que gente puede donar a una basta red
                            de organizaciones sin fines de lucro, haciendo el proceso simple, transparente y seguro.
                            Nuestro trabajo es hacerles la vida más fácil a las organizaciones sin fines de lucro.
                            Buscamos ser un catalizador de cambio, haciendo el proceso de donación lo más accesible
                            posible, para que todos ganemos.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="max-w-screen-xl mx-auto">
                <div class="flex items-center justify-center p-4 md:py-40">
                    <div class="w-full md:w-8/12 text-gray-900">
                        <h3 class="font-body font-semibold text-xl tracking-wider">Nuestra plataforma se basa en 3 pilares importantes.</h3>
                        <ul class="mt-8 font-display">

                            <li>Accesibilidad:</li>

                            <li class="list-disc ml-4 my-4">
                                Dar y recibir donaciones en menos de
                                5 minutos desde cualquier parte del mundo.
                            </li>

                            <li>Seguridad:</li>

                            <li class="list-disc ml-4 my-4">
                                Garantizamos transacciones seguras y confiables,
                                verificando legalmente a todos los involucrados en las transacciones.
                            </li>

                            <li>Transparencia</li>

                            <li class="list-disc ml-4 my-4">
                                Para todos los procesos entre donantes y organizaciones.
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <x-landing.footer/>

    </div>

@endsection
