@extends("pages.empty_layout")

@section('head')
<link href="/css/page/index.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>

<script src="
https://cdn.jsdelivr.net/npm/webgazer@3.2.0/dist/webgazer.min.js
"></script>

@endsection

@section('content')


<div class='home-section'>
    <img src='/img/logo/logo.png' class='logo'/>
    <img src='/img/logo/logoText.png' class='logo-text'/>
    <p class='mb-5 mt-2'>Leverages AI-driven eye-tracking technology to intelligently adapt digital content in real-time, ensuring captivating and personalized user experiences.</p>
    <div class='home-btn-section'>
        <a href='/sign'><button class='btn btn-primary mr-2'>Sign Document</button></a>
        <a href='/report'><button class='btn btn-secondary ml-2'>Analysis Report</button></a>
    </div>
</div>


@stop
