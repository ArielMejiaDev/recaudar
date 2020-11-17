@extends('layout')

@section('content')

    <style>
        /* small css for the mobile nav close */
        #nav-mobile-btn.close span:first-child{
            transform: rotate(45deg);
            top: 4px;
            position: relative;
            background:#a0aec0;
        }
        #nav-mobile-btn.close span:nth-child(2){
            transform: rotate(-45deg);
            margin-top: 0px;
            background:#a0aec0;
        }
    </style>

<div x-data="form()">
    <!-- Navbar -->
    <div class="relative z-20 w-full h-24 px-8 pt-2 bg-white">

        <div class="container flex items-center justify-between h-full max-w-6xl mx-auto">
            {{--Navbar Logo--}}
            <a href="#_" class="relative flex items-center inline-block h-5 h-full font-black">
                @if($team->logo)
                    <img class="w-auto h-8 mt-1" src="{{ $team->logo }}" alt="{{ $team->name }} logo">
                @endif
                <span class="ml-3 hidden lg:block lg:text-xl md:text-xl font-black text-gray-800">{{ $team->name }}</span>
            </a>
            {{--End Navbar Logo--}}

            {{--Desktop Navbar--}}
            <div id="nav" class="absolute z-10 top-0 left-0 hidden block w-full mt-20 border-b border-gray-200 sm:border-none sm:px-5 sm:block sm:relative sm:mt-0 sm:px-0 sm:w-auto">
                <nav class="flex flex-col items-center py-3 bg-white border border-gray-100 sm:flex-row sm:bg-transparent sm:border-none sm:py-0">
                    <a href="#_" class="relative px-1 mb-1 mb-5 mr-0 text-base font-bold sm:mb-0 sm:mr-4 lg:mr-8">@lang('Home')<span class="absolute bottom-0 left-0 w-full h-1 -mb-2 bg-pink-300 rounded-full"></span></a>
                    <a href="#newsletter" class="px-1 mb-1 mb-5 mr-0 text-base font-bold sm:mb-0 sm:mr-4 lg:mr-8">Newsletter</a>
                    <a href="#donar" class="relative mb-5 sm:mb-0">
                        <span class="absolute top-0 left-0 w-full h-full mt-1 ml-1 bg-gray-800 rounded"></span>
                        <span class="relative inline-block w-full h-full px-3 py-1 text-base text-gray-800 font-bold transition duration-100 bg-white border-2 border-gray-800 rounded fold-bold hover:bg-pink-500 hover:text-gray-900 uppercase">@lang('Donate')</span>
                    </a>
                </nav>
            </div>
            {{--End Desktop Navbar--}}

            {{--Mobile Navbar--}}
            <div id="nav-mobile-btn" class="absolute top-0 right-0 z-50 block w-6 mt-8 mr-10 cursor-pointer select-none sm:hidden sm:mt-10">
                <span class="block w-full h-1 mt-2 duration-200 transform bg-gray-800 rounded-full sm:mt-1"></span>
                <span class="block w-full h-1 mt-1 duration-200 transform bg-gray-800 rounded-full"></span>
            </div>
            {{--End Mobile Navbar--}}
        </div>
    </div>
    <!-- End Navbar -->

    @php
        $organization = new \App\Services\CustomerNameResolverService($team->name);
    @endphp

    <!-- Hero -->
    <div class="relative flex flex-col items-center justify-center md:min-h-screen bg-white bg-cover min-w-screen z-0">
        <div class="flex flex-col items-center justify-center lg:p-10 mx-auto lg:flex-row lg:max-w-6xl lg:p-0">
            <div class="container relative z-20 flex flex-col w-full pb-1 lg:pr-12 mb-16 text-2xl text-gray-700 lg:w-1/2 sm:px-0 lg:px-10 sm:items-center lg:items-start lg:mb-0">
                <h1 class="relative z-20 text-3xl md:text-5xl font-extrabold leading-none text-pink-500 xl:text-6xl text-center lg:text-left">
                    {{ $organization->firstname() }}
                    <br class="md:hidden lg:block">
                    <span class="text-gray-800">{{ $organization->lastname() }}</span>
                </h1>
                <p class="relative z-20 block mt-6 text-sm lg:text-base text-gray-500 sm:text-center lg:text-left">
                    {{ $team->description }}
                </p>
                <div class="relative flex mt-4">
                    <a href="#donar" class="flex items-center self-start justify-center px-5 py-3 mt-5 text-base font-medium leading-tight text-white transition duration-150 ease-in-out bg-pink-500 border border-transparent rounded-full shadow hover:bg-pink-600 focus:outline-none focus:border-pink-600 focus:shadow-outline-pink md:py-4 md:text-lg xl:text-xl md:px-10">@lang('Donate')</a>
                </div>
            </div>
            <div class="relative w-full md:px-5 rounded-lg cursor-pointer md:w-2/3 lg:w-1/2 group xl:px-0">
                <div class="relative overflow-hidden rounded-md shadow-2xl cursor-pointer group mx-4 md:mx-0">
                    <img src="{{ $team->banner }}" class="z-10 object-cover w-full h-full">
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero -->

    <!-- Plan -->
    <div id="donar" class="w-full min-h-screen bg-gray-200">

        <div class="container mx-auto">
            <div class="w-full lg:w-1/2 mx-auto my-12">
                <h1 class="text-center text-gray-800 font-extrabold text-3xl md:text-5xl tracking-tight">
                    <span class="text-pink-500">@lang('You can help')</span> @lang('in many ways').
                </h1>
            </div>

            <div class="flex flex-wrap">

                {{--Plans--}}
                @foreach ($team->availablePlans() as $plan)

                <div class="w-full lg:w-1/2 pb-6 md:p-4">
                    <div class="flex flex-col sm:flex-row mx-auto max-w-full h-auto sm:h-64 hover:shadow-xl">
                        @if ($plan->banner)
                            <img @click.prevent="selectPlan({{ $plan }})" class="shadow h-full w-full sm:w-2/4 object-cover rounded-lg rounded-b-none sm:rounded-l-lg sm:rounded-r-none pb-5/6" src="{{ $plan->banner }}" alt="banner">
                        @endif
                        <div class="w-full {{ $plan->banner ? 'sm:w-2/4' : null }} shadow px-4 py-4 bg-white rounded-lg rounded-t-none sm:rounded-l-none sm:rounded-r-lg  flex flex-col justify-center">
                            <div class="flex items-center">
                                <h2 @click.prevent="selectPlan({{ $plan }})" class="text-gray-800 font-semibold mr-auto text-base tracking-tight">{{ $plan->title }}</h2>
                            </div>
                            <p class="text-sm text-gray-700 mt-4">{{ $plan->info }}</p>
                            <div class="flex items-center justify-end mt-4">
                                <button @click.prevent="selectPlan({{ $plan }})" class="bg-pink-100 text-pink-500 border border-pink-100 hover:border-pink-500 focus:border-pink-500 px-2 py-2 rounded-md focus:outline-none">@lang('Donate') Q @money($plan->amount_in_local_currency)</button>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
                {{--End Plans--}}

            </div>
        </div>

    </div>
    <!-- End Plan -->

    <x-checkout :team="$team" :locale="$locale" />

    <!-- Call to action -->
    <div id="call-to-action" class="flex items-center justify-center py-20 min-w-screen bg-gray-300">
        <div class="container mx-auto">
            <div class="relative flex flex-col items-center w-full max-w-6xl px-4 py-8 mx-auto text-center rounded-lg shadow-2xl lg:text-left lg:block bg-gradient-to-br from-purple-600 via-indigo-500 to-teal-400 sm:px-6 md:pb-0 md:pt-12 lg:px-12 lg:py-12">
                <h2
                    class="my-4 text-3xl font-extrabold tracking-tight text-white sm:text-4xl md:text-5xl lg:my-0 xl:text-4xl sm:leading-tight">
                    @lang('You want to donate') <span class="block text-indigo-200 xl:inline">@lang('a different amount?')</span>
                </h2>
                <p class="mt-1 mb-10 text-sm font-medium text-indigo-200 uppercase xl:text-base xl:tracking-wider lg:mb-0">
                    @lang('You can donate any amount you want.')
                </p>
                <div class="flex mb-8 lg:mt-6 lg:mb-0">
                    <div class="inline-flex">
                        <button @click.prevent="selectPlan({{ $variablePlan }})" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-indigo-700 transition duration-150 ease-in-out bg-indigo-100 border border-transparent rounded-md hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:shadow-outline focus:border-indigo-300">
                            @lang('Donate')
                        </button>
                    </div>
                </div>
                <div class="bottom-0 right-0 mb-0 lg:mr-3 lg:absolute lg:m-10 text-white">
                    <img src="https://icongr.am/clarity/heart.svg?size=128&color=ffffff" class="max-w-xs mb-4 opacity-75 md:max-w-2xl lg:max-w-lg xl:mb-0 xl:max-w-md">
                </div>
            </div>
        </div>
    </div>
    <!-- End Call to action -->


    <!-- Newsletter Form -->
    <section id="newsletter" class="relative bg-white bg-gray-200 min-w-screen py-20 animation-fade animation-delay flex items-center">
        <div class="container mx-auto">
            <div class="h-full max-w-6xl mx-auto overflow-hidden rounded-lg shadow">
                <div class="h-full sm:flex">
                    <aside class="w-full p-10 rounded-none sm:rounded md:w-1/3 bg-gray-100">
                        <h2 class="text-2xl font-extrabold leading-8 tracking-tight text-gray-900 sm:text-2xl sm:leading-9">Newsletter</h2>
                        <p class="mt-2 mb-5 text-sm text-gray-600">@lang('You can find in social media below or leave your email to get lastest news from us.')</p>
                        @if($team->facebook_account || $team->instagram_account || $team->twitter_account)
                            <div class="flex items-start py-3 pb-5">
                                <div class="flex-grow">
                                    <div class="mb-2 text-base font-medium">@lang('Social')</div>
                                    <div class="flex text-white text-md sm:text-gray-500">
                                        @if ($team->facebook_account)
                                            <a target="_blank" href="{{ $team->facebook_account }}" class="text-gray-400 hover:text-gray-500">
                                                <span class="sr-only">Facebook</span>
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        @endif
                                        @if($team->instagram_account)
                                            <a target="_blank" href="{{ $team->instagram_account }}" class="ml-3 text-gray-400 hover:text-gray-500">
                                                <span class="sr-only">Instagram</span>
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        @endif
                                        @if($team->twitter_account)
                                            <a target="_blank" href="{{ $team->twitter_account }}" class="ml-3 text-gray-400 hover:text-gray-500">
                                                <span class="sr-only">Twitter</span>
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </aside>
                    <div class="flex items-center justify-center w-full p-10 bg-white md:w-2/3">
                        <form method="POST" action="{{ route('add_contact_from_profile_page', $team) }}" class="w-full">
                            @csrf
                            <div class="pb-3">
                                <input class="w-full px-5 py-3 border border-gray-400 rounded-lg outline-none focus:shadow-outline" type="text" placeholder="@lang('Email')" name="email" />
                                @error('email')
                                    <span class="text-xs text-red-500 font-semibold my-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="pt-3">
                                <button type="submit" class="flex justify-center px-6 py-3 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 hover:text-white focus:outline-none focus:shadow-outline focus:border-indigo-300 w-full" type="submit">
                                    <svg class="self-center h-4 fill-current" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve" class="brz-icon-svg brz-css-mexoi brz-css-rstqv" data-type="glyph" data-name="email-83">
                                    <g fill="currentColor">
                                        <path data-color="color-2" fill="currentColor" d="M23,2H1C0.4,2,0,2.4,0,3v3c0,0.4,0.2,0.7,0.5,0.9l11,6C11.7,13,11.8,13,12,13s0.3,0,0.5-0.1 l11-6C23.8,6.7,24,6.4,24,6V3C24,2.4,23.6,2,23,2z"></path>
                                        <path fill="currentColor" d="M13.4,14.6C13,14.9,12.5,15,12,15s-1-0.1-1.4-0.4L0,8.9V21c0,0.6,0.4,1,1,1h22c0.6,0,1-0.4,1-1V8.9 L13.4,14.6z"></path>
                                    </g>
                                </svg>
                                    <span class="ml-3 text-base font-medium">@lang('Add to newsletter')</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Newsletter Form -->

    <!-- Footer -->
    <div class="flex items-end w-full bg-white">
        <footer class="w-full text-gray-700 bg-gray-100 body-font">
            <div class="container flex flex-col flex-wrap py-10 mx-auto md:items-center lg:items-start md:flex-row md:flex-no-wrap">
                <div class="flex-shrink-0 mx-auto text-center md:mx-0 md:text-left {{ $team->facebook_account && $team->twitter_account && $team->instagram_account ? 'md:w-1/3' : 'md:w-1/2' }}">
                    <span class="flex items-center justify-center font-medium text-gray-900 title-font md:justify-start">
                        {{ $team->name }}
                    </span>
                    <a href="{{ config('app.url') }}" class="block mt-2 text-sm text-gray-500">{{ config('app.name') }}</a>
                </div>
                <div class="w-full mt-4 text-center {{ $team->facebook_account && $team->twitter_account && $team->instagram_account ? 'md:w-1/3 md:text-center' : 'md:w-1/2 md:text-right' }}">
                    <a target="_blank" href="{{ route('terms-for-users') }}" class="text-gray-500 cursor-pointer hover:text-gray-900">@lang('Terms & conditions')</a>
                </div>
                @if ($team->facebook_account && $team->twitter_account && $team->instagram_account)
                    <div class="flex text-center md:ml-auto lg:-mb-10 md:mt-0">
                        <div class="w-full px-4 md:w-1/3 lg:text-right">
                            <div class="mt-4">
                        <span class="inline-flex justify-center mt-2 sm:ml-auto sm:mt-0 sm:justify-start">
                            @if($team->facebook_account)
                                <a target="_blank" href="{{ $team->facebook_account }}" class="text-gray-500 cursor-pointer hover:text-gray-700">
                                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                    </svg>
                                </a>
                            @endif
                            @if ($team->twitter_account)
                                <a target="_blank" href="{{ $team->twitter_account }}" class="ml-3 text-gray-500 cursor-pointer hover:text-gray-700">
                                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         class="w-5 h-5" viewBox="0 0 24 24">
                                        <path
                                            d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                                        </path>
                                    </svg>
                                </a>
                            @endif
                            @if ($team->instagram_account)
                                <a target="_blank" href="{{ $team->instagram_account }}" class="ml-3 text-gray-500 cursor-pointer hover:text-gray-700">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                         stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                                    </svg>
                                </a>
                            @endif
                        </span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </footer>
    </div>
    <!-- End Footer -->
</div>

    <!-- a little JS for the mobile nav button -->
    <script>
        if( document.getElementById('nav-mobile-btn') ){
            document.getElementById('nav-mobile-btn').addEventListener('click', function(){
                if( this.classList.contains('close') ){
                    document.getElementById('nav').classList.add('hidden');
                    this.classList.remove('close');
                } else {
                    document.getElementById('nav').classList.remove('hidden');
                    this.classList.add('close');
                }
            });
        }
    </script>

@endsection
