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
        <div class="d-flex flex-column-fluid" id="change-password">
            <!--begin::Container-->
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <button class="btn btn-light-dark btn-sm custom-offcanvas-open mb-5 d-xxl-none ml-9" data-target="kt_profile_aside"><i class="flaticon-cogwheel-2 icon-md " ></i> User Menu</button>
                        <div class="d-flex flex-row">
                            <!--begin::Aside-->
                            @include('member.include.left_aside')
                            <!--end::Aside-->
                            <!--begin::Content-->
                            <div class="flex-row-fluid ml-lg-8">
                                <div class="card card-custom card-stretch">
                                    <!--begin::Header-->
                                    <div class="card-header py-3">
                                        <div class="card-title align-items-start flex-column">
                                            <h3 class="card-label font-weight-bolder text-dark">Update Password</h3>
                                            <span class="text-muted font-weight-bold font-size-sm mt-1">Update your profile password</span>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Form-->
                                    {{-- <form class="form">  --}}
                                        {!! Form::open(['action','MembersController@change_password','id'=>'change_password_form','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                                        <!--begin::Body-->
                                        <div class="card-body">

                                                {{--
                                                   // if user is not super admin
                                                   // if id == loggin user id
                                                --}}

                                            <div class="form-group row">

                                             <label class="col-xl-3 col-lg-3 col-form-label text-alert">Current Password</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input name="current_password" type="password" class="form-control form-control-lg form-control-solid mb-2" value="" placeholder="Current password">
                                                    <a href="{{url('/logout')}}" class="text-sm font-weight-bold">Forgot password ?</a>
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">New Password</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input name="new_password" type="password" class="form-control form-control-lg form-control-solid" value="" placeholder="New password">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">Verify Password</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input name="verify_password" type="password" class="form-control form-control-lg form-control-solid" value="" placeholder="Verify password">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                        <div class="card-footer d-flex">
                                            <div class="card-toolbar text-right w-100">
                                                <button type="button" class="btn btn-success mr-2" id="update-password">Update Password</button>
                                            </div>
                                        </div>
                                    {{-- </form>  --}}
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

       $('body').on('click', '#update-password', function (event) {
        event.preventDefault();
        var form_data = new FormData(document.getElementById("change_password_form"));
            //Ajax call starts here
            $.ajax({
                    data: form_data,
                    url: "{{ route('change_member.password')}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 200){
                        var message = data.message
                        Swal.fire("Added!", message, "success");
                        $("#change-password").load(location.href + " #change-password>*", "");
                         // $('#exampleModal').modal('toggle');
                        $('#change_password_form').trigger("reset");
                        }
                    if(data.status === 400){
                        var error = data.message
                        var array = $.map(error, function(value, index) {  return [value]; });
                        let list = '';
                        for (var i = 0; i < array.length; i++)
                        list += array[i] + '\n <br>';
                        Swal.fire("Error!",list, "error");
                        $("#change-password").load(location.href + " #change-password>*", "");
                        //$('#exampleModal').modal('toggle');
                        //$('#member_form').trigger("reset");
                    }
                    if(data.status === 409){
                        var error = data.message
                        Swal.fire("Error!", error, "error");
                        //$('#exampleModal').modal('toggle');
                        //$('#member_form').trigger("reset");
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                        Swal.fire("Error!", error, "error");
                        //$('#exampleModal').modal('toggle');
                        $('#change-passwords').trigger("reset");
                    }
              });
            //Ajax call ends here
       });

});
</script>
@endsection
