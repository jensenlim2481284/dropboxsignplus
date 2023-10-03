@extends("pages.dashboard.layout.layout")

@section('head')
<link href="/css/page/dashboard/index.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
@endsection

@section('content')

<div class='container'>
    <div class='row'>
        <div class='col-xl-6 col-lg-6 col-sm-12'>
            <a href='/qr'>
                <div class='custom-item-box2'>
                    <div class='image-section'>
                        <img src='/img/vector/cms.png' />
                    </div>
                    <div>
                        <div class='content-section'>
                            <h1>QR Management</h1>
                            <p>You can create QR and export QR list in this module.</p>
                            <button class='btn btn-primary'>Open QR Module</button>
                        </div>
                    </div>
                </div>
            </a>
        </div>       
        <!-- <div class='col-xl-6 col-lg-6 col-sm-12'>
            <a href='/translate'>
                <div class='custom-item-box2'>
                    <div class='image-section'>
                        <img src='/img/vector/discuss.png' />
                    </div>
                    <div>
                        <div class='content-section'>
                            <h1>{{translate('translate','Translate')}}</h1>
                            <p>{{translate('translate_desc','Here you can manage system content translate')}}</p>
                            <button class='btn btn-primary'>{{translate('manage_translate','Manage Translate')}} </button>
                        </div>
                    </div>
                </div>
            </a>
        </div>       -->
    </div>
</div>

@stop