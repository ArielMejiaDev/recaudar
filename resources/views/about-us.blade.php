@extends('layout')

@section('content')

    <div x-data="{showModal: false}">

        <x-about-us.video-modal />

        <x-navbar-pink />

        <x-about-us.hero />

        <x-about-us.main />

        <x-about-us.features />

        <x-footer/>

    </div>

@endsection
