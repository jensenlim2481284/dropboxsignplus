@extends("pages.empty_layout")

@section('head')
<title>DropboxSignTrackr - 404 Not Found</title>
<link href="/css/page/error.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('content')
  <img src='/img/logo/logo_white.png'/>

    <article>
        <h1>Action Too Frequent </h1>
        <div>
            <p>For the security purpose. Please try again later. </p>
            <small> Click anywhere to bring you back </small>
        </div>
    </article>


  <script>
    $(document).click(function(){
      window.location.href = "/";
    })
  </script>

@stop

