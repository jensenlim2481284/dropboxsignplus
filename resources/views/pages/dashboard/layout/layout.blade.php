<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="robots" content="index,follow" />
    <link rel="shortcut icon" href="/img/logo/logo.ico" />
    <title>KKM Dashboard</title>

    <link href="/css/prod/dashboard/main.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>
    <script type="text/javascript" src="/js/prod/component/main_preload.js{{ config('app.link_version') }}"></script>
    <script  type="text/javascript" src="/js/prod/dashboard/main.js{{ config('app.link_version') }}"></script>
    @yield('head')

</head>

<body>

    <!--Loader section -->
    <div class='page-loader'>
        <div class='loader'>
            <img src="/img/icon/loader.webp" />           
        </div>
    </div>


    <!-- Nav & Content -->
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="ti ti-menu-alt"></i>
                    <i class="ti ti-close close-nav"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div id='main-menu'>
                <ul class="list-unstyled components mb-5">

                    <li class="active">
                        <a href='/'>
                            <i class="menu-icon ti-home">
                                <div>
                                    <span> {{translate('dashboard','Dashboard')}} </span>
                                    <i class='help-icon'></i>
                                </div>
                            </i>
                        </a>
                    </li>
                   
                    <li>
                        <a href='/logout'>
                            <i class="menu-icon ti-share-alt">
                                <div>
                                    <span> {{translate('logout','Logout')}} </span>
                                </div>
                            </i>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="">
            <div class='guideline-panel'>
                <img class='guideline-img' src='/img/vector/dashboard.png' />
                <h1 class='guideline-title'> </h1>
                <p class='guideline-desc'> </p>
            </div>
            @yield('content')
        </div>
    </div>


</body>

@include('script.dashboard.index')

</html>