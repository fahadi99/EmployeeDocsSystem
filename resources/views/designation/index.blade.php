@extends('layout.master')
@section('content')

<style>
    /* Include the style here if not using a separate CSS file */
    .selectpicker {
        z-index: 1;
    }

    .dropdown-container {
        position: relative;
        z-index: 1;
    }

    @media (max-width: 1399px) {
    #custom-offcanvas {
           background-color: white;
        }
        .dropdown-container {
        position: relative;
        z-index: 1011 !important;
    }

    }

    @media (min-width: 992px) and (max-width: 1331px)
    {
        .subheader{
            margin-top: 10px !important;
            height: 80px !important;
        }
        .example{
            display: flex;
            gap: 4px;
        }
    }

    @media (max-width: 992px){
        .example{
            display: flex;
            gap: 4px;
        }

    }

    @media (max-width: 575px){
        .addoc{
            margin-top: 10px;
        }
    }
</style>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="example d-flex align-items-center flex-wrap mr-2">
                    @include('include.setting_menu')
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    @if(checkPersonPermission('add-designation-3-0'))
                        <a href="#exampleModal" class="addoc btn btn-light-primary font-weight-bolder btn-sm"
                           data-toggle="modal" data-target="#exampleModal" id="add-designation">
                           Add Designation
                        </a>
                    @endif
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <div class="row page-sub-heading has-sub-line">
                    <div class="col-sm">
                        <div class="d-inline">
                            <span class="font-weight-bolder text-dark font-size-h3-lg">Designation
                                <span class="text-muted font-size-h5-lg">- Listing</span>
                            </span>
                        </div>

                    </div>

                    <div class="text-primary mt-3 d-inline font-weight-bold font-size-base mr-5 col-smjustify-content-end">Total {{ $total_count }}</div>


                </div>
                <div class="dropdown-container">
                <button class="btn btn-light-dark btn-sm custom-offcanvas-open mb-5 d-xxl-none" data-target="custom-offcanvas"><i class="flaticon-cogwheel-2 icon-md " ></i> Filters</button>
                <div class="row sub-line">
                    <div class="col-sm-12 justify-content-end offcanvas offcanvas-left offcanvas-off custom  no-background" id="custom-offcanvas">
                        <button class="btn btn-light-dark btn-icon btn-sm custom-offcanvas-close custom-offcanvas-close-btn d-xxl-none " data-target="custom-offcanvas"><i class="flaticon2-cross icon-md " ></i></button>
                        <div class="row">
                            <div class="col-xxl-8 col-xl-12  text-right " >
                                <div class="mr-3 pt-3 pt-1 font-size-lg d-inline"><strong>Sort By:</strong></div>
                                <div class="d-inline">
                                    <select class="selectpicker w-150px" id="search_sort_by" title="Select Level">
                                        <option >A - Z </option>
                                        <option >Z - A</option>
                                        <option selected>Recent added</option>
                                    </select>
                                </div>


                                <div class="mr-3 ml-5 pt-3 pt-1 font-size-lg d-inline"><strong>Filters:</strong></div>

                                <div class="d-inline">
                                    <select class="selectpicker w-150px" id="search_by_type" title="Select Level">
                                        <option selected>All</option>
                                        <option >Has Users</option>
                                        <option >No User</option>
                                    </select>
                                </div>


                            </div>


                            <div class="col-xxl-4 col-xl-12">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search_by_name" placeholder="Search for...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" id="search_button" type="button">Go!</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                </div>
                </div>
                <div class="row" id="designations-grid">
                    @foreach($data as $row)
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-5 ">
                            <div class="card card-custom pl-2 pt-5 pb-5" id="kt_card_1">
                                <div class="card-header border-0 pr-3">
                                    <div class="card-title w-70 max-w-70" style="word-break : break-all">
                                        <h3 class="card-label">{{$row['name']}}

                                        </h3>
                                    </div>
                                    <div class="card-toolbar">
                                        @if(checkPersonPermission('update-designation-3-0'))
                                            <a id="designation-edit" data-id="{{$row['id']}}"  href="#" class="btn btn-icon btn-sm btn-hover-light-primary"  data-toggle="modal" data-placement="top" title="Edit Group(COO)"  data-target="#exampleModal2">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endif
                                        @if(checkPersonPermission('delete-designation-3-0'))
                                            <a id="designation-delete" data-id="{{$row['id']}}" href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-toggle="modal"   data-placement="top" title="Delete Group(COO) " data-target="#exampleModal3">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="w-100 d-flex mt-n1">
                                        <div class="text-muted mr-5">{{date('F j, Y', strtotime($row['created_at']))}}</div>
                                        <div class="text-muted "><a href=""> {{--{{rand(10,20)}}--}} {{$row->count}}&nbsp; members</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

    @if(checkPersonPermission('add-designation-3-0'))
        <div class="modal fade" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Designation <small class="text-muted">- Add</small> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="add-designation-modal-body" id="add-designation-modal-body">
                    </div>

                    {{-- Form starts here --}}
                    {!! Form::open(['action','DesignationsController@create','id'=>'designations_form','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                    <div class="form-group">
                        {!! Form::label('designation_name','Designation Name: <span class="text-danger">*</span>', ["class"=>"control-label"], false) !!}
                        {!! Form::text("designation_name",null,["class"=>"form-control alphanumeric".($errors->has('designation_name')?" is-invalid":"")
                        ,"autofocus"
                        ,"placeholder"=>"Enter Designation Name"
                        ,"required"]) !!}
                        <span class="form-text text-muted">Examples:
                                                            GM Finance , Software Engineer, Senior Manager</span>
                    </div>
                    {!! Form::close() !!}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="button" id="add-designation-submit" class="btn btn-primary font-weight-bold">Add Designation</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(checkPersonPermission('update-designation-3-0'))
        <div class="modal fade" id="exampleModal2"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example2ModalLabel">   <small class="text-muted">- Update</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    {!! Form::open(['action','DesignationsController@update_designation','id'=>'designations_update','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                    {{ Form::hidden('designation_id',null, array('id' => 'designation_id')) }}
                    <div class="form-group">
                        {!! Form::label('designation_name','Designation Name: <span class="text-danger">*</span>', ["class"=>"control-label"], false) !!}
                        {!! Form::text("designation_name",null,["class"=>"form-control alphanumeric".($errors->has('designation_name')?" is-invalid":"")
                        ,"autofocus"
                        ,"id" => "designation_name_field_modal"
                        ,"placeholder"=>"Enter Designation Name"
                        ,"required"]) !!}

                        <span class="form-text text-muted">Examples:
                    </div>
                    {!! Form::close() !!}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="button" id="designation-update" class="btn btn-primary font-weight-bold">Update Designation</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(checkPersonPermission('delete-designation-3-0'))
        <div class="modal fade" id="exampleModal3"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <small></small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
              {{--  <div class="card-body">
                    <div class="alert alert-custom alert-light-danger" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning text-danger"></i></div>
                        <div class="alert-text">
                            There are <code>four(4)</code> User using this destination, kindly make sure change them one by one <code>OR</code> continue to delete by providing alternative Destination.
                        </div>
                    </div>

                    <div class="alert alert-custom alert-light-success" role="alert">
                        <div class="alert-icon"><i class="flaticon-like text-success"></i></div>
                        <div class="alert-text">
                            There is no member using this designation, click delete to proceed.

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
                </div>--}}
                <div class="modal-body">
                  Are you sure you want to delete this?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="button" id="delete-designation-button" class="btn btn-danger font-weight-bold">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
{{-- Section for adding scripts starts here --}}
@section('scripts')
<script type="text/javascript">
$(function () {

    var SITEURL = '{{URL::to('')}}';

    $.ajaxSetup({
       headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });

        /* Filter search starts here */
    $('#search_button').click(function (event) {
        event.preventDefault();
        performSearch();
    });

    // Add this block to handle enter key press for search
    $('#search_by_name').keydown(function (event) {
        if (event.keyCode === 13) { // Check if the pressed key is Enter (key code 13)
            performSearch();
        }
    });

    function performSearch() {
        // Getting values here
        var search_sort_by = $('#search_sort_by').val();
        var search_by_type = $('#search_by_type').val();
        var search_by_name = $('#search_by_name').val();

        // New location for search
        var newLocation = "{{ route('designations.search') }}?order=" + search_sort_by + "&type=" + search_by_type + "&name=" + search_by_name;

        // Ajax code starts here
        $.ajax({
            type: "GET",
            url: newLocation,
            success: function (data) {
                $("#designations-grid").html(data.html);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        // Ajax code ends here
    }
    /* Filter search ends here */

    //add designation starts here
    $('body').on('click', '#add-designation-submit', function (event) {
        event.preventDefault();

         $.ajax({
            data: $('#designations_form').serialize(),
            url: "{{ route('designations.add')}}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if(data.status === 200){
                Swal.fire("Added!", "Designation Added Successfully!", "success");

                $("#kt_content").load(location.href + " #kt_content>*", "");

                $('#exampleModal').modal('toggle');
                $('#designations_form').trigger("reset");
                }
            if(data.status === 400){
                Swal.fire("Error!", "Please Provide Designation Name", "error");

                setTimeout(function() {
                    $("#designations-grid").load(location.href + " #designations-grid>*", "");
                                    }, 2000);

                $('#exampleModal').modal('toggle');
                $('#designations_form').trigger("reset");
            }
            if(data.status === 409){
                var error = data.message
                Swal.fire("Error!", error, "error");
            }
            },
            error: function (data) {
            console.log('Error:', data);
            }
         });
    });
    //Add designation ends here

    //Edit designation starts here
    $('body').on('click', '#designation-edit', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
                $.ajax({
                type: "get",
                url: SITEURL + "/designations/get_designation/"+id,
                dataType: 'json',
                    success:function(data){
                        $('#designations_update').trigger("reset");
                        $("#example2ModalLabel").html(data.name + '- update');
                        $('.alphanumeric').keyup(function() {
                                        if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
                                            this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
                                        }
                                        });

                                    $('.alphanumeric').focusout(function() {
                                    this.value = this.value.trim();
                                    });
                        $("#designation_name_field_modal").val(data.name);
                        $('#designation_id').val(data.id);
                    },
                    error: function (data) {
                    console.log('Error:', data);
                    }
                });
    });
    //Edit designation ends here

     //Update designation method starts here
     $('body').on('click', '#designation-update', function (event) {
        event.preventDefault();
        $.ajax({
            data: $('#designations_update').serialize(),
            url: "{{ route('designations.update')}}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if(data.status === 200){
                Swal.fire("Added!", "Designation Updated Successfully!", "success");

                setTimeout(function() {
                    $("#designations-grid").load(location.href + " #designations-grid>*", "");
                                    }, 2000);

                $('#exampleModal2').modal('toggle');
                }
            if(data.status === 400){
                Swal.fire("Error!", "Please Provide Designation name!", "error");

                setTimeout(function() {
                    $("#designations-grid").load(location.href + " #designations-grid>*", "");
                                    }, 2000);

                $('#exampleModal2').modal('toggle');
            }
            },
            error: function (data) {
            console.log('Error:', data);
            }
         });
     });
     //Update designation method ends here

    //Delete designation starts here
    $('body').on('click', '#designation-delete', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
                console.log(id);
                //
                $("#delete-designation-button").unbind().click(function() {
                $.ajax({
                        type: "delete",
                        url: SITEURL + "/designations/delete/"+id,
                        success: function (data) {
                                if(data.status === 200){
                                    var message = data.message;
                                    $("#kt_content").load(location.href + " #kt_content>*", "");
                                    Swal.fire("Deleted!", message, "success");



                                    $('#exampleModal3').modal('toggle');}
                                if(data.status === 400){
                                    var error = data.message
                                    Swal.fire("Error!",error, "error");

                                    setTimeout(function() {
                                          $("#designations-grid").load(location.href + " #designations-grid>*", "");
                                    }, 2000);

                                    $('#exampleModal3').modal('toggle');
                                }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
            });
    });
    //Delete designation ends here

    //Allow Alphanumeric Add checks
    $('.alphanumeric').keyup(function() {
    if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
        this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
    }
    });

    $('.alphanumeric').focusout(function() {
    this.value = this.value.trim();
    });
    //Allow Alphanumeric Add checks ends

});
</script>
@endsection
{{-- Section for adding scripts ends here --}}
