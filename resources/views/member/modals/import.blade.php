<div class="modal fade" id="exampleModalUsers"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Member <small> Import </small></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="card-body">

                  <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">

                            {!! Form::open(['id'=>'usersImportForm','class'=>'horizontal-form','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Import Users File</label>
                                    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                                </div>
                            {{ Form::close() }}

                        </div>
                    </div>
                  </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success font-weight-bold" id="importUsersFile" data-id="0">Import</button>
            </div>
        </div>
    </div>
</div>


