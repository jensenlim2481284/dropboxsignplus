<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>KKM Dashboard</title>

    <link href="/css/prod/dashboard/main.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="/js/prod/component/main_preload.js{{ config('app.link_version') }}"></script>
    <script defer type="text/javascript" src="/js/prod/dashboard/main.js{{ config('app.link_version') }}"></script>

    @yield('head')

</head>

<body>

    <!--Loader section -->
    <div class='page-loader'>
        <div class='loader'>
            <img src="/img/icon/loader.webp"/>            
        </div>
    </div>

    <!-- Content section -->
    <div class="content">
        @yield('content')
    </div>

</body>

@include('script.dashboard.index')

</html>
