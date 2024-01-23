<div class="modal fade" id="shareDocumentModal"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('documents.share_document')}}" method="POST" id="share_document_form" class="form-horizontal" role="form" enctype="multipart/form-data" files="true">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="shareDocumentModalLabel">E docs - {{$page}} <small class="text-muted"></small> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">

                    <div class="container">
                    {{ Form::hidden('document_id',null,array('id' => 'shareDocumentId')) }}

                    @php
                    $permissions = getShareDocumentPermissionStrings();
                    $durations = getShareDocumentDurations();
                    @endphp

                    <div class="form-group justify-content-center row">
                        {!! Form::label('permissions','Permissions: : <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                        <div class="col-lg-9 col-xl-9">
                            @isset($permissions)
                            @foreach ($permissions as $key => $p)
                            <div class="col-3 col-form-label">
                                <div class="checkbox-inline">
                                    <label class="checkbox">
                                        <input type="checkbox" name="permissions[]"  value={{$p}}>
                                        <span></span>

                                        @isset($key)
                                          {{$key}}
                                        @endisset

                                    </label>
                                </div>
                            </div>
                            @endforeach
                            @endisset
                        </div>
                    </div>

                <div class="form-group justify-content-center row">
                    {!! Form::label('duration','Duration: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-9">
                        <select data-live-search="true" name="duration_type" data-placeholder="Select Durations" class="form-control form-control-lg form-control-solid  w-100 selectpicker">
                            @isset($durations)
                            @foreach ($durations as $key => $p)
                            <option value="{{$p}}">{{$key}}</option>
                            </option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="shareDocumentButton"> {{$page}}</button>
            </div>
        </form>
        </div>
    </div>
</div>
