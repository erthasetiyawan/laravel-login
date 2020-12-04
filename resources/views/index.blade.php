<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        :root {
            --header: #f57e7a;
        }
        .navbar {
            background: var(--header) !important;
        }

        .navbar-light .navbar-brand {
            color: #fff;
            font-weight: bold;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #fff;
        }

        .card-header {
            background: var(--header);
            text-align-last: center;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 1.5rem;
        }

        .pink {
            background: var(--header) !important;
            border-color: var(--header) !important;
            border-width: 1px;
        }

        .ungu {
            background: purple !important;
            border-color: purple !important;
            border-width: 1px;
        }      

        #uploadlah:hover {
            background: #000 !important;
            color: #fff;
            transition: 1s;
        }  

        .navbar-dark .navbar-nav .nav-link{
            color: #fff;
        }
    </style>
</head>
<body>
    <div id="app">
        <app></app>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>