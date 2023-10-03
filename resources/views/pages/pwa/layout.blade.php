<!DOCTYPE HTML>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="app-url" content="{{env('APP_URL')}}" />
    <meta name="robots" content="index,follow" />
    <link rel="shortcut icon" href="/img/logo/logo.ico" />

    <link href="/css/prod/component/index_preload.css{{ config('app.link_version') }}" type="text/css"
    rel="stylesheet" />
    <link href="/css/page/pwa/index.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="/js/prod/component/index_preload.js{{ config('app.link_version') }}"></script>


    @yield('head')

</head>

<body class='app'>

    <!-- Content section -->
    <div class="content">
        @yield('content')
    </div>

</body>

@include('script.pwa.index')

</html>