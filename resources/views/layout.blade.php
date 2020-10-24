<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Recaudar.com') }}</title>

    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <!-- SEO -->
    {!! SEO::generate() !!}
    <!-- Styles -->
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.min.js" defer></script>

    @stack('headerScripts')

    @if (config('app.env') === 'production')
        <!-- Pixel Code for https://app.heyflow.co/ -->
        <script async src="https://app.heyflow.co/pixel/GDqj84ofOlDbfPj3"></script>

        <!-- Smartlock -->
        <script type='text/javascript'>
            window.smartlook||(function(d) {
                var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
                var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
                c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
            })(document);
            smartlook('init', 'bfc6432b77e4654dba2229a55021edf3e6f9ed90');
        </script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-172133505-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-172133505-1');
        </script>

        <!-- Hotjar Tracking Code for www.recaudar.com -->
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:1477096,hjsv:6};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>
    @endif

</head>
<body>
    <div id="app">
        @yield('content')
    </div>
    @stack('scripts')

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
        @error('error')
            <div x-cloak x-show.transition="open" @click.away="open = false" class="p-4 cursor-pointer rounded-lg bg-red-500 text-white fixed bottom-0 right-0 m-8 z-10 flex font-semibold font-display">
                <div class="text-white mr-2">
                    <svg class="w-6 h-6 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                </div>
                {{$message }}
                <button @click.prevent="open = false" class="text-white ml-10 focus:outline-none">
                    <svg class="w-6 h-6 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        @enderror
    </div>

</body>
</html>
