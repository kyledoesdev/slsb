<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'spacelampsix') }}</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <script src="https://kit.fontawesome.com/07b7751319.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body style="background-color:#424549">
        <div id="app">
            @include('layouts.includes.nav')
            <main class="py-4">
                @include('includes.messages')
                @yield('content')
                @yield('styles')
                @yield('scripts')
            </main>
        </div>
        @include('layouts.includes.globals')
    </body>
</html>
