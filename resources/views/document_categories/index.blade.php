@extends('layout.master')
@section('content')

<style>
    /* Include the style here if not using a separate CSS file */
    .selectpicker {
        z-index: 1001 !important;
    }

    .dropdown-container {
        position: relative;
        z-index: 1001 !important;
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
                @if(checkPersonPermission('add-categories-3-0'))
                    <div class="d-flex align-items-center">
                        <a href="#" class="addoc btn btn-light-primary font-weight-bolder btn-sm"
                           data-toggle="modal" data-target="#exampleModal"
                        >Add Category</a>
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
                            <span class="font-weight-bolder text-dark font-size-h3-lg">Categories
                                <span class="text-muted font-size-h5-lg">- Listing</span>
                            </span>
                        </div>

                    </div>
                    <div class="text-primary mt-3 d-inline font-weight-bold font-size-base mr-5 col-smjustify-content-end">Total {{$total_count}}</div>


                </div>
                <div class="dropdown-container">
                <button class="btn btn-light-dark btn-sm custom-offcanvas-open mb-5 d-xxl-none" data-target="custom-offcanvas"><i class="flaticon-cogwheel-2 icon-md " ></i> Filters</button>
                <div class="row sub-line">
                    <div class="col-sm-12 justify-content-end offcanvas offcanvas-left offcanvas-off custom  no-background" id="custom-offcanvas">
                        <button class="btn btn-light-dark btn-icon btn-sm custom-offcanvas-close custom-offcanvas-close-btn d-xxl-none " data-target="custom-offcanvas"><i class="flaticon2-cross icon-md " ></i></button>
                        <div class="row">
                            <div class="col-xxl-8 col-xl-12 text-right " >
                                    <div class="mr-3 pt-3 pt-1 font-size-lg d-inline"><strong>Sort By:</strong></div>
                                    <div class="d-inline">
                                        <select class="selectpicker w-150px" id="search_sort_by" title="Select Level">
                                            <option >A - Z </option>
                                            <option >Z - A</option>
                                            <option selected>Recent added</option>
                                        </select>
                                    </div>




                                {{-- <div class="d-inline">
                                    <select class="selectpicker w-150px" id="search_by_members"  title="Select Level">
                                        <option selected>All User</option>
                                        <option >Has Users</option>
                                        <option >No User</option>
                                    </select>
                                </div>


                                <div class="d-inline">
                                    <select class="selectpicker w-150px" id="search_by_type"  title="Select Level">
                                        <option selected>All Type</option>
                                        <option >Categories</option>
                                        <option >Section</option>
                                    </select>
                                </div> --}}

                            </div>


                            <div class="col-xxl-4 col-xl-12">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search_by_name"  placeholder="Search for...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" id="search_button" type="button">Go!</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                </div>

                </div>

                <div class="row" id="categories-grid">

                    @include('document_categories.include.categories_grid', ['data' => $data])

                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>


    @if(checkPersonPermission('add-categories-3-0'))
        <div class="modal fade" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Category <small class="text-muted">- Add</small> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{--<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Categories Already exists</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                            </button>
                        </div>
                    </div>  --}}

                    {!! Form::open(['action','CategoriesController@add','id'=>'categories_form','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}

                    <div class="form-group">

                        {!! Form::label('categories_name','Name: <span class="text-danger">*</span>', ["class"=>"control-label"], false) !!}
                        {!! Form::text("categories_name",null,["class"=>"form-control alphanumeric".($errors->has('categories_name')?" is-invalid":"")
                        ,"autofocus"
                        ,"placeholder"=>"Category Name"
                        ,"required"]) !!}

                        {{--<label>Categories Name <span class="text-danger">*</span></label>
                        <input type="input" class="form-control" placeholder="Enter Categories Name">
                        <span class="form-text text-muted">Examples:
                                                            GM Finance , Software Engineer, Senior Manager</span>  --}}
                    </div>
                    {!! Form::close() !!}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="button" id="add-categories-button" class="btn btn-primary font-weight-bold">Add Category</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(checkPersonPermission('update-categories-3-0'))
        <div class="modal fade" id="exampleModal2"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example2ModalLabel"><small class="text-muted"></small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                   {{-- <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Categories Already exists</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                            </button>
                        </div>
                    </div>  --}}

                    {!! Form::open(['action','CategoriesController@update_categories','id'=>'categories_update_form','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                    {{ Form::hidden('categories_id',null, array('id' => 'categories_id')) }}
                    <div class="form-group">

                        {!! Form::label('categories_name','Name: <span class="text-danger">*</span>', ["class"=>"control-label"], false) !!}
                        {!! Form::text("categories_name",null,["class"=>"form-control alphanumeric".($errors->has('categories_name')?" is-invalid":"")
                        ,"autofocus"
                        ,"id"=>"update_categories_name_field"
                        ,"placeholder"=>"Category Name"
                        ,"required"]) !!}

                       {{-- <label>Categories Name <span class="text-danger">*</span></label>
                        <input type="input" class="form-control" placeholder="Enter categories Name" value="Group(COO)"> --}}
                        {{-- <span class="form-text text-muted">Examples:
                                                            GM Finance , Software Engineer, Senior Manager</span> --}}
                    </div>


                    {!! Form::close() !!}

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="button" id="update-categories-button" class="btn btn-primary font-weight-bold">Update Category</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(checkPersonPermission('delete-categories-3-0'))
        <div class="modal fade" id="exampleModal3"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
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
                            There are <code>four(4)</code> User using this category, kindly make sure change them one by one <code>OR</code> continue to delete by providing alternative Department.
                        </div>
                    </div>

                    <div class="alert alert-custom alert-light-success" role="alert">
                        <div class="alert-icon"><i class="flaticon-like text-success"></i></div>
                        <div class="alert-text">
                            There is no member using this category, click delete to proceed.

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
                </div>     --}}
                <div class="modal-body">
                Are you sure you want to delete this?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="button" id="delete-categories-button" class="btn btn-danger font-weight-bold">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @endif

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



       $('#categories_form').bind("keypress", function(e) {
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

          $('#search_by_name').keydown(function (event) {
        if (event.keyCode === 13) { // Check if the pressed key is Enter (key code 13)
            performSearch();
        }
    });

            //getting values here
            function performSearch() {
            var search_sort_by = $('#search_sort_by').val();
            var search_by_name = $('#search_by_name').val();
            //search_by_members
            newLocation = "{{route('document_categories.search')}}?order=" + search_sort_by + "&name=" + search_by_name ;
            //Ajax code starts here
            $.ajax({
                type: "GET",
                url: newLocation,
                    success: function (data) {
                        console.log(data);
                            $("#categories-grid").html(data.html);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
            //Ajax code ends here
              /*   if (history.pushState) {
                    window.history.pushState({path:newLocation},'',newLocation);
                }
                return false; */



       //add meeting urgency type starts here
       $('body').on('click', '#add-categories-button', function (event) {
                event.preventDefault();
                $.ajax({
                    data: $('#categories_form').serialize(),
                    url: "{{ route('document_categories.add')}}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if(data.status === 200){
                        var message = data.message
                        Swal.fire("Added!", message, "success");

                        $("#kt_content").load(location.href + " #kt_content>*", "");

                        $('#exampleModal').modal('toggle');
                        $('#categories_form').trigger("reset");
                        }
                    if(data.status === 400){
                        var error = data.message
                        var array = $.map(error, function(value, index) {  return [value]; });
                        let list = '';
                        for (var i = 0; i < array.length; i++)
                        list += array[i] + '\n';
                        Swal.fire("Error!",list, "error");

                        setTimeout(function() {
                            $("#categories-grid").load(location.href + " #categories-grid>*", "");
                        }, 2000);

                        $('#exampleModal').modal('toggle');
                        $('#categories_form').trigger("reset");
                    }
                    if(data.status === 409){
                        var error = data.message
                        Swal.fire("Error!", error, "error");
                        $('#exampleModal').modal('toggle');
                        $('#categories_form').trigger("reset");
                    }
                    //Permission error
                    if(data.status === 401){
                        var error = data.message
                        Swal.fire("Error!", error, "error");
                        $('#exampleModal').modal('toggle');
                        $('#categories_form').trigger("reset");
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                        Swal.fire("Error!", error, "error");
                        $('#exampleModal').modal('toggle');
                        $('#categories_form').trigger("reset");
                    }
              });
         });
         //Add meeting urgency type ends here

           //Edit member urgency type starts here
        $('body').on('click', '#categories-edit', function (event) {
                event.preventDefault();
                var id = $(this).data("id");
                console.log(id);
                        $.ajax({
                        type: "get",
                        url: SITEURL + "/document_categories/get/"+id,
                        dataType: 'json',
                            success:function(data){
                                $('#categories_update_form').trigger("reset");
                                $("#example2ModalLabel").html(data.name + '- update');
                                $('.alphanumeric').keyup(function() {
                                        if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
                                            this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
                                        }
                                        });

                                    $('.alphanumeric').focusout(function() {
                                    this.value = this.value.trim();
                                    });
                                $("#update_categories_name_field").val(data.name);
                                // $("#update_parent_id_field").val(data.parent_id);
                                $('#categories_id').val(data.id);
                            },
                            error: function (data) {
                            console.log('Error:', data);
                            }
                    });
          });
         //Edit member urgency type ends here

          //update function starts here
        $('body').on('click', '#update-categories-button', function (event) {
                event.preventDefault();
                console.log($('#categories_update_form').serialize());
                $.ajax({
                    data: $('#categories_update_form').serialize(),
                    url: "{{ route('document_categories.update')}}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if(data.status === 200){
                        var message = data.message;
                        Swal.fire("Updated!", message, "success");

                        setTimeout(function() {
                            $("#categories-grid").load(location.href + " #categories-grid>*", "");
                        }, 2000);

                        $('#exampleModal2').modal('toggle');}
                    if(data.status === 400){
                        var error = data.message
                        var array = $.map(error, function(value, index) {  return [value]; });
                        let list = '';
                        for (var i = 0; i < array.length; i++)
                        list += array[i] + '\n';
                        Swal.fire("Error!",list, "error");

                        setTimeout(function() {
                            $("#categories-grid").load(location.href + " #categories-grid>*", "");
                        }, 2000);

                        $('#exampleModal2').modal('toggle');
                    }
                    if(data.status === 409){
                        var error = data.message
                        Swal.fire("Error!", error, "error");
                    }
                    //Permission error
                    if(data.status === 401){
                    var error = data.message
                    Swal.fire("Error!", error, "error");
                    $('#exampleModal').modal('toggle');
                    $('#categories_form').trigger("reset");
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data);
                    }
                });
            });
            //update function ends here


             //Delete functiion starts here
             $('body').on('click', '#categories-delete', function (event) {
                event.preventDefault();
                var id = $(this).data("id");
                $("#delete-categories-button").unbind().click(function() {
                $.ajax({
                        type: "delete",
                        url: SITEURL + "/document_categories/delete/"+id,
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
                                    $("#categories-grid").load(location.href + " #categories-grid>*", "");
                                    }, 2000);

                                    $('#exampleModal3').modal('toggle');
                                }
                                //Permission error
                                if(data.status === 401){
                                    var error = data.message
                                    Swal.fire("Error!", error, "error");
                                    $('#exampleModal').modal('toggle');
                                    $('#categories_form').trigger("reset");
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
