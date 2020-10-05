@extends('layout')

@section('content')

    <x-navbar-pink />

    <section x-data="{ open: true, submitting: false }" class="text-gray-700 body-font overflow-hidden relative flex flex-col items-center justify-start bg-gray-200 relative">

        @if(Session::has('success'))
            <div x-cloak x-show.transition="open" @click.away="open = false" class="p-4 cursor-pointer rounded-lg bg-pink text-white fixed bottom-0 right-0 m-8 z-10 flex font-semibold font-display">
                <div class="text-white mr-2">
                    <svg class="w-6 h-6 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                </div>
                {{ Session::get('success') }}
                <button @click.prevent="open = false" class="text-white ml-10 focus:outline-none">
                    <svg class="w-6 h-6 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        @endif

        <x-blobs />

        <div class="container mx-auto p-0 md:p-4 relative z-10">

            <section class="text-gray-700 body-font lg:mt-10">

                <div class="container px-2 py-2 mx-auto">

                    <section class="text-gray-700 body-font relative">

                        <div class="container px-5 pb-24 mt-4 mx-auto">
                            <div class="flex flex-col text-center w-full mb-6 md:mb-12">
                                <h1 class="w-full text-center mb-4 text-gray-700 font-semibold uppercase tracking-tight text-2xl lg:text-5xl">{{ __('Contact') }}</h1>
                                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">{{ __('Leave us a message, we will try to reply as soon as possible.') }}</p>
                            </div>
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <form @submit="submitting = true" action="{{ route('contact.store') }}" method="POST" class="flex flex-wrap -m-2">
                                    @csrf @method('POST')
                                    <div class="flex flex-col md:flex-row w-full">
                                        <div class="p-2 w-full md:w-1/2" data-children-count="1">
                                            <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-pink text-base px-4 py-2" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}" type="text">
                                            @error('name')
                                            <p class="text-red-500 font-semibold text-xs my-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="p-2 w-full md:w-1/2" data-children-count="1">
                                            <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-pink text-base px-4 py-2" placeholder="{{ __('Email') }}" name="email" value="{{ old('email') }}" type="email" >
                                            @error('email')
                                            <p class="text-red-500 font-semibold text-xs my-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="p-2 w-full" data-children-count="1">
                                        <textarea class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none h-48 focus:border-pink text-base px-4 py-2 resize-none block" name="message" placeholder="{{ __('Message') }}">{{ old('message', '') }}</textarea>
                                        @error('message')
                                            <p class="text-red-500 font-semibold text-xs my-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="p-2 w-full">
                                        <button x-bind:disabled="submitting" type="submit" class="w-full text-center flex justify-center mx-auto text-white bg-pink border border-pink py-2 px-8 focus:outline-none focus:shadow-outline focus:border-melon focus:bg-melon hover:border-melon hover:bg-melon rounded text-lg" x-text="submitting ? '{{ trans('Sending') }}...' : '{{ trans('Send') }}'"></button>
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

    <x-footer />

@endsection
