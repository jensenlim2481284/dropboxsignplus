<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dropbox Sign Plus</title>
    <link rel="shortcut icon" href="/img/logo/logo.png" />


    <link href="/css/page/general.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
    <link href="/css/plugin/bootstrap.min.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
    <script src="/js/plugin/jquery.min.js{{ config('app.link_version') }}"></script>
    <script src="/js/plugin/wow.min.js{{ config('app.link_version') }}"></script>
    <script src="/js/plugin/sweetalert.min.js{{ config('app.link_version') }}"></script>

    @yield('head')

</head>

<body>



    <!-- Content section -->
    <div class="content" id='contentContainer'>
        @yield('content')
    </div>
    <script src="/js/plugin/bootstrap.min.js{{ config('app.link_version') }}"></script>
</body>

</html>
