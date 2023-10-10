@extends("pages.empty_layout")

@section('head')
<title>DropboxSignTrackr - Website Under Maintenance </title>
<link href="/css/page/error.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('content')
  <img src='/img/logo/logo_white.png'/>
  <p data-p="NOT FOUND">Website is under maintenance. Please try again after few minutes, sorry for any inconvenience caused. </p>
  <small>Click anywhere to bring you back. </small>


  <script>
    $(document).click(function(){
      window.location.href = "/";
    })
  </script>

@stop
