@extends('layout.master')
@section('content')

<style>
    /* Include the style here if not using a separate CSS file */

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
        z-index: 97;

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
    <div class="subheader py-2 py-lg-4 subheader-solid"  id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="example d-flex align-items-center flex-wrap mr-2">
                @include('include.setting_menu')

            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            @if(checkPersonPermission('add-type-3-0'))
            <div class="d-flex align-items-center">
                <a href="#" class="addoc btn btn-light-primary font-weight-bolder btn-sm" data-toggle="modal"
                    data-target="#exampleModal">Add Document types</a>
            </div>
            @endif
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
                        <span class="font-weight-bolder text-dark font-size-h3-lg">Document Types
                            <span class="text-muted font-size-h5-lg">- Listing</span>
                        </span>
                    </div>

                </div>
                <div class="text-primary mt-3 d-inline font-weight-bold font-size-base mr-5 col-smjustify-content-end">
                    Total {{$total_count}}</div>


            </div>
            <div class="dropdown-container">
            <button class="btn btn-light-dark btn-sm custom-offcanvas-open mb-5 d-xxl-none"
                data-target="custom-offcanvas"><i class="flaticon-cogwheel-2 icon-md "></i> Filters</button>
            <div class="row sub-line">
                <div class="annideya col-sm-12 justify-content-end offcanvas offcanvas-left offcanvas-off custom  no-background"
                    id="custom-offcanvas">
                    <button
                        class="btn btn-light-dark btn-icon btn-sm custom-offcanvas-close custom-offcanvas-close-btn d-xxl-none "
                        data-target="custom-offcanvas"><i class="flaticon2-cross icon-md "></i></button>
                    <div class="row">
                        <div class="col-xxl-8 col-xl-12 text-right ">
                            <div class="mr-3 pt-3 pt-1 font-size-lg d-inline"><strong>Sort By:</strong></div>
                            <div class="d-inline">
                                <select class="selectpicker w-150px" id="search_sort_by" title="Select Level">
                                    <option>A - Z </option>
                                    <option>Z - A</option>
                                    <option selected>Recent added</option>
                                </select>
                            </div>


                            <div class="mr-3 ml-5 pt-3 pt-1 font-size-lg d-inline"><strong>Filters:</strong></div>

                           <div class="d-inline">
                                <select class="selectpicker w-150px" id="search_by_members" title="Select Level">
                                    <option selected>All User</option>
                                    <option>Has Users</option>
                                    <option>No User</option>
                                </select>
                            </div>


                             {{-- <div class="d-inline">
                                <select class="selectpicker w-150px" id="search_by_type" title="Select Level">
                                    <option selected>All Type</option>
                                    <option>votings</option>
                                    <option>Section</option>
                                </select>
                            </div> --}}

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
            <div class="row" id="types-grid">

                @include('document_types.include.types_grid', ['data' => $data])

            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>


@if(checkPersonPermission('add-type-3-0'))
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop"
    aria-hidden="false">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            {!!
            Form::open(['action','TypesController@add','id'=>'TypeFormData','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true])
            !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">document types <small class="text-muted">- Add</small> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                {{--<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                    <div class="alert-text">votings Already exists</div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                        </button>
                    </div>
                </div> --}}



                <div class="form-group">

                    {!! Form::label('type_name','Name: <span class="text-danger">*</span>',
                    ["class"=>"control-label"], false) !!}
                    {!! Form::text("type_name",null,["class"=>"form-control
                    alphanumeric".($errors->has('type_name')?" is-invalid":"")
                    ,"autofocus"
                    ,"placeholder"=>"Document Type Name"
                    ,"required"]) !!}

                    {{--<label>votings Name <span class="text-danger">*</span></label>
                    <input type="input" class="form-control" placeholder="Enter votings Name">
                    <span class="form-text text-muted">Examples:
                        GM Finance , Software Engineer, Senior Manager</span> --}}
                </div>


                <div class="form-group">

                    {{-- {!! Form::label('voting_icon','Icon: <span class="text-danger">*</span>',
                    ["class"=>"control-label"], false) !!}
                    {!! Form::text("voting_icon",null,["class"=>"form-control
                    alphanumeric".($errors->has('voting_icon')?" is-invalid":"")
                    ,"autofocus"
                    ,"placeholder"=>"voting icon"
                    ,"required"]) !!} --}}

                    {{--<label>votings Name <span class="text-danger">*</span></label>
                    <input type="input" class="form-control" placeholder="Enter votings Name">
                    <span class="form-text text-muted">Examples:
                        GM Finance , Software Engineer, Senior Manager</span> --}}
                </div>


                <div class="form-group justify-content-center row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Icon
                        <span class="text-primary font-size-h5">*</span>
                    </label>

                    <div class="col-lg-9 col-xl-6">
                        <div class="image-input image-input-outline" id="kt_image_1">
                            <div class="image-input-wrapper"
                                style="background-image: url(assets/media/users/blank.png)"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title="" data-original-title="Change icon">
                                <i class="fa fa-camera icon-sm text-muted"></i>
                                <input type="file" name="icon_path" id="icon_path">
                                <input type="hidden" name="type_icon_remove" value="0">
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel icon">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" id="add-types-button" class="btn btn-primary font-weight-bold">Add
                    Document Types</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endif
    @if(checkPersonPermission('update-type-3-0'))
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop"
            aria-hidden="false">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">document types <small class="text-muted">- Update</small> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">votings Already exists</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                </button>
                            </div>
                        </div> --}}

                        {!!
                        Form::open(['action','TypesController@update_type','id'=>'type_update_form','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true])
                        !!}

                        {{ Form::hidden('type_id',null, array('id' => 'type_id')) }}
                        <div class="form-group">

                            {!! Form::label('type_name','Name: <span class="text-danger">*</span>',
                            ["class"=>"control-label"], false) !!}
                            {!! Form::text("type_name",null,["class"=>"form-control
                            alphanumeric".($errors->has('type_name')?" is-invalid":"")
                            ,"autofocus"
                            ,"id"=>"update_type_name_field"
                            ,"placeholder"=>"Document type Name"
                            ,"required"]) !!}

                            {{-- <label>votings Name <span class="text-danger">*</span></label>
                            <input type="input" class="form-control" placeholder="Enter votings Name" value="Group(COO)"> --}}
                            <span class="form-text text-muted">Examples:
                                GM Finance , Software Engineer, Senior Manager</span>
                        </div>




                    </div>

                    <div class="form-group justify-content-center row">
                        <label class="col-xl-3 col-lg-3 col-form-label">icon
                            <span class="text-primary font-size-h5">*</span>
                        </label>

                        <div class="col-lg-9 col-xl-6">
                            <div class="image-input image-input-outline" id="kt_image_2">
                                <!-- Change the ID here -->
                                <div id="editpath"  class="image-input-wrapper" style="background-image: url(images)"></div>

                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title="" data-original-title="Change icon">
                                    <i class="fa fa-camera icon-sm text-muted"></i>
                                    <input type="file" name="icon_path" id="icon_path">
                                    <input type="hidden" name="type_icon_remove" value="0">
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel icon">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                            <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        <button type="button" id="update-types-button" class="btn btn-primary font-weight-bold">Update
                            Document Types</button>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    @endif
@if(checkPersonPermission('delete-type-3-0'))
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop"
    aria-hidden="false">
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
                        There are <code>four(4)</code> User using this voting, kindly make sure change them one by one
                        <code>OR</code> continue to delete by providing alternative Department.
                    </div>
                </div>

                <div class="alert alert-custom alert-light-success" role="alert">
                    <div class="alert-icon"><i class="flaticon-like text-success"></i></div>
                    <div class="alert-text">
                        There is no member using this voting, click delete to proceed.

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
            </div> --}}
            <div class="modal-body">
                Are you sure you want to delete this?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" id="delete-types-button" class="btn btn-danger font-weight-bold">Delete</button>
            </div>
        </div>
    </div>
</div>
@endif

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



       $('#type_form').bind("keypress", function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
        });


          /*Filer serach starts here*/
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
            //getting values here
            var search_sort_by = $('#search_sort_by').val();
            var search_by_type = $('#search_by_type').val();
            var search_by_name = $('#search_by_name').val();
            var search_by_members = $('#search_by_members').val();

            //search_by_members

            newLocation = "{{route('document_types.search')}}?order=" + search_sort_by + "&name=" + search_by_name;

            //Ajax code starts here
            $.ajax({
                type: "GET",
                url: newLocation,
                    success: function (data) {
                        console.log(data);
                            $("#types-grid").html(data.html);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            //Ajax code ends here
              /*   if (history.pushState) {
                    window.history.pushState({path:newLocation},'',newLocation);
                }
                return false; */
            }


       //add meeting urgency type starts here
       //$("#add-votings-button").on('submit',(function(event) {


  $('body').on('click', '#add-types-button', function (event) {
        event.preventDefault();
        // alert('data');

    // Append the file input to the FormData
                var iconPathInput = $('#icon_path')[0];
                var formData = new FormData(document.getElementById("TypeFormData"));

                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: "{{ route('document_types.add')}}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if(data.status === 200){
                        var message = data.message
                        Swal.fire("Added!", message, "success");
                        $("#kt_content").load(location.href + " #kt_content>*", "");
                        $('#exampleModal').modal('toggle');
                        $('#TypeFormData').trigger("reset");
                        $("#exampleModal").load(location.href + " #exampleModal>*", "");

                        }
                    if(data.status === 400){
                        var error = data.message
                        var array = $.map(error, function(value, index) {  return [value]; });
                        let list = '';
                        for (var i = 0; i < array.length; i++)
                        list += array[i] + '\n';
                        Swal.fire("Error!",list, "error");

                        setTimeout(function() {
                            $("#types-grid").load(location.href + " #types-grid>*", "");
                        }, 2000);

                        $('#exampleModal').modal('toggle');
                        $('#type_form').trigger("reset");
                    }
                    if(data.status === 409){
                        var error = data.message
                        Swal.fire("Error!", error, "error");
                        $('#exampleModal').modal('toggle');
                        $('#type_form').trigger("reset");
                    }
                    //Permission error
                    if(data.status === 401){
                        var error = data.message
                        Swal.fire("Error!", error, "error");
                        $('#exampleModal').modal('toggle');
                        $('#type_form').trigger("reset");
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                        Swal.fire("Error!", error, "error");
                        $('#exampleModal').modal('toggle');
                        $('#type_form').trigger("reset");
                    }
              });
         });
         //Add meeting urgency type ends here

           //Edit member urgency type starts here
        $('body').on('click', '#type-edit', function (event) {
                event.preventDefault();
                var id = $(this).data("id");
                console.log(id);
                        $.ajax({
                        type: "get",
                        url: SITEURL + "/document_types/get/"+id,
                        dataType: 'json',
                            success:function(data){
                                $('#type_update_form').trigger("reset");
                                var fileName = data.icon_path;
                                var divId = "editpath";
                                $('#' + divId).css('background-image', 'url(images/' + fileName + ')');
                                $("#example2ModalLabel").html(data.name + data.name + '- update');
                                $('.alphanumeric').keyup(function() {
                                        if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
                                            this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
                                        }
                                        });

                                    $('.alphanumeric').focusout(function() {
                                    this.value = this.value.trim();
                                    });
                                $("#update_type_name_field").val(data.name);
                                // $("#update_parent_id_field").val(data.parent_id);
                                $('#type_id').val(data.id);

                            },
                            error: function (data) {F
                            console.log('Error:', data);
                            }
                    });
          });
         //Edit member urgency type ends here

          //update function starts here
          $('body').on('click', '#update-types-button', function (event) {
    event.preventDefault();

    var formData = new FormData($('#type_update_form')[0]);

    $.ajax({
        data: formData,
        url: "{{ route('document_types.update')}}",
        type: "POST",
        dataType: 'json',
        processData: false,  // Important: prevent jQuery from processing the data
        contentType: false,  // Important: ensure the content type is false
        success: function (data) {
            if (data.status === 200) {
                var message = data.message;
                Swal.fire("Updated!", message, "success");

                setTimeout(function () {
                    $("#types-grid").load(location.href + " #types-grid>*", "");
                }, 2000);

                $('#exampleModal2').modal('toggle');
            }
            if (data.status === 400) {
                var error = data.message
                var array = $.map(error, function (value, index) { return [value]; });
                let list = '';
                for (var i = 0; i < array.length; i++)
                    list += array[i] + '\n';
                Swal.fire("Error!", list, "error");

                setTimeout(function () {
                    $("#types-grid").load(location.href + " #types-grid>*", "");
                }, 2000);

                $('#exampleModal2').modal('toggle');
            }
            if (data.status === 409) {
                var error = data.message
                Swal.fire("Error!", error, "error");
            }
            // Permission error
            if (data.status === 401) {
                var error = data.message
                Swal.fire("Error!", error, "error");
                $('#exampleModal').modal('toggle');
                $('#type_form').trigger("reset");
            }
        },
        error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                        Swal.fire("Error!", error, "error");
                        // $('#exampleModal').modal('toggle');
                        $('#type_form').trigger("reset");
                    }
    });
});

            //update function ends here


             //Delete functiion starts here
             $('body').on('click', '#type-delete', function (event) {
                event.preventDefault();
                var id = $(this).data("id");
                $("#delete-types-button").unbind().click(function() {
                $.ajax({
                        type: "delete",
                        url: SITEURL + "/document_types/delete/"+id,
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
                                    $("#types-grid").load(location.href + " #types-grid>*", "");
                                    }, 2000);

                                    $('#exampleModal3').modal('toggle');
                                }
                                //Permission error
                                if(data.status === 401){
                                    var error = data.message
                                    Swal.fire("Error!", error, "error");
                                    $('#exampleModal').modal('toggle');
                                    $('#type_form').trigger("reset");
                                }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
            });

            });
            //Delete function ends here


            //Allow Alphanumeric Add checks
            /* $(".alphanumeric").keydown(function (e){
                    var k = e.keyCode || e.which;
                    var ok = k >= 65 && k <= 90 || // A-Z
                        k >= 96 && k <= 105 || // a-z
                        k >= 35 && k <= 40 || // arrows
                        k == 9 || //tab
                        k == 46 || //del
                        k == 8 || // backspaces
                        (!e.shiftKey && k >= 48 && k <= 57); // only 0-9 (ignore SHIFT options)

                    if(!ok || (e.ctrlKey && e.altKey)){
                        e.preventDefault();
                    }
                }); */

    //Allow Alphanumeric Add checks ends
    $('.alphanumeric').keyup(function() {
        if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
            this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
        }
        });

    $('.alphanumeric').focusout(function() {
    this.value = this.value.trim();
    });


});
</script>
@endsection
