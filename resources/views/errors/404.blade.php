@extends("pages.dashboard.layout.empty_layout")

@section('head')
<title>DropboxSignPlus - 404 Not Found</title>
<link href="/css/page/component/error.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('content')
  <img src='/img/logo/logo_white.png'/>
  <h1 data-h1="404">404</h1>
  <p data-p="NOT FOUND">{{translate('page_not_found','Page Not Found')}}</p>
  <small>{{translate('click_back','Click anywhere to bring you back.')}} </small>


  <script>
    $(document).click(function(){
      window.location.href = "/";
    })
  </script>

@stop
