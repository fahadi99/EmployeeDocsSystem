<div class="modal fade" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User <small class="text-muted">- Add</small> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action','MembersController@add','id'=>'member_form','class'=>'horizontal-form','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}

                <div class="row mb-5 justify-content-center">
                    <div class="col-xl-3 font-size-h3">Contacts</div>
                    <div class="col-lg-9  col-xl-6 text-right">

                        <span class="text-muted font-weight-bold mr-5">
                        <span class="text-danger font-size-h3">*</span> Required for Users
                        </span>

                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    {!! Form::label('member_phone','Phone:  <span class="text-danger font-size-h3">*</span>',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-phone"></i>
                                                            </span>
                            </div>
                            {{ Form::text('member_phone',null,
                            ['class' => 'form-control form-control-lg form-control-solid',
                            'id'=>'member_phone',
                             'placeholder' => 'Phone',
                             'required'
                            ]) }}
                        </div>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    {!! Form::label('member_email','Email Address:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-at"></i>
                                                            </span>
                            </div>
                            {{ Form::text('email',null,
                            ['class' => 'form-control form-control-lg form-control-solid',
                            'id'=>'email',
                             'placeholder' => 'Email',
                             'required'
                            ]) }}
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5">
                    <div class="col-xl-3 font-size-h3">Information</div>
                    <div class="col-lg-9 col-xl-6">
                        <h5 class="font-weight-bold mb-6"></h5>
                    </div>
                </div>
                <div class="form-group justify-content-center row">
                    {!! Form::label('first_name','First Name:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        {{ Form::text('first_name',null,
                        ['class' => 'form-control form-control-lg form-control-solid',
                        'id'=>'first_name',
                         'placeholder' => 'Enter First Name',
                         'required'
                    ]) }}
                    </div>
                </div>
                <div class="form-group justify-content-center row">
                    {!! Form::label('last_name','Last Name:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        {{ Form::text('last_name',null,
                        ['class' => 'form-control form-control-lg form-control-solid',
                         'id'=>'last_name',
                         'placeholder' => 'Enter Last Name',
                         'r
                         equired'
                        ]) }}
                    </div>
                </div>

                <div class="form-group justify-content-center row">
                    {!! Form::label('domain','Domain:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        {{Form::select('domain',$selectBoxes['domains'],null,
                        ["class" => "form-control form-control-lg form-control-solid domain-tag w-100", "placeholder" => "Select Domain"])}}
                    </div>
                </div>

                <div class="form-group justify-content-center row">
                    {!! Form::label('organization','Organization:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        {{Form::select('organization',$selectBoxes['organizations'],null,
                        ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Organization"])}}
                    </div>
                </div>


                <div class="form-group justify-content-center row">
                    {!! Form::label('department','Department:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                         {{Form::select('department',$selectBoxes['departments'],null,
                         ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Department"])}}
                    </div>
                </div>

               {{-- <div class="form-group justify-content-center row">
                    {!! Form::label('document_priority','Document_Priority:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                         {{Form::select('document_priority',$selectBoxes['document_priorities'],null,
                         ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Document_priority"])}}
                    </div>
                </div> --}}


                <div class="form-group justify-content-center row">
                    {!! Form::label('designation','Designation:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        {{Form::select('designation',$selectBoxes['designations'],null,
                        ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Designation"])}}
                    </div>
                </div>



                <div class="form-group justify-content-center row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Profile picture

                    </label>

                    <div class="col-lg-9 col-xl-6">
                        <div class="image-input image-input-outline" id="kt_image_1">
                            <div class="image-input-wrapper" style="background-image: url(assets/media/users/blank.png)"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="profile_avatar" id="profile_avatar">
                                <input type="hidden" name="profile_avatar_remove" value="0">
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                    </div>
                </div>

                <div class="text-muted float-right"><strong>Note:</strong> Random & Secured Password will be sent to User via Email address.</div>
              {{ Form::close() }}
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="add-member-button">Add User</button>
            </div>
        </div>
    </div>
</div>
