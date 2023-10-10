@extends("pages.empty_layout")

@section('head')
<title>DropboxSignTrackr - 404 Not Found</title>
<link href="/css/page/error.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('content')
  <img src='/img/logo/logo_white.png'/>
  <h1 data-h1="404">404</h1>
  <p data-p="NOT FOUND">Page Not Found</p>
  <small>Click anywhere to bring you back/ </small>


  <script>
    $(document).click(function(){
      window.location.href = "/";
    })
  </script>

@stop
