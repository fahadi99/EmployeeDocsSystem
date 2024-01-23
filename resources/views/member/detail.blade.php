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
                {{-- <div class="d-flex align-items-center">
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
                        @include('member.include.left_aside')
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
                                    {!! Form::open(['action','MembersController@change_detail','id'=>'change_details_form','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                                    {{--   <form class="form">  --}}
                                        <!--begin::Body-->
                                        <div class="card-body">
                                            {{ Form::hidden('member_id',isset($data->id)?$data->id:null, array('id' => 'member_id')) }}
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Profile Picture</label>

                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="image-input image-input-outline" id="kt_image_1">
                                                        <div class="image-input-wrapper" @isset($data->picture)
                                                            style="background-image: url({{getPersonImage($data->picture)}})"
                                                        @endisset></div>
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
                                                {!! Form::label('member_phone','Phone: <span class="text-danger font-size-h5">*</span>',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="la la-phone"></i>
                                                                </span>
                                                        </div>
                                                        {{ Form::text('member_phone',isset($data->phone)?$data->phone:null,
                                                        ['class' => 'form-control form-control-lg form-control-solid',
                                                        'id'=>'member_phone',
                                                         'placeholder' => 'Phone',
                                                         'required'
                                                        ]) }}
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                {!! Form::label('email','Email Address:   <span class="text-danger font-size-h5">*</span>',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="la la-at"></i>
                                                                </span>
                                                        </div>
                                                        {{ Form::text('email',isset($data->email)?$data->email:null,
                                                        ['class' => 'form-control form-control-lg form-control-solid',
                                                        'id'=>'member_email',
                                                        'placeholder' => 'Email',
                                                        'required'
                                                        ]) }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="h-10px mt-10 mb-10 border-bottom border-bottom-light-dark"></div>

                                            <div class="form-group  row">
                                                {!! Form::label('first_name','First Name:   <span class="text-danger font-size-h5">*</span>',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                                <div class="col-lg-9 col-xl-6">
                                                    {{ Form::text('first_name',isset($data->first_name)?$data->first_name:null,
                                                    ['class' => 'form-control form-control-lg form-control-solid',
                                                    'id'=>'first_name',
                                                     'placeholder' => 'Enter First Name',
                                                     'required'
                                                    ]) }}
                                                </div>
                                            </div>


                                            <div class="form-group  row">
                                                {!! Form::label('last_name','Last Name: <span class="text-danger font-size-h5">*</span>',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                                <div class="col-lg-9 col-xl-6">
                                                    {{ Form::text('last_name',isset($data->last_name)?$data->last_name:null,
                                                    ['class' => 'form-control form-control-lg form-control-solid',
                                                     'id'=>'last_name',
                                                     'placeholder' => 'Enter Last Name',
                                                     'r
                                                     equired'
                                                    ]) }}
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
                    url: "{{ route('change_member.detail')}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 200){
                        var message = data.message
                        Swal.fire("Added!", message, "success");
                        $('#details_page').load(document.URL +  '#details_page');

                        $("#profileImagePictureOnTop").load(location.href + "#profileImagePictureOnTop>*", "");
                        $("#kt_profile_aside").load(location.href + " #kt_profile_aside>*", "");
                        $('.select2 ').select2({
                                 placeholder: "Select ",
                                });
                        }
                    if(data.status === 400){
                        var error = data.message
                        var array = $.map(error, function(value, index) {  return [value]; });
                        let list = '';
                        for (var i = 0; i < array.length; i++)
                        list += array[i] + '\n <br>';
                        Swal.fire("Error!",list, "error");
                        $('#details_page').load(document.URL +  '#details_page');
                        $('.select2 ').select2({
                                 placeholder: "Select ",
                                });
                    }
                    if(data.status === 409){
                        var error = data.message
                        Swal.fire("Error!", error, "error");
                        $('#change_details_form').trigger("reset");
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data);
                    var error = data.responseText
                        Swal.fire("Error!", error, "error");
                        $('#change_details_form').trigger("reset");
                    }
              });
        });

});
</script>
@endsection
