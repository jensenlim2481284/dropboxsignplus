@extends("pages.dashboard.layout.layout")

@section('head')
  
@endsection

@section('content')


    <article>
        <h1>Page Expired.</h1>
        <div>
            <p>Redirecting Back to homepage...</p>
        </div>
    </article>
<script>

    $(document).ready(function(){        
        window.location.href = "/";    
    })

</script>

@stop