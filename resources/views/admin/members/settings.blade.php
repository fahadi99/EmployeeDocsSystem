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
                </div> --}}
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid" id="settings_page">
            <!--begin::Container-->
            <div class="container">
                {{--<div class="row page-sub-heading has-sub-line">
                    <div class="col-sm">
                        <div class="d-inline">
                            <span class="font-weight-bolder text-dark font-size-h3-lg">Junaid Ahmed
                                <span class="text-muted font-size-h5-lg">- Profile</span>
                            </span>
                        </div>

                    </div>
                    <div class="text-primary mt-3 d-inline font-weight-bold font-size-base mr-5 col-smjustify-content-end"></div>


                </div>  --}}
                <div class="row">
                    <button class="btn btn-light-dark btn-sm custom-offcanvas-open mb-5 d-xxl-none ml-12" data-target="kt_profile_aside"><i class="flaticon-cogwheel-2 icon-md " ></i> User Menu</button>
                    <div class="col-xl-12">
                        <div class="d-flex flex-row">
                            <!--begin::Aside-->
                            @include('admin.include.left-aside')
                            <!--end::Aside-->
                            <!--begin::Content-->
                            <div class="flex-row-fluid ml-lg-8" >
                                <div class="card card-custom card-stretch">
                                    <!--begin::Header-->
                                    <div class="card-header py-3">
                                        <div class="card-title align-items-start flex-column">
                                            <h3 class="card-label font-weight-bolder text-dark">Settings</h3>
                                            <span class="text-muted font-weight-bold font-size-sm mt-1">Update your basic notifications</span>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Form-->
                                    {!! Form::open(['action','MemberController@change_admin_settings','id'=>'change_settings_form','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                                        <!--begin::Body-->
                                        <div class="card-body" >
                                            {{ Form::hidden('member_id',isset($SettingEdit->id)?$SettingEdit->id:null, array('id' => 'member_id')) }}
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">Email Notifications</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="radio-inline">
                                                        <label class="radio">
                                                            {!! Form::radio('email_notification', 1 ,isset($SettingEdit)?$SettingEdit->email_notification==1?true:false : true ) !!}
                                                            <span></span>
                                                            Enabled
                                                        </label>
                                                        <label class="radio">
                                                            {!! Form::radio('email_notification', 0, isset($SettingEdit)?$SettingEdit->email_notification == 0 ? true:false : false) !!}
                                                            <span></span>
                                                            Disabled
                                                        </label>
                                                    </div>
                                                    <span class="form-text text-muted">You will not updates via Email  <strong>But</strong> Application emails like password reset will be sent </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">Sms Notifications</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="radio-inline">
                                                        <label class="radio">
                                                            {!! Form::radio('sms_notification', 1 ,isset($SettingEdit)?$SettingEdit->sms_notification==1?true:false : true ) !!}
                                                            <span></span>
                                                            Enabled
                                                        </label>
                                                        <label class="radio">
                                                            {!! Form::radio('sms_notification', 0, isset($SettingEdit)?$SettingEdit->sms_notification==0?true:false : false) !!}
                                                            <span></span>
                                                            Disabled
                                                        </label>
                                                    </div>
                                                    <span class="form-text text-muted">You will not receive any sms notifications</span>
                                                </div>
                                            </div>


                                        <!--end::Body-->
                                        <div class="card-footer d-flex">
                                            <div class="card-toolbar text-right w-100">
                                                <button type="reset" class="btn btn-success mr-2" id="save_settings_changes">Update Settings</button>
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
<script type="text/javascript">
$(function () {
var SITEURL = '{{URL::to('')}}';
    $.ajaxSetup({
       headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });

       $('body').on('click', '#save_settings_changes', function (event) {
            event.preventDefault();
            var form_data = new FormData(document.getElementById("change_settings_form"));
            console.log(form_data);
            //Ajax call starts here
            $.ajax({
                    data: form_data,
                    url: "{{ route('change_admin.settings', ['id' =>  0])}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 200){
                        var message = data.message
                        Swal.fire("Added!", message, "success");
                     //   $('#settings_page').load(document.URL +  '#settings_page');
                        $("#settings_page").load(location.href + " #settings_page>*", "");  }
                    if(data.status === 400){
                        var error = data.message
                        var array = $.map(error, function(value, index) {  return [value]; });
                        let list = '';
                        for (var i = 0; i < array.length; i++)
                        list += array[i] + '\n <br>';
                        Swal.fire("Error!",list, "error");
                        $('#settings_page').load(document.URL +  '#settings_page'); }
                    if(data.status === 409){
                        var error = data.message
                        Swal.fire("Error!", error, "error");
                        $('#change_settings_form').trigger("reset");
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                        Swal.fire("Error!", error, "error");
                        $('#change_settings_form').trigger("reset");
                    }
              });
            //Ajax call ends here
        });

});
</script>
@endsection
