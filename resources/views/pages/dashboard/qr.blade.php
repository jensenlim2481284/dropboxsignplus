@extends("pages.dashboard.layout.layout")

@section('head')
<link href="/css/page/dashboard/qr.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
<link href="/css/prod/component/table.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<script defer type="text/javascript" src="/js/prod/component/table.js{{ config('app.link_version') }}"></script>
<script type="text/javascript" src="/js/page/dashboard/qr.js{{ config('app.link_version') }}"></script>

@endsection

@section('content')

<!-- Back button -->
{!! Form::open(['route' => 'qr.export', 'id'=>'exportForm']) !!} {!! Form::close() !!}
<a href="/"><button class='btn btn-link back-btn'> <i class='ti-arrow-left'> </i></button></a>
<button class='btn btn-link add-btn' data-toggle="modal" data-target="#manageModal" data-toggle="tooltip" data-placement="bottom" title="Create QR"  >
    <i class='ti-plus'> </i>
</button>
<button class='btn btn-link export-btn ml-3' data-toggle="tooltip" data-placement="bottom" title="Export"  >
    <i class='ti-share'> </i>
</button>


<div class='row'>
    <div class='table-section'>
        <div class='table-box'>
            <h3 class='title ml-0'>QR Code Management</h3>
            <div class="table-responsive">
                <table class="table">
                    <thead class='thead-none'>
                        <tr>
                            <th>QR URL</th>
                            <th>Serial Code</th>
                            <th>PIN</th>
                            <th>Product Name</th>        
                            <th>Created At</th>
                            <th scope="col"> {{translate('action','Action')}} </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $index=>$record)
                        <tr>
                            <td><a href='{{env("DASHBOARD_URL")}}qrcode/{{$record->encrypted_uid}}.tiff' target="_blank" download>Link</a></td>
                            <td>{{$record->uid}}</td>
                            <td>{{$record->pin}}</td>
                            <td>{{$record->title}}</td>                            
                            <td>{{$record->created_at->format('Y-m-d')}}</td>
                            <td class="">
                                <div role="group">
                                    <button id="btnGroupDrop{{$index}}" type="button" aria-haspopup="true" aria-expanded="false" class="btn btn-default menu-tooltip" data-tooltip-content="#tooltip_menu{{$index}}">
                                        <i class='ti-more-alt'></i>
                                    </button>
                                    <div class="tooltip_templates">
                                        <span id="tooltip_menu{{$index}}" class='tooltip_menus'>
                                            <button data-toggle="modal" data-target="#deleteModal" data-id="{{$record->id}}" class='btn btn-danger more-btn action-btn' value="{{$record->id}}" target-id='deleteID'>
                                                {{translate('delete','Delete')}}
                                            </button>
                                        </span>
                                    </div>
                                </div>                                         
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $records->appends($_GET)->links() }}
                <p class='search-total'> {{$records->count()}} {{translate('records','Records')}} </p>
            </div>
        </div>
    </div>
</div>
@include('modal.dashboard.qr_management')
@stop