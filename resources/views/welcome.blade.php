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

</div>

@endsection
