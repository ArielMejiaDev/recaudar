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

        {{--Translates--}}
        <script>
            window.trans = <?php
            // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
            $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());

            $trans = [];
            foreach ($lang_files as $f) {
                $filename = pathinfo($f)['filename'];
                $trans[$filename] = trans($filename);
            }
            echo json_encode($trans);
            ?>;
        </script>
        {{--End Translates--}}
    </head>
    <body>
        @inertia

        @if (app()->isLocal())
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endif

        <!-- Load Facebook SDK for JavaScript -->
        <div id="fb-root"></div>
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    xfbml            : true,
                    version          : 'v9.0'
                });
            };

            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

        <!-- Your Chat Plugin code -->
        <div class="fb-customerchat"
             attribution=setup_tool
             page_id="1634056573515048"
             theme_color="#fe5971"
             logged_in_greeting="Hola, como podemos ayudarte?"
             logged_out_greeting="Hola, como podemos ayudarte?">
        </div>
        <!-- End Load Facebook SDK for JavaScript -->
    </body>
</html>
