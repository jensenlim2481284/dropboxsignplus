@extends("pages.dashboard.layout.empty_layout")

@section('head')

<link href="/css/page/dashboard/auth.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>

@endsection

@section('content')

<!--Loader section end -->
<div class='login-box row'>

    <div class='col-sm-7'>
        <div class='vector-section'>
            <img src='/img/vector/account.png' />
        </div>
    </div>
    <div class='col-sm-5'>
        <div class='login-section'>
            <div class='header'>
                <h3>{{translate('login','Login')}}</h3>
            </div>
            <div class='login-form'>
                {{Form::open(['class'=>'loginbox', 'method'=>'post', 'url' => route('auth.submit')])}}
                <div class="loginbox loginpromptbox">
                    <div class="email">
                        <label class="logintxt">{{translate('email','Email Address')}}</label>
                        <input name="email" class="form-control " type="text" placeholder="{{translate('email_place','Please insert your email address')}}" required />
                    </div>
                    <div class="password">
                        <label class="logintxt">{{translate('password','Password')}}</label>
                        <input name="password" class="form-control" type="password" placeholder="{{translate('pass_place','Please insert your password')}}" required />
                    </div>
                </div>
                <div class="signinbtn">
                    <button type="submit" class="btn btn-submit btn-primary">{{translate('login','Login')}}</button>                  
                </div>
               
                {{ Form::close()}}
            </div>
        </div>
    </div>
</div>


@stop