<div class="modal fade" id="exampleModal3"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><small></small></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
           {{-- <div class="card-body">
                <div class="alert alert-custom alert-light-danger" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning text-danger"></i></div>
                    <div class="alert-text">
                        There are <code>four(4)</code> User using this department, kindly make sure change them one by one <code>OR</code> continue to delete by providing alternative Department.
                    </div>
                </div>

                <div class="alert alert-custom alert-light-success" role="alert">
                    <div class="alert-icon"><i class="flaticon-like text-success"></i></div>
                    <div class="alert-text">
                        There is no member using this department, click delete to proceed.

                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleSelect2">Select Alternative <span class="text-danger">*</span></label>
                    <select class="form-control" id="exampleSelect2">
                        @foreach($data as $row)
                            <option>{{$row['name']}}</option>
                        @endforeach

                    </select>
                </div>
            </div>     --}}
            <div class="modal-body">
            Are you sure you want to delete this?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" id="delete-domain-button" class="btn btn-danger font-weight-bold">Delete</button>
            </div>
        </div>
    </div>
</div>
