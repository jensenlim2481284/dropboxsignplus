@extends("pages.dashboard.layout.empty_layout")

@section('head')

<style>
    .container{
        height:100vh;
    }
    .google-form{
        position: absolute;
        width: 500px;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
    }
</style>


@endsection

@section('content')

<div class='container' >
    <form class="form-horizontal google-form" method="POST" action="{{ route('2fa') }}" >
        {{ csrf_field() }}

        <div class="form-group">

            <p for="one_time_password" class="col-12 control-label">Google Authenticator Code</p>

            <div class="col-12">
                <input id="one_time_password" type="number" class="form-control" name="one_time_password" required autofocus>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Verify
                </button>
                <a href='/dashboard/logout'>
                    <button type="button" class="btn btn-default logout-btn">
                        Logout
                    </button>
                </a>
            </div>
        </div>
    </form>
</div>


@stop