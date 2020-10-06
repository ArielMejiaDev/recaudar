@extends('layout')

@section('content')

<div id="app">

    <x-landing.hero />

    <x-landing.steps :team="$team" />

    <x-landing.step-one :teams="$teams" />

    <x-landing.step-two />

    <x-landing.step-three />

    <x-landing.call-to-action />

    <x-landing.foundations-info />

    <x-landing.faqs />

    <x-landing.second-call-to-action/>

    <x-footer />

    <div x-data="{ open: true }">
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
    </div>

</div>

@endsection
