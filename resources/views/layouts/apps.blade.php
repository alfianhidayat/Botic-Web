<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{!! asset('image/bjnapp-logo.png') !!}"/>

    <!-- Styles -->
    @yield('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
    <div class="panel-footer text-center navbar-fixed-bottom">
        <footer>
            &copy; Dinas Kebudayaan & Pariwisata Bojonegoro | 2017
        </footer>
    </div>
    <!-- Scripts -->
    @yield('js')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
