@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
<div class="alert alert-success">
  {{session('success')}}
</div>
@endif


@if(session()->has('hasPopup'))
    <div class="alert alert-{{session()->get('messageType')}}">
        <p><strong>{{session()->get('messageTitle')}}</strong></p>
        <p>{{session()->get('messageData')}}</p>
    </div>

    <div class="modal fade" id="notificationModel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{session()->get('messageTitle')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">{{session()->get('messageData')}}</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

@endif
