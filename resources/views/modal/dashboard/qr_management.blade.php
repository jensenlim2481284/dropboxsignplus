<div id="manageModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'qr.manage']) !!}
            <div class="modal-header">
                <h4 class="modal-title">
                    Manage QR
                </h4>
            </div>
            <div class="modal-body export-modal row">
                <input type='hidden' name='editID' id='editID' />
                <div class='col-sm-12 form-group'>
                    <p>PIN</p>
                    <input type="text" class="form-control" name="pin" />
                </div>
                <div class='col-sm-12 form-group'>
                    <p>Product Name</p>
                    <input type="text" class="form-control" name="title" />
                </div>
                <div class='col-sm-12 form-group'>
                    <p>Product Description</p>
                    <textarea type="text" class="form-control" name="desc" > </textarea>
                </div>
                <div class='col-sm-12 form-group'>
                    <p>QR Pattern </p>
                    <select name='pattern' class='form-control'> 
                        <option value="1" selected> A </option>
                        <option value="2"> B </option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class='btn btn-success submit-btn'> Create </button>
                <button type="button" class="btn btn-default"
                    data-dismiss="modal">Cancel</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'qr.delete','method'=>'DELETE']) !!}
            <input name='deleteID' id='deleteID' type='hidden' />
            <div class="modal-header">
                <h4 class="modal-title">
                    Delete QR
                </h4>
            </div>
            <div class="modal-body export-modal row">
                <div class='col-sm-12 form-group'>
                    {{translate('are_user','Are you sure?')}}
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::submit(translate('delete','Delete'),['class'=>'btn btn-danger']) !!}
                <button type="button" class="btn btn-default"
                    data-dismiss="modal">{{translate('cancel','cancel')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
