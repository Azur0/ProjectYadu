<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Yadu') }}</title>
        <link rel="icon" type="image/png" href="/images/favicon.png" />

        <script src="{{ asset('js/app.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('css/filterCSS.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <script src="{{ asset('js/app.js') }}"></script>     
    </head>
    <body>
        <div id="main">
            <div id="header">
                @include('layouts.nav')
            </div>

            <!-- Optional -->
            @yield('banner')

			@yield('content')

            <div id="footer">
                @include('layouts.footer')
            </div>
        </div>
    </body>
</html>