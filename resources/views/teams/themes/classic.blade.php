@extends('layout')

@section('content')

{{--Header--}}
@if($team->banner)
    <div class="w-full bg-cover bg-center" style="height: 30vh;background-image: url({{ $team->banner }});">
        <div class="relative container mx-auto h-full">
            <div class="absolute w-full lg:w-auto flex justify-center lg:block right-0 mr-0 bottom-0 -mb-20">
                <img class="h-64 w-64 object-cover border-2 border-gray-300" src="{{ $team->logo }}" alt="{{ $team->name }}">
            </div>
        </div>
    </div>
@else
    <div class="w-full bg-gray-700" style="height: 30vh;">
        <div class="relative container mx-auto h-full">
            <div class="absolute w-full lg:w-auto flex justify-center lg:block right-0 mr-0 bottom-0 -mb-20">
                <img class="h-64 w-64 object-cover border-2 border-gray-300" src="{{ $team->logo }}" alt="{{ $team->name }}">
            </div>
        </div>
    </div>
@endif
{{--End Header--}}

<div x-data="form()" class="container mx-auto mt-24 flex flex-col lg:flex-row p-2">

    <div class="w-full lg:w-3/4 text-left">

        {{--Description--}}
        <div>
            <h1 class="text-3xl font-extrabold leading-10 tracking-tight text-center lg:text-left text-gray-700 sm:text-5xl sm:leading-none lg:text-6xl">
                {{ $team->name }}
            </h1>

            <p class="mt-6 text-gray-700 font-light">{{ $team->description }}</p>

            @empty($team->availablePlans()->first()->banner)
                <p class="mt-6 text-gray-700 font-light">{{ $team->use_of_funds }}</p>
            @endif
        </div>
        {{--End Description--}}

        <!-- Plans -->
        <div class="my-5 pt-3 border-t border-gray-300 flex flex-col lg:flex-row flex-wrap">

            @foreach ($team->availablePlans() as $plan)
                <div class="w-full lg:w-1/3 lg:p-4 flex flex-col justify-between">
                    <h5 @click.prevent="selectPlan({{ $plan }})" class="text-gray-700 text-xl ucfirst hover:underline cursor-pointer">{{ $plan->title }}</h5>
                    @if($plan->banner)
                        <img @click.prevent="selectPlan({{ $plan }})" class="w-full object-cover h-40 mt-1 mb-2 shadow cursor-pointer" src="{{ $plan->banner }}" alt="article image">
                    @endif
                    <p class="text-gray-600 font-light text-sm">{{ $plan->info }}</p>
                    <button @click.prevent="selectPlan({{ $plan }})" class="mt-2 w-40 text-center my-1 text-gray-700 font-semibold py-1 px-2 border border-gray-600 rounded hover:bg-gray-600 hover:text-white cursor-pointer focus:outline-none focus:bg-gray-600 focus:text-white">@lang('Donate') Q {{ $plan->amount_in_local_currency }}</button>
                </div>
            @endforeach

        </div>
        <!-- End Plans -->

        <x-checkout :team="$team" :locale="$locale" />

    </div>

    <aside class="w-full lg:w-1/4">

        <div class="lg:ml-16">

            {{--Social Networks--}}
            <div class="flex justify-end">
                @if ($team->facebook_account)
                    <a target="_blank" href="{{ $team->facebook_account }}">
                        <svg class="h-10 w-10 mx-2" enable-background="new 0 0 1024 1024" height="1024px" id="Layer_1" version="1.1" viewBox="0 0 1024 1024" width="1024px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Background"><path d="M983.766,312.727c-25.785-60.972-62.694-115.728-109.705-162.744   C827.05,102.966,772.299,66.049,711.329,40.257C648.194,13.548,581.14,0.004,512,0c-69.104,0-136.155,13.54-199.289,40.243   c-60.969,25.787-115.721,62.699-162.735,109.71c-47.014,47.011-83.929,101.761-109.72,162.728   C13.548,375.814,0.004,442.865,0,511.97c-0.004,69.109,13.533,136.165,40.234,199.304   c25.785,60.973,62.696,115.728,109.707,162.743c47.011,47.018,101.762,83.935,162.732,109.727   c63.136,26.708,130.19,40.253,199.323,40.257h0.009c69.104,0,136.153-13.54,199.288-40.243   c60.969-25.787,115.72-62.699,162.733-109.709c47.013-47.01,83.929-101.76,109.72-162.728   c26.708-63.134,40.251-130.186,40.255-199.29C1024.004,442.921,1010.467,375.866,983.766,312.727z M512.004,976.328h-0.03   c-124.026-0.007-240.627-48.313-328.323-136.019C95.957,752.604,47.665,635.999,47.672,511.973   c0.015-256.016,208.312-464.3,464.356-464.3c124.026,0.007,240.626,48.312,328.32,136.017   c87.695,87.706,135.986,204.311,135.979,328.337C976.313,768.043,768.018,976.328,512.004,976.328z" fill="#262626"/></g><g id="Facebook"><path d="M672.75,305.64V203.89c-3.736,0-7.473-0.007-11.209,0.001   c-8.996,0.02-17.993-0.022-26.99,0.001c-10.972,0.028-21.942-0.046-32.915,0.001c-9.667,0.042-19.337-0.097-29.003,0.003   c-14.592,0.151-28.443,0.868-42.438,5.375c-13.493,4.346-26.158,11.955-36.948,21.081c-6.248,5.284-12.031,10.943-17.269,17.234   c-2.121,2.613-4.097,5.33-5.942,8.14c-5.538,8.431-9.913,17.704-13.567,27.535c-0.821,2.213-1.628,4.432-2.397,6.662   c-5.634,16.324-5.82,34.143-5.82,51.297c0,2.148,0,4.363,0,6.629c0,33.984,0,79.291,0,79.291h-97v112h93.5h2.5v281h111v-283.5   L659,537.999l13.583-110.125L558.75,427.64v-85c0,0-0.25-36.25,30.5-36.75L672.75,305.64z" fill="#262626" id="Facebook"/></g></svg>
                    </a>
                @endif
                @if($team->twitter_account)
                    <a target="_blank" href="{{ $team->twitter_account }}">
                        <svg class="h-10 w-10 mx-2" enable-background="new 0 0 1024 1024" height="1024px" id="Layer_1" version="1.1" viewBox="0 0 1024 1024" width="1024px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Background"><path d="M983.766,312.727c-25.785-60.972-62.694-115.728-109.705-162.744   C827.05,102.966,772.299,66.049,711.329,40.257C648.194,13.548,581.14,0.004,512,0c-69.104,0-136.155,13.54-199.289,40.243   c-60.969,25.787-115.721,62.699-162.735,109.71c-47.014,47.011-83.929,101.761-109.72,162.728   C13.548,375.814,0.004,442.865,0,511.97c-0.004,69.109,13.533,136.165,40.234,199.304   c25.785,60.973,62.696,115.728,109.707,162.743c47.011,47.018,101.762,83.935,162.732,109.727   c63.136,26.708,130.19,40.253,199.323,40.257h0.009c69.104,0,136.153-13.54,199.288-40.243   c60.969-25.787,115.72-62.699,162.733-109.709c47.013-47.01,83.929-101.76,109.72-162.728   c26.708-63.134,40.251-130.186,40.255-199.29C1024.004,442.921,1010.467,375.866,983.766,312.727z M512.004,976.328h-0.03   c-124.026-0.007-240.627-48.313-328.323-136.019C95.957,752.604,47.665,635.999,47.672,511.973   c0.015-256.016,208.312-464.3,464.356-464.3c124.026,0.007,240.626,48.312,328.32,136.017   c87.695,87.706,135.986,204.311,135.979,328.337C976.313,768.043,768.018,976.328,512.004,976.328z" fill="#262626"/></g><g id="Twitter"><path d="M742.988,348.513c0,0,52.681-44.338,51.012-64.124c0,0-60.785,26.698-74.135,27.89   c0,0-4.227-4.253-11.146-9.845c-2.307-1.864-4.912-3.877-7.762-5.93c-5.277-3.853-10.833-7.164-16.602-9.969   c-2.884-1.402-5.82-2.679-8.797-3.84c-19.379-8.492-40.61-10.572-61.45-8.292c-2.978,0.326-5.946,0.741-8.901,1.238   c-34.565,5.411-64.125,26.388-82.727,54.989c-1.67,2.609-3.218,5.287-4.629,8.033c-2.818,5.492-5.089,11.256-6.686,17.269   c-0.627,2.22-1.313,4.805-1.96,7.565c-0.648,2.76-1.259,5.695-1.736,8.615c-1.907,11.681,0,49.583,0,49.583   s-153.753,4.768-252.442-123.003c0,0-48.628,92.014,35.28,156.376c0,0-17.064,7.628-49.295-11.442c0,0-16.02,70.082,87.912,118.234   H278.39c0,0,17.64,77.711,111.562,84.862c0,0-44.338,59.594-173.063,50.535c0,0,116.14,80.755,265.766,43.276   c2.671-0.67,5.354-1.377,8.047-2.122c23.682-7.305,47.52-15.886,69.171-27.394c1.889-0.979,3.779-1.982,5.671-3.008   c5.677-3.072,11.377-6.343,17.099-9.816c0,0,157.32-85.241,170.191-305.489c0,0,33.063-19.401,54.277-56.587   C807.111,336.118,747.517,349.943,742.988,348.513z" fill="#262626" id="Twitter"/></g></svg>
                    </a>
                @endif
                @if ($team->instagram_account)
                    <a target="_blank" href="{{ $team->instagram_account }}">
                        <svg class="h-10 w-10 mx-2" enable-background="new 0 0 1024 1024" height="1024px" id="Layer_1" version="1.1" viewBox="0 0 1024 1024" width="1024px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Background"><path d="M983.766,312.727c-25.785-60.972-62.694-115.728-109.705-162.744   C827.05,102.966,772.299,66.049,711.329,40.257C648.194,13.548,581.14,0.004,512,0c-69.104,0-136.155,13.54-199.289,40.243   c-60.969,25.787-115.721,62.699-162.735,109.71c-47.014,47.011-83.929,101.761-109.72,162.728   C13.548,375.814,0.004,442.865,0,511.97c-0.004,69.109,13.533,136.165,40.234,199.304   c25.785,60.973,62.696,115.728,109.707,162.743c47.011,47.018,101.762,83.935,162.732,109.727   c63.136,26.708,130.19,40.253,199.323,40.257h0.009c69.104,0,136.153-13.54,199.288-40.243   c60.969-25.787,115.72-62.699,162.733-109.709c47.013-47.01,83.929-101.76,109.72-162.728   c26.708-63.134,40.251-130.186,40.255-199.29C1024.004,442.921,1010.467,375.866,983.766,312.727z M512.004,976.328h-0.03   c-124.026-0.007-240.627-48.313-328.323-136.019C95.957,752.604,47.665,635.999,47.672,511.973   c0.015-256.016,208.312-464.3,464.356-464.3c124.026,0.007,240.626,48.312,328.32,136.017   c87.695,87.706,135.986,204.311,135.979,328.337C976.313,768.043,768.018,976.328,512.004,976.328z" fill="#262626"/></g><g id="Instagram"><circle cx="658.765" cy="364.563" fill="#262626" r="33.136"/><path d="M512,655.912c-79.354,0-143.912-64.56-143.912-143.912c0-79.354,64.559-143.912,143.912-143.912   S655.913,432.647,655.913,512C655.913,591.354,591.354,655.912,512,655.912z M512,413.088c-54.54,0-98.912,44.372-98.912,98.912   S457.46,610.912,512,610.912c54.541,0,98.913-44.372,98.913-98.912S566.541,413.088,512,413.088z" fill="#262626"/><path d="M603.643,800.006H420.358c-103.389,0-187.5-84.112-187.5-187.5V411.495c0-103.388,84.112-187.5,187.5-187.5   h183.283c103.389,0,187.5,84.112,187.5,187.5v201.011C791.143,715.894,707.03,800.006,603.643,800.006z M420.358,268.995   c-78.575,0-142.5,63.925-142.5,142.5v201.011c0,78.575,63.925,142.5,142.5,142.5h183.283c78.575,0,142.5-63.925,142.5-142.5   V411.495c0-78.575-63.925-142.5-142.5-142.5H420.358z" fill="#262626"/></g></svg>
                    </a>
                @endif
            </div>
            {{--End Social Networks--}}

            {{--Impact--}}
            @if ($team->impact)
                <div class="flex flex-col mt-6 pb-6 border-b border-gray-300">
                    <h3 class="text-gray-700 font-semibold text-2xl mb-4">@lang('Impact.')</h3>
                    <p class="text-gray-700 font-light">{{ $team->impact }}</p>
                </div>
            @endif
            {{--End Impact--}}

            {{--Beneficiaries--}}
            <div class="flex flex-col mt-6 pb-6 border-b border-gray-300">
                <h3 class="text-gray-700 font-semibold text-2xl mb-4">@lang('Beneficiaries.')</h3>
                <div class="flex items-center">
                    <div class="text-gray-600">
                        <svg class="w-6 h-6 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
                    </div>
                    <span class="ml-2 text-xl font-extrabold text-gray-600">200</span>
                </div>
            </div>
            {{--End Beneficiaries--}}

            {{--Newsletter--}}
            <div class="flex flex-col mt-6 pb-6 border-b border-gray-300">
                <h3 class="text-gray-700 font-semibold text-2xl mb-4">@lang('Newsletter')</h3>
                <form action="{{ route('add_contact_from_profile_page', $team) }}" method="POST" class="flex items-center">
                    @csrf @method('POST')
                    <label for="email" class="hidden"></label>
                    <input id="email" name="email" type="email" placeholder="@lang('Email')" class="bg-gray-100 border border-gray-300 rounded p-2 text-xs focus:outline-none focus:border-gray-500">
                    <button type="submit" class="ml-2 text-center text-gray-700 text-xs p-2 border border-gray-600 rounded hover:bg-gray-600 hover:text-white cursor-pointer hover:outline-none focus:bg-gray-600 focus:text-white focus:outline-none">@lang('Send')</button>
                </form>
            </div>
            {{--End Newsletter--}}

            {{--Call to Action--}}
            <div class="flex flex-col mt-6 pb-6 border-b border-gray-300">
                <h3 class="text-gray-700 font-semibold text-2xl mb-4">@lang('You want to donate another amount?')</h3>
                <button @click.prevent="selectPlan({{ $variablePlan }})" class="mt-2 text-center my-1 text-gray-700 font-semibold py-1 px-2 border border-gray-600 rounded hover:bg-gray-600 hover:text-white cursor-pointer focus:outline-none focus:bg-gray-600 focus:text-white">@lang('Donate')</button>
            </div>
            {{--End Call to Action--}}

        </div>

    </aside>

</div>

<div class="flex items-end w-full bg-white">
    <footer class="w-full text-gray-700 bg-gray-100 body-font">
        <div class="container flex flex-col flex-wrap py-10 mx-auto md:items-center lg:items-start md:flex-row md:flex-no-wrap">
            <div class="flex-shrink-0 mx-auto text-center md:mx-0 md:text-left {{ $team->facebook_account && $team->twitter_account && $team->instagram_account ? 'md:w-1/3' : 'md:w-1/2' }}">
                <a class="flex items-center justify-center font-medium text-gray-900 title-font md:justify-start">
                    {{ $team->name }}
                </a>
                <p class="mt-2 text-sm text-gray-500">{{ config('app.name') }}</p>
            </div>
            <div class="w-full mt-4 text-center {{ $team->facebook_account && $team->twitter_account && $team->instagram_account ? 'md:w-1/3 md:text-center' : 'md:w-1/2 md:text-right' }}">
                <a href="{{ route('terms-for-users') }}" class="text-gray-500 cursor-pointer hover:text-gray-900 outline-none">@lang('Terms & conditions')</a>
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

@endsection

