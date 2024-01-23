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
                    @include('include.member_menu')
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->

                <div class="d-flex align-items-center flex-wrap mr-2">
                <div class="">
                    <a href="#" class="addoc btn btn-light-primary font-weight-bolder btn-sm mr-3"
                       data-toggle="modal" data-target="#exampleModal"
                    >Add User</a>
                </div>

                <div class="">
                    <a href="#" class="btn btn-light-primary font-weight-bolder btn-sm mr-3"
                       data-toggle="modal" data-target="#exampleModalUsers"
                    >Import users</a>
                </div>

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
                            <span class="font-weight-bolder text-dark font-size-h3-lg">Users
                                <span class="text-muted font-size-h5-lg">- Listing</span>
                            </span>
                        </div>

                    </div>
                    <div class="text-primary mt-3 d-inline font-weight-bold font-size-base mr-5 col-smjustify-content-end">Total {{$total_count}}</div>


                </div>

                <div class="dropdown-container">
                <button class="btn btn-light-dark btn-sm custom-offcanvas-open mb-5 d-xxl-none" data-target="custom-offcanvas"><i class="flaticon-cogwheel-2 icon-md " ></i> Filers</button>

                <div class="row sub-line" >
                    <div class="col-sm-12 justify-content-end offcanvas offcanvas-left offcanvas-off custom no-background" id="custom-offcanvas" >
                        <button class="btn btn-light-dark btn-icon btn-sm custom-offcanvas-close custom-offcanvas-close-btn d-xxl-none  " data-target="custom-offcanvas"><i class="flaticon2-cross icon-md " ></i></button>
                        <div class="row" >
                            <div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-9 text-right">
                                    <div class="mr-3 pt-3 pt-1 font-size-lg d-inline"><strong>Sort By:</strong></div>
                                    <div class="d-inline" >
                                        <select  class="selectpicker w-150px" id="search_sort_by" title="Select Level">
                                            <option >A - Z </option>
                                            <option >Z - A</option>
                                            <option selected>Recent added</option>
                                        </select>
                                    </div>


                                <div class="mr-3 ml-5 pt-3 pt-1 font-size-lg d-inline"><strong>Filters:</strong></div>

                                <div class="d-inline" >
                                    {{Form::select(
                                        'organization',
                                        $selectBoxes['organizations'],
                                        null,
                                         [
                                        "class" => "selectpicker w-150px",
                                        "title" => "Select Organization",
                                        "id" => "search_by_organization"
                                        ]
                                       )
                                    }}
                                </div>
                                <div class="d-inline">
                                    {{Form::select(
                                        'department',
                                        $selectBoxes['departments'],
                                        null,
                                       [
                                           "class" => "selectpicker w-150px",
                                           "title" => "Select Department",
                                           "id"=>"search_by_department"
                                       ])
                                    }}
                                </div>
                                <div class="d-inline">
                                    {{Form::select(
                                        'designation',
                                        $selectBoxes['designations'],
                                        null,
                                       [
                                           "class" => "selectpicker w-150px",
                                            "title" => "Select Designation",
                                            "id"=>"search_by_designation"
                                       ])
                                       }}
                                </div>
                                <div class="d-inline" >
                                    <select class="selectpicker w-150px" id="search_by_status" title="Select Status">
                                        <option >All</option>
                                        <option >Active</option>
                                        <option >Inactive</option>
                                    </select>
                                </div>


                            </div>
                            <div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-3">
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
                <div class="row" id="members-grid" >
                    @include('member.include.members_grid', ['data' => $data])
                </div>

            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

    @include('member.modals.create')
    @include('member.modals.update')
    @include('member.modals.delete')
    @include('member.modals.status')
    @include('member.modals.import')



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

    //Route::get('/get/{order}/{type}/{organization}/{department}/{designation}/{status}/{name}', [MembersController::class, 'index'])->name('members.filter.search');
    /*Filer serach starts here*/
    $('#search_button').click(function (event) {

        event.preventDefault();
        //getting values here
        var search_sort_by = $('#search_sort_by').val();
        var search_by_type = $('#search_by_type').val();

        var search_by_organization = $('#search_by_organization').val();
        var search_by_department = $('#search_by_department').val();
        var search_by_designation = $('#search_by_designation').val();

        var search_by_status = $('#search_by_status').val();
        var search_by_name = $('#search_by_name').val();

        newLocation = "{{route('members.search')}}?order=" + search_sort_by +  "&organization=" + search_by_organization +  "&department=" + search_by_department + "&designation=" + search_by_designation +  "&status=" + search_by_status + "&name=" + search_by_name;

        //Ajax code starts here
        $.ajax({
            type: "GET",
            url: newLocation,
                success: function (data) {
                    console.log(data);
                        $("#members-grid").html(data.html);
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
        });

    $('body').on('click', '#importUsersFile', function (event) {
      event.preventDefault();
      var form_data = new FormData(document.getElementById("usersImportForm"));
            $.ajax({
                    data: form_data,
                    url: "{{ route('member.import')}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 200){
                        var message = data.message
                        Swal.fire("Added!", message, "success");
                        $("#members-grid").load(location.href + " #members-grid>*", "");
                        $('#exampleModalUsers').modal('toggle');
                        $('#usersImportForm').trigger("reset");
                        }
                    if(data.status === 400){
                        var error = data.message
                        var array = $.map(error, function(value, index) {  return [value]; });
                        let list = '';
                        for (var i = 0; i < array.length; i++)
                        list += array[i] + '\n <br>';
                        Swal.fire("Error!",list, "error");
                        $("#members-grid").load(location.href + " #members-grid>*", "");
                    }
                    if(data.status === 409){
                        var error = data.message
                        Swal.fire("Error!", error, "error");
                        $('#exampleModalUsers').modal('toggle');
                        $('#usersImportForm').trigger("reset");
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data.responseText);
                       var error = data.responseText
                        Swal.fire("Error!", error, "error");
                    }
              });
    });

    //Create member function starts here
    $('body').on('click', '#add-member-button', function (event) {
      event.preventDefault();
            //Ajax code starts here
            var form_data = new FormData(document.getElementById("member_form"));
             console.log(form_data);
            $.ajax({
                    data: form_data,
                    url: "{{ route('member.add')}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 200){
                        var message = data.message
                        Swal.fire("Added!", message, "success");
                        $("#kt_content").load(location.href + " #kt_content>*", "");
                        $('#exampleModal').modal('toggle');
                        $('#member_form').trigger("reset");
                        }
                    if(data.status === 400){
                        var error = data.message
                        var array = $.map(error, function(value, index) {  return [value]; });
                        let list = '';
                        for (var i = 0; i < array.length; i++)
                        list += array[i] + '\n <br>';
                        Swal.fire("Error!",list, "error");
                        $("#members-grid").load(location.href + " #members-grid>*", "");
                        //$('#exampleModal').modal('toggle');
                        //$('#member_form').trigger("reset");
                    }
                    if(data.status === 409){
                        var error = data.message
                        Swal.fire("Error!", error, "error");
                        $('#exampleModal').modal('toggle');
                        $('#member_form').trigger("reset");
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
    //Create member function ends here

    //Delete member function starts here
    $('body').on('click', '#delete-member', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        //delete-member-button
        $("#delete-member-button").unbind().click(function() {
          //Ajax code starts here
          $.ajax({
                type: "delete",
                url: SITEURL + "/members/delete/"+id,
                success: function (data) {
                        if(data.status === 200){
                            var message = data.message;
                            $("#kt_content").load(location.href + " #kt_content>*", "");
                            Swal.fire("Deleted!", message, "success");
                            $('#exampleModal3').modal('toggle');}
                        if(data.status === 400){
                            var error = data.message
                            Swal.fire("Error!",error, "error");
                            $("#members-grid").load(location.href + " #members-grid>*", "");
                            $('#exampleModal3').modal('toggle');
                        }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
           });
          //Ajax code ends here
        });
    });
    //Delete member function ends here


    $('body').on('click', '#change-status', function (event) {
        event.preventDefault();
        var member_id = $(this).data("id");

        $("#change-status-to-active,#change-status-to-inactive").unbind().click(function() {
            var status = $(this).data("id");
            //Ajax call starts here
            $.ajax({
            url: "{{ route('change_member.status')}}",
            type:"POST",
            dataType: 'json',
            data:{
                member_id:member_id,
                status:status,
            },
            success:function(data){
                if(data.status === 200){
                        var message = data.message
                        Swal.fire("Added!", message, "success");
                        $("#refresh").load(location.href + " #refresh>*", "");
                }
                if(data.status === 400){
                         console.log(data);
                         var error = data.message
                         Swal.fire("Error!",error, "error");
                        }
                 $('.modal').modal('hide') // closes all active pop ups.
            },
            error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                        Swal.fire("Error!", error, "error");
                    },
            });
            //Ajax call ends here
        });

    });



});
</script>


@endsection
