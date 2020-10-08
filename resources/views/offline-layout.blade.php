<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>{{ config('app.name', 'Recaudar') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <!-- PWA Manifest -->
    @laravelPWA

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />

</head>
<body>

    @yield('content')

</body>
</html>
