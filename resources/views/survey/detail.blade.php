@extends('layout.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    @include('include.survey_menu')

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
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
                <!--begin::Profile Card-->
                <div class="card card-custom card-stretch">
                    @include('survey.include.left_aside')
                </div>
                <!--end::Profile Card-->
            </div>
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
                <div class="card card-custom card-stretch">
                    <!--begin::Header-->
                    <div class="card-header py-3">
                        <div class="card-title align-items-start flex-column">
                            <h3 class="card-label font-weight-bolder text-dark">Survey Information</h3>
                            <span class="text-muted font-weight-bold font-size-sm mt-1">Update the Basic information of Survey</span>
                        </div>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                {!! Form::open(['action','SurveyController@update','id'=>'update_form','class'=>'horizontal-form','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                        <!--begin::Body-->
                        <div class="card-body">

                            <div class="form-group row">
                                {!! Form::label('name','Name:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                <div class="col-lg-9 col-xl-6">
                                    {{ Form::text('name',$survey->name,
                                        ['class' => 'form-control form-control-lg form-control-solid',
                                        'id'=>'survey_name',
                                         'placeholder' => 'Enter Title',
                                         'required'
                                            ])
                                    }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('short_description','Short Description:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                <div class="col-lg-9 col-xl-6">
                                    {{ Form::textarea('short_description',$survey->short_description,
                                        ['class' => 'form-control form-control-lg form-control-solid',
                                         'id'=>'short_description',
                                         'rows' => 3,
                                         'placeholder' => 'Enter Short Description',
                                         'required'
                                        ])
                                    }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('long_description','Long Description:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                <div class="col-lg-9 col-xl-6">
                                    {{ Form::textarea('long_description',$survey->long_description,
                                    ['class' => 'form-control form-control-lg form-control-solid',
                                     'id'=>'long_description2',
                                     'rows' => 7,
                                     'placeholder' => 'Enter Long Description',
                                     'required'
                                    ]) }}
                                </div>
                            </div>

                            <div class="form-group  row">
                                {!! Form::label('start_date','Start Date:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group date" id="start_date_picker" data-target-input="nearest">
                                        {!! Form::text("start_date",$survey->start_date,["class"=>"form-control datetimepicker-input".($errors->has('start_date')?" is-invalid":"")
                                        ,"autofocus"
                                        ,"id" => "start_date"
                                        ,"placeholder"=>"Select date &amp; time"
                                        ,"data-target"=>"#start_date_picker"
                                        ,"required"]) !!}
                                        <div class="input-group-append" data-target="#start_date_picker" data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="ki ki-calendar"></i>
                                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group row">
                                {!! Form::label("end_date","End Date",["class"=>"col-xl-3 col-lg-3  col-form-label"]) !!}
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group date" id="end_date_picker" data-target-input="nearest">
                                        {!! Form::text("end_date",$survey->end_date,["class"=>"form-control datetimepicker-input".($errors->has('end_date')?" is-invalid":"")
                                        ,"autofocus"
                                        ,"id" => "end_date"
                                        ,"placeholder"=>"Select date &amp; time"
                                        ,"data-target"=>"#end_date_picker"
                                        ,"required"]) !!}
                                        <div class="input-group-append" data-target="#end_date_picker" data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="ki ki-calendar"></i>
                                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!--end::Body-->

                        <div class="card-footer py-3">
                            <div class="card-toolbar flex-column align-items-end d-flex">
                                <button type="button" id="update-button" class="btn btn-success mr-2">Update</button>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
            <!--end::Content-->
        </div>
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

    $('body').on('click', '#update-button', function (event) {
        event.preventDefault();
        //Ajax code starts here
        var form_data = new FormData(document.getElementById("update_form"));
        console.log(form_data);
        $.ajax({
            data: form_data,
            url: "{{ route('survey.update', ['id' => $survey->id ])}}",
            type: "POST",
            dataType: 'json',
            cache:false,
            contentType: false,
            processData: false,
            success: function (data) {
                if(data.status === 200){
                    var message = data.message
                    Swal.fire("Updated!", message, "success");

                }
                if(data.status === 400){
                    var error = data.message
                    var array = $.map(error, function(value, index) {  return [value]; });
                    let list = '';
                    for (var i = 0; i < array.length; i++)
                        list += array[i] + '\n <br>';
                    Swal.fire("Error!",list, "error");

                    //$('#exampleModal').modal('toggle');
                    //$('#member_form').trigger("reset");
                }
                if(data.status === 409){
                    var error = data.message
                    Swal.fire("Error!", error, "error");
                    $('#exampleModal2').modal('toggle');
                    $('#update_form').trigger("reset");
                }
            },
            error: function (data) {
                console.log('Error:', data.responseText);
                var error = data.responseText
                Swal.fire("Error!", error, "error");
                //$('#exampleModal').modal('toggle');
                //$('#member_form').trigger("reset");
            }
        });
        //Ajax code ends here
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

    $('#start_date_picker').datetimepicker({
        language: 'en',
        format: 'yyyy-MM-DD hh:mm'
    });
    $('#end_date_picker').datetimepicker({
        language: 'en',
        format: 'yyyy-MM-DD hh:mm'
    });

});
</script>
@endsection
