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

                <div class="d-flex align-items-center">
                    <a href="#" class="btn btn-light-primary font-weight-bolder btn-sm mr-3"
                       data-toggle="modal" data-target="#exampleModal"
                    >Add Survey</a>
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
                            <span class="font-weight-bolder text-dark font-size-h3-lg">Survey
                                <span class="text-muted font-size-h5-lg">- Listing</span>
                            </span>
                        </div>

                    </div>
                    <div class="text-primary mt-3 d-inline font-weight-bold font-size-base mr-5 col-smjustify-content-end">Total {{$data->count()}}</div>


                </div>
                <div class="dropdown-container">
                <button class="btn btn-light-dark btn-sm custom-offcanvas-open mb-5 d-xxl-none" data-target="custom-offcanvas"><i class="flaticon-cogwheel-2 icon-md " ></i> Filters</button>

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
                <div class="row" id="survey-grid" >
                    @include('survey.include.survey_grid', ['data' => $data])
                </div>

            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    @include('survey.modals.create')
    @include('survey.modals.update')
    @include('survey.modals.delete')
    @include('survey.modals.status')


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
        }


    $('body').on('click', '#add-button', function (event) {
      event.preventDefault();
            //Ajax code starts here
            var form_data = new FormData(document.getElementById("survey_form"));
             console.log(form_data);
            $.ajax({
                    data: form_data,
                    url: "{{ route('survey.add')}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 200){
                        var message = data.message
                        Swal.fire("Added!", message, "success");
                        $("#survey-grid").load(location.href + " #survey-grid>*", "");
                        $('#exampleModal').modal('toggle');
                        $('#survey_form').trigger("reset");
                        }
                    if(data.status === 400){
                        var error = data.message
                        var array = $.map(error, function(value, index) {  return [value]; });
                        let list = '';
                        for (var i = 0; i < array.length; i++)
                        list += array[i] + '\n <br>';
                        Swal.fire("Error!",list, "error");
                        $("#survey-grid").load(location.href + " #survey-grid>*", "");
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


    $('body').on('click', '.update-button', function (event) {
          event.preventDefault();
          //Ajax code starts here
          id = $(this).data('id');
          $.ajax({
              url: SITEURL + "/survey/"+id,
              type: "get",
              dataType: 'json',
              cache:false,
              contentType: false,
              processData: false,
              success: function (data) {
                  if(data.status === 200){
                          $('#survey_name').val(data.survey.name);
                          $('#short_description').val(data.survey.short_description);
                          $('#long_description2').val(data.survey.long_description);
                          $('#start_date').val(data.survey.start_date);
                          $('#end_date').val(data.survey.end_date);
                          $('#survey_id').val(data.survey.id);

                          $('#exampleModal2').modal('show');

                  }
                  if(data.status === 400){
                      var error = data.message
                      var array = $.map(error, function(value, index) {  return [value]; });
                      let list = '';
                      for (var i = 0; i < array.length; i++)
                          list += array[i] + '\n <br>';
                      Swal.fire("Error!",list, "error");
                      $("#survey-grid").load(location.href + " #survey-grid>*", "");
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



    $('body').on('click', '#delete-survey', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        //delete-member-button
        $("#delete-button").unbind().click(function() {
          //Ajax code starts here
          $.ajax({
                type: "delete",
                url: SITEURL + "/survey/delete/"+id,
                success: function (data) {
                        if(data.status === 200){
                            var message = data.message;
                            Swal.fire("Deleted!", message, "success");
                            $("#survey-grid").load(location.href + " #survey-grid>*", "");
                            $('#exampleModal3').modal('toggle');}
                        if(data.status === 400){
                            var error = data.message
                            Swal.fire("Error!",error, "error");
                            $("#survey-grid").load(location.href + " #survey-grid>*", "");
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

    $('body').on('click', '#change-status', function (event) {
        event.preventDefault();
        var id = $(this).data("id");

        $("#change-status-to-active,#change-status-to-inactive").unbind().click(function() {
            var status = $(this).data("id");
            //Ajax call starts here
            $.ajax({
            url: "{{ route('change_survey.status')}}",
            type:"POST",
            dataType: 'json',
            data:{
                id:id,
                status:status,
            },
            success:function(data){
                if(data.status === 200){
                        var message = data.message
                        Swal.fire("Status Changed!", message, "success");
                        $("#survey-grid").load(location.href + " #survey-grid>*", "");
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
