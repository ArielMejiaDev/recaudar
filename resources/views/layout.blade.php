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

    <!-- Pixel Code for https://app.heyflow.co/ -->
{{--    <script async src="https://app.heyflow.co/pixel/GDqj84ofOlDbfPj3"></script>--}}

<!-- Smartlock -->
{{--    <script type='text/javascript'>--}}
{{--        window.smartlook||(function(d) {--}}
{{--            var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];--}}
{{--            var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';--}}
{{--            c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);--}}
{{--        })(document);--}}
{{--        smartlook('init', 'bfc6432b77e4654dba2229a55021edf3e6f9ed90');--}}
{{--    </script>--}}

<!-- Global site tag (gtag.js) - Google Analytics -->
{{--    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-172133505-1"></script>--}}
{{--    <script>--}}
{{--        window.dataLayer = window.dataLayer || [];--}}
{{--        function gtag(){dataLayer.push(arguments);}--}}
{{--        gtag('js', new Date());--}}
{{--        gtag('config', 'UA-172133505-1');--}}
{{--    </script>--}}

<!-- Hotjar Tracking Code for www.recaudar.com -->
    {{--    <script>--}}
    {{--        (function(h,o,t,j,a,r){--}}
    {{--            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};--}}
    {{--            h._hjSettings={hjid:1477096,hjsv:6};--}}
    {{--            a=o.getElementsByTagName('head')[0];--}}
    {{--            r=o.createElement('script');r.async=1;--}}
    {{--            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;--}}
    {{--            a.appendChild(r);--}}
    {{--        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');--}}
    {{--    </script>--}}

</head>
<body>
    <div id="app">
        @yield('content')
    </div>
    @stack('scripts')
</body>
</html>
