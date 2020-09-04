<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/svg+xml" href="/favicon.svg">

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
    </body>
</html>
