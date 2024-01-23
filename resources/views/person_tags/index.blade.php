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
                           Add Person Tag
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
                            <span class="font-weight-bolder text-dark font-size-h3-lg">Person Tags
                                <span class="text-muted font-size-h5-lg">- Listing</span>
                            </span>
                        </div>

                    </div>

                    <div class="text-primary mt-3 d-inline font-weight-bold font-size-base mr-5 col-smjustify-content-end">Total {{ $total_count }}</div>


                </div>

                <div class="dropdown-container">
                <button class="btn btn-light-dark btn-sm custom-offcanvas-open mb-5 d-xxl-none" data-target="custom-offcanvas"><i class="flaticon-cogwheel-2 icon-md " ></i> Filers</button>
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

                <div class="row" id="person-tags-grid">
                  @include('person_tags.ajax.person_tags_grid')
                </div>


            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

    @if(checkPersonPermission('add-person-tags-3-0'))
        <div class="modal fade" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Person Tags<small class="text-muted">- Add</small> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="add-person-tags-modal-body" id="add-person-tags-modal-body">
                    </div>

                    {{-- Form starts here --}}
                    {!! Form::open(['action','PersonTagsController@create','id'=>'person-tags_form','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                    <div class="form-group">
                        {!! Form::label('tag_name','Tag Name: <span class="text-danger">*</span>', ["class"=>"control-label"], false) !!}
                        {!! Form::text("tag_name",null,["class"=>"form-control alphanumeric".($errors->has('tag_name')?" is-invalid":"")
                        ,"autofocus"
                        ,"placeholder"=>"Enter Person Tag Name"
                        ,"required"]) !!}
                        <span class="form-text text-muted">Examples:
                                                            Senior Management, Lower Staff</span>
                    </div>
                    {!! Form::close() !!}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="button" id="add-person-tags-submit" class="btn btn-primary font-weight-bold">Add Person Tag</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(checkPersonPermission('update-person-tags-3-0'))
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

                    {!! Form::open(['action','Person TagsController@update_person-tags','id'=>'person-tags_update','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                    {{ Form::hidden('tags_id',null, array('id' => 'person-tags_id')) }}
                    <div class="form-group">
                        {!! Form::label('person-tags_name','Person Tag Name: <span class="text-danger">*</span>', ["class"=>"control-label"], false) !!}
                        {!! Form::text("tag_name",null,["class"=>"form-control alphanumeric".($errors->has('tag_name')?" is-invalid":"")
                        ,"autofocus"
                        ,"id" => "person-tags_name_field_modal"
                        ,"placeholder"=>"Enter Person Tag Name"
                        ,"required"]) !!}

                        <span class="form-text text-muted">Examples:
                    </div>
                    {!! Form::close() !!}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="button" id="person-tags-update" class="btn btn-primary font-weight-bold">Update Person Tag</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(checkPersonPermission('delete-person-tags-3-0'))
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
                            There is no member using this person-tags, click delete to proceed.

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
                    <button type="button" id="delete-person-tags-button" class="btn btn-danger font-weight-bold">Delete</button>
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

            //getting values here
            function performSearch() {
            var search_sort_by = $('#search_sort_by').val();
            var search_by_type = $('#search_by_type').val();
            var search_by_name = $('#search_by_name').val();

            //newLocation = "{{route('person.tags.index')}}?order=" + search_sort_by + "&type=" + search_by_type + "&name=" + search_by_name;
            newLocation = "{{route('person.tags.search')}}?order=" + search_sort_by + "&name=" + search_by_name;
            //Ajax code starts here
            $.ajax({
                  type: "GET",
                  url: newLocation,
                    success: function (data) {
                        console.log(data);
                            $("#person-tags-grid").html(data.html);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
               //Ajax code ends here
               /*   if (history.pushState) {
                    window.history.pushState({path:newLocation},'',newLocation);
                }
                return false;   */
            }

    //add person-tags starts here
    $('body').on('click', '#add-person-tags-submit', function (event) {
        event.preventDefault();

         $.ajax({
            data: $('#person-tags_form').serialize(),
            url: "{{ route('person.tags.add')}}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if(data.status === 200){
                Swal.fire("Added!", "Person Tag Added Successfully!", "success");

                $("#kt_content").load(location.href + " #kt_content>*", "");

                $('#exampleModal').modal('toggle');
                $('#person-tags_form').trigger("reset");
                }
            if(data.status === 400){
                Swal.fire("Error!", "Please Provide Person Tag name", "error");

                setTimeout(function() {
                    $("#person-tags-grid").load(location.href + " #person-tags-grid>*", "");
                                    }, 2000);

                $('#exampleModal').modal('toggle');
                $('#person-tags_form').trigger("reset");
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
    //Add person-tags ends here

    //Edit person-tags starts here
    $('body').on('click', '.person-tags-edit', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
                $.ajax({
                type: "get",
                url: SITEURL + "/person-tags/get/"+id,
                dataType: 'json',
                    success:function(data){
                        $('#person-tags_update').trigger("reset");
                        $("#example2ModalLabel").html(data.tag_name + '- update');
                        $('.alphanumeric').keyup(function() {
                                        if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
                                            this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
                                        }
                                        });

                                    $('.alphanumeric').focusout(function() {
                                    this.value = this.value.trim();
                                    });
                        $("#person-tags_name_field_modal").val(data.tag_name);
                        $('#person-tags_id').val(data.id);
                    },
                    error: function (data) {
                    console.log('Error:', data);
                    }
                });
    });
    //Edit person-tags ends here

     //Update person-tags method starts here
     $('body').on('click', '#person-tags-update', function (event) {
        event.preventDefault();
        $.ajax({
            data: $('#person-tags_update').serialize(),
            url: "{{ route('person.tags.update')}}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if(data.status === 200){
                Swal.fire("Added!", "Person Tag Updated Successfully!", "success");

                setTimeout(function() {
                    $("#person-tags-grid").load(location.href + " #person-tags-grid>*", "");
                                    }, 2000);

                $('#exampleModal2').modal('toggle');
                }
            if(data.status === 400){
                Swal.fire("Error!", "Please Provide Person Tag name!", "error");

                setTimeout(function() {
                    $("#person-tags-grid").load(location.href + " #person-tags-grid>*", "");
                                    }, 2000);

                $('#exampleModal2').modal('toggle');
            }
            },
            error: function (data) {
            console.log('Error:', data);
            }
         });
     });
     //Update person-tags method ends here

    //Delete person-tags starts here
    $('body').on('click', '.person-tags-delete', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
                console.log(id);

                //
                $("#delete-person-tags-button").unbind().click(function() {
                $.ajax({
                        type: "delete",
                        url: SITEURL + "/person-tags/delete/"+id,
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
                                          $("#person-tags-grid").load(location.href + " #person-tags-grid>*", "");
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
    //Delete person-tags ends here

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
