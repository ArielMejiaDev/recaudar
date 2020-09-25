@extends('layout')

@section('content')

    <section x-data="{ open: true, submitting: false }" class="text-gray-700 body-font overflow-hidden relative flex flex-col items-center justify-start bg-gray-200 relative">

        @if(Session::has('success'))
            <div x-cloak x-show.transition="open" @click.away="open = false" class="p-4 cursor-pointer rounded-lg bg-pink text-white absolute bottom-0 right-0 m-8 z-10 flex font-semibold font-display">
                <div class="text-white mr-2">
                    <svg class="w-6 h-6 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                </div>
                {{ Session::get('success') }}
                <button @click.prevent="open = false" class="text-white ml-10 focus:outline-none">
                    <svg class="w-6 h-6 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        @endif

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

                    <section class="text-gray-700 body-font relative">

                        <div class="container px-5 py-24 mx-auto">
                            <div class="flex flex-col text-center w-full mb-12">
                                <h1 class="w-full text-center mb-4 text-gray-700 font-semibold uppercase tracking-tight text-2xl lg:text-5xl">{{ __('Contact') }}</h1>
                                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">{{ __('Leave us a message, we will try to reply as soon as possible') }}.</p>
                            </div>
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <form action="{{ route('contact.store') }}" method="POST" class="flex flex-wrap -m-2">
                                    @csrf @method('POST')
                                    <div class="p-2 w-1/2" data-children-count="1">
                                        <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-pink text-base px-4 py-2" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}" type="text">
                                        @error('name')
                                            <p class="text-red-500 font-semibold text-xs my-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="p-2 w-1/2" data-children-count="1">
                                        <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-pink text-base px-4 py-2" placeholder="{{ __('Email') }}" name="email" value="{{ old('email') }}" type="email" >
                                        @error('email')
                                            <p class="text-red-500 font-semibold text-xs my-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="p-2 w-full" data-children-count="1">
                                        <textarea class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none h-48 focus:border-pink text-base px-4 py-2 resize-none block" name="message" placeholder="{{ __('Message') }}">{{ old('message') }}</textarea>
                                        @error('message')
                                            <p class="text-red-500 font-semibold text-xs my-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="p-2 w-full">
                                        <button type="submit" @click="submitting = true" x-bind:disabled="submitting" class="flex mx-auto text-white bg-pink border border-pink py-2 px-8 focus:outline-none focus:shadow-outline focus:border-melon focus:bg-melon hover:border-melon hover:bg-melon rounded text-lg">{{ __('Send') }}</button>
                                    </div>
                                    <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
                                        <p class="leading-normal my-5">Guatemala
                                            <br>{{ __('Guatemala city.') }}
                                        </p>
                                        <span class="inline-flex">
                                            <a target="_blank" href="https://www.facebook.com/Recaudarorg" class="text-gray-500">
                                              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                              </svg>
                                            </a>
                                            <a target="_blank" href="https://twitter.com/Recaudar_" class="ml-4 text-gray-500">
                                              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                              </svg>
                                            </a>
                                            <a target="_blank" href="https://www.instagram.com/recaudarorg/?hl=es-la" class="ml-4 text-gray-500">
                                              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                                              </svg>
                                            </a>
                                          </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>

                </div>

            </section>

        </div>

    </section>

    <x-landing.footer />

@endsection
