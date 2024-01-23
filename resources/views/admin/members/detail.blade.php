@extends('layout.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    @include('include.member_menu')

                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
               {{--  <div class="d-flex align-items-center">
                    <a href="#" class="btn btn-light-primary font-weight-bolder btn-sm mr-3"
                       data-toggle="modal" data-target="#exampleModal"
                    >Add User/Guest</a>
                </div>  --}}
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">

                <div class="row" >
                    <button class="btn btn-light-dark btn-sm custom-offcanvas-open mb-5 d-xxl-none ml-12" data-target="kt_profile_aside"><i class="flaticon-cogwheel-2 icon-md " ></i> User Menu</button>
                    <div class="col-xl-12">
                        <div class="d-flex flex-row">
                            <!--begin::Aside-->
                            @include('admin.include.left-aside')
                            {{--@include('admin.include.left_aside')--}}
                            <!--end::Aside-->
                            <!--begin::Content-->
                            <div class="flex-row-fluid ml-lg-8" >
                                <div class="card card-custom card-stretch">
                                    <!--begin::Header-->
                                    <div class="card-header py-3">
                                        <div class="card-title align-items-start flex-column">
                                            <h3 class="card-label font-weight-bolder text-dark">Profile</h3>
                                            <span class="text-muted font-weight-bold font-size-sm mt-1">Update your basic profile information</span>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Form-->
                                    {!! Form::open(['action','MemberController@change_admin_detail','id'=>'change_details_form','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}

                                    {{ Form::hidden('member_id',isset($PersonEdit->id)?$PersonEdit->id:null, array('id' => 'member_id')) }}
                                    {{--   <form class="form">  --}}
                                        <!--begin::Body-->
                                        <div class="card-body">

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Profile Picture</label>

                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="image-input image-input-outline" id="kt_image_1">
                                                        <div class="image-input-wrapper" style="background-image: url({{getPersonImage($PersonEdit->picture)}})"></div>
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

                                            <div class="form-group row ">
                                                {!! Form::label('member_phone','Phone: <span class="text-danger font-size-h5">*</span>',["class"=>"col-xl-2 col-lg-2 col-form-label"], false) !!}
                                                <div class="col-sm-12 col-lg-4">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="la la-phone"></i>
                                                                </span>
                                                        </div>
                                                        {{ Form::text('member_phone',isset($PersonEdit->phone)?$PersonEdit->phone:null,
                                                        ['class' => 'form-control form-control-lg form-control-solid',
                                                        'id'=>'member_phone',
                                                         'placeholder' => 'Phone',
                                                         'required'
                                                        ]) }}
                                                    </div>
                                                </div>


                                                {!! Form::label('email','Email Address:   <span class="text-danger font-size-h5">*</span>',["class"=>"col-xl-2 col-lg-2 col-form-label text-center"], false) !!}
                                                <div class="col-sm-12 col-lg-4">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="la la-at"></i>
                                                                </span>
                                                        </div>
                                                        {{ Form::text('email',isset($PersonEdit->email)?$PersonEdit->email:null,
                                                        ['class' => 'form-control form-control-lg form-control-solid ',
                                                        'id'=>'email',
                                                        'placeholder' => 'Email',
                                                        'required'
                                                        ]) }}
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="form-group row ">

                                            </div>

                                            <div class="h-10px mt-10 mb-10 border-bottom border-bottom-light-dark"></div>

                                            <div class="form-group  row">
                                                {!! Form::label('first_name','First Name:   <span class="text-danger font-size-h5">*</span>',["class"=>"col-xl-2 col-lg-2 col-form-label"], false) !!}
                                                <div class="col-sm-12 col-lg-4">
                                                    {{ Form::text('first_name',isset($PersonEdit->first_name)?$PersonEdit->first_name:null,
                                                    ['class' => 'form-control form-control-lg form-control-solid',
                                                    'id'=>'first_name',
                                                     'placeholder' => 'Enter First Name',
                                                     'required'
                                                    ]) }}
                                                </div>

                                                {!! Form::label('last_name','Last Name:        <span class="text-danger font-size-h5"> * </span>',["class"=>"col-xl-2 col-lg-2 col-form-label  text-center"], false) !!}
                                                <div class="col-sm-12 col-lg-4">
                                                    {{ Form::text('last_name',isset($PersonEdit->last_name)?$PersonEdit->last_name:null,
                                                    ['class' => 'form-control form-control-lg form-control-solid',
                                                     'id'=>'last_name',
                                                     'placeholder' => 'Enter Last Name',
                                                     'required'
                                                    ]) }}
                                                </div>
                                            </div>

                                            <div class="form-group  row">
                                                {!! Form::label('domain','Domain:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-2 col-lg-2 col-form-label "], false) !!}
                                                <div class="col-sm-12 col-lg-4">
                                                    {{Form::select('domain',$selectBoxes['domains'],isset($PersonEdit->domain_id)?$PersonEdit->domain_id:null,
                                                    ["class" => "form-control form-control-lg form-control-solid domain-tag w-100", "placeholder" => "Select Domain"])}}
                                                </div>
                                                {!! Form::label('organization','Organization:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-2 col-lg-2 col-form-label  text-center"], false) !!}
                                                <div class="col-sm-12 col-lg-4">
                                                    {{Form::select('organization',$selectBoxes['organizations'],isset($PersonEdit->organization_id)?$PersonEdit->organization_id:null,
                                                    ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Organization"])}}
                                                </div>

                                            </div>

                                            <div class="form-group  row">
                                                {!! Form::label('department','Department:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-2 col-lg-2 col-form-label"], false) !!}
                                                <div class="col-sm-12 col-lg-4">
                                                    {{Form::select('department',$selectBoxes['departments'],isset($PersonEdit->department_id)?$PersonEdit->department_id:null,
                                                    ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Department"])}}
                                                </div>

                                                {!! Form::label('designation','Designation:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-2 col-lg-2 col-form-label  text-center"], false) !!}
                                                <div class="col-sm-12 col-lg-4">
                                                    {{Form::select('designation',$selectBoxes['designations'],isset($PersonEdit->designation_id)?$PersonEdit->designation_id:null,
                                                    ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Designation"])}}
                                                </div>
                                            </div>



                                            <div class="form-group  row">
                                                {!! Form::label('person_tags','Person tags:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-2 col-lg-2 col-form-label"], false) !!}
                                                <div class="col-sm-12 col-lg-4">
                                                    {{Form::select('person_tags[]',$selectBoxes['person_tags'],$personTags,
                                                    ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Tags",
                                                    "multiple" => true
                                                    ])}}
                                                </div>


                                            </div>



                                            <div class="form-group row">
                                                <label class="col-xl-2 col-lg-2 col-form-label">Privileges
                                                    <span class="text-danger font-size-h5">*</span>
                                                </label>
                                                <div class="col-sm-12 col-xl-4">
                                                {{Form::select("person_type",[
                                                    '1' => 'User',
                                                    '2' => 'Admin',
                                                    '3' => 'Root'
                                                    ]
                                                   ,(isset($PersonEdit)?$PersonEdit->is_admin:null) ,
                                                     [
                                                     "class" => "form-control form-control-lg form-control-solid",
                                                     "placeholder" => "",
                                                     "id"=> "permission"
                                                      ])
                                                     }}
                                                </div>
                                            </div>


                                        </div>
                                        <!--end::Body-->
                                        <div class="card-footer d-flex">
                                            <div class="card-toolbar text-right w-100">
                                                <button type="reset" class="btn btn-success mr-2" id="save_detail_changes">Save Changes</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    <!--end::Form-->
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                    </div>



                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

@endsection
@section('scripts')
<script src="{{URL::to('assets/js/pages/crud/file-upload/image-input.js')}}"></script>
<script type="text/javascript">
$(function () {
var SITEURL = '{{URL::to('')}}';
    $.ajaxSetup({
       headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });


        $('body').on('click', '#save_detail_changes', function (event) {
            event.preventDefault();
            var form_data = new FormData(document.getElementById("change_details_form"));
             console.log(form_data);
            $.ajax({
                    data: form_data,
                    url: "{{ route('change_admin.detail', ['id' => $PersonEdit->id ])}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 200) {
                            showToastr('success', data.message);
                            console.log(data.message);
                            $('#details_page').load(document.URL +  '#details_page');
                            $("#kt_profile_aside").load(location.href + " #kt_profile_aside>*", "");
                            $('.select2 ').select2({
                                     placeholder: "Select ",
                            });
                        }
                        if(data.status === 400) {
                            showToastr('error', data.message, 'list');
                            console.log(data.message);

                            $('#details_page').load(document.URL +  '#details_page');
                            $('.select2 ').select2({
                                     placeholder: "Select ",
                                    });
                        }
                        if(data.status === 409){
                            showToastr('error', data.message);
                            console.log(data.message);
                            $('#change_details_form').trigger("reset");
                        }
                    },
                    error: function (data) {
                        showToastr('error', data.responseText)
                        console.log(data.message);
                        $('#change_details_form').trigger("reset");
                    }
              });
        });

});
</script>
@endsection
