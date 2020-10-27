<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <title>{{ config('app.name', 'Recaudar') }}</title>
        <link rel="icon" type="image/svg+xml" href="/favicon.svg">

        <!-- PWA Manifest -->
        @laravelPWA

        <!-- Recaptcha -->
        <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
        <script src="https://unpkg.com/vue-recaptcha@latest/dist/vue-recaptcha.min.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,400,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />

        <!-- Javascript -->
        <script src="{{ mix('/js/app.js') }}" defer></script>
        @routes
    </head>
    <body>
        @inertia

        @if (app()->isLocal())
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endif

        <!-- Helpdesk Support Beacon -->
        <script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});
        </script><script type="text/javascript">window.Beacon('init', '68860fd7-b38d-418b-aab8-f3edc954bd2f')</script>
        <!-- End Helpdesk Support Beacon -->
    </body>
</html>
