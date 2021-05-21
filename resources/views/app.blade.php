<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>

        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('images/icon/apple-touch-icon-57x57.png') }}"></link>
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/icon/apple-touch-icon-114x114.png') }}"></link>
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/icon/apple-touch-icon-72x72.png') }}"></link>
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('images/icon/apple-touch-icon-144x144.png') }}"></link>
        <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('images/icon/apple-touch-icon-120x120.png') }}"></link>
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('images/icon/apple-touch-icon-152x152.png') }}"></link>
        <link rel="icon" type="image/png" href="{{ asset('images/icon/favicon-32x32.png') }}" sizes="32x32"></link>
        <link rel="icon" type="image/png" href="{{ asset('images/icon/favicon-16x16.png') }}" sizes="16x16"></link>
        <meta name="application-name" content="ARSANANDHA.XYZ"/>
        <meta name="msapplication-TileColor" content="#FFA265" />
        <meta name="msapplication-TileImage" content="{{ asset('images/icon/mstile-144x144.png') }}" />
        <meta name="theme-color" content="#FFA265"/>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
