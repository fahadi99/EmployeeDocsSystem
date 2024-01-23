@extends('layout.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    @include('include.setting_menu')

                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                @if(checkPersonPermission('add-domain-3-0'))
                    <div class="d-flex align-items-center">
                        <a href="#" class="btn btn-light-primary font-weight-bolder btn-sm"
                           data-toggle="modal" data-target="#exampleModal"
                          >Add Domain</a>
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
                            <span class="font-weight-bolder text-dark font-size-h3-lg">Domain
                                <span class="text-muted font-size-h5-lg">- Listing</span>
                            </span>
                        </div>

                    </div>
                    <div class="text-primary mt-3 d-inline font-weight-bold font-size-base mr-5 col-smjustify-content-end">Total {{$total_count}}</div>


                </div>
                {{-- <button class="btn btn-light-dark btn-sm custom-offcanvas-open mb-5 d-xxl-none" data-target="custom-offcanvas"><i class="flaticon-cogwheel-2 icon-md " ></i> Filers</button>
                <div class="row sub-line">
                    <div class="col-sm-12 justify-content-end offcanvas offcanvas-left offcanvas-off custom  no-background" id="custom-offcanvas">
                        <button class="btn btn-light-dark btn-icon btn-sm custom-offcanvas-close custom-offcanvas-close-btn d-xxl-none " data-target="custom-offcanvas"><i class="flaticon2-cross icon-md " ></i></button>
                        <div class="row">
                            <div class="col-xxl-8 col-xl-12 text-right " >
                                    <div class="mr-3 pt-3 pt-1 font-size-lg d-inline"><strong>Sort By:</strong></div>
                                    <div class="d-inline">
                                        <select class="selectpicker w-150px"  title="Select Level">
                                            <option >A - Z </option>
                                            <option >Z - A</option>
                                            <option selected>Recent added</option>
                                        </select>
                                    </div>


                                <div class="mr-3 ml-5 pt-3 pt-1 font-size-lg d-inline"><strong>Filters:</strong></div>

                                <div class="d-inline">
                                    <select class="selectpicker w-150px"  title="Select Level">
                                        <option selected>All User</option>
                                        <option >Has Users</option>
                                        <option >No User</option>
                                    </select>
                                </div>


                                <div class="d-inline">
                                    <select class="selectpicker w-150px"  title="Select Level">
                                        <option selected>All Type</option>
                                        <option >Department</option>
                                        <option >Section</option>
                                    </select>
                                </div>

                            </div>


                            <div class="col-xxl-4 col-xl-12">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">Go!</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                </div> --}}

               <div class="row" id="domains-grid">
                @foreach($data as $row)
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-5 ">
                    <div class="card card-custom pl-2 pt-5 pb-5" id="kt_card_1">
                        <div class="card-header border-0 pr-3">
                            <div class="card-title w-70 max-w-70" style="word-break : break-all">
                                <h3 class="card-label">{{$row['name']}}

                                </h3>
                            </div>
                            <div class="card-toolbar">
                                @if(checkPersonPermission('update-domain-3-0'))
                                    <a id="domain-edit" data-id="{{$row['id']}}"  href="#" class="btn btn-icon btn-sm btn-hover-light-primary"  data-toggle="modal" data-placement="top" title="Edit Group(COO)"  data-target="#exampleModal2">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                @endif
                                @if(checkPersonPermission('delete-domain-3-0'))
                                    <a id="domain-delete" data-id="{{$row['id']}}" href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-toggle="modal"   data-placement="top" title="Delete Group(COO) " data-target="#exampleModal3">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                @endif

                            </div>
                            <div class="w-100 d-flex mt-n1">
                                <div class="text-muted mr-5">{{date('F j, Y', strtotime($row['created_at']))}}</div>
                                <div class="text-muted "><a href="">{{--{{rand(10,20)}}--}} {{$row->count}} members</a></div>
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
    @if(checkPersonPermission('add-domain-3-0'))
       @include('domains.modals.add')
    @endif
    @if(checkPersonPermission('update-domain-3-0'))
       @include('domains.modals.edit')
    @endif
    @if(checkPersonPermission('delete-domain-3-0'))
       @include('domains.modals.delete')
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

       $('#domains_form').bind("keypress", function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
        });

        //Create member function starts here
        $('body').on('click', '#add-domain-button', function (event) {
            event.preventDefault();
                    //Ajax code starts here
                    var form_data = new FormData(document.getElementById("domains_form"));
                    console.log(form_data);
                    $.ajax({
                            data: form_data,
                            url: "{{ route('domins.add')}}",
                            type: "POST",
                            dataType: 'json',
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                if(data.status === 200){
                                var message = data.message
                                Swal.fire("Added!", message, "success");
                                // $("#domains-grid").load(location.href + " #domains-grid>*", "");
                                $("#kt_content").load(location.href + " #kt_content>*", "");
                                setTimeout(function () {
                                    location.reload(true);
                                }, 3000);

                                $('#exampleModal').modal('toggle');
                                $('#domains_form').trigger("reset");
                                }
                            if(data.status === 400){
                                var error = data.message
                                var array = $.map(error, function(value, index) {  return [value]; });
                                let list = '';
                                for (var i = 0; i < array.length; i++)
                                list += array[i] + '\n <br>';
                                Swal.fire("Error!",list, "error");
                                $("#domains-grid").load(location.href + " #domains-grid>*", "");
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
                            //$('#member_form').trigger("reset");
                            }
                    });
                //Ajax code ends here
            });
            //Create member function ends here

            //Delete functiion starts here
             $('body').on('click', '#domain-delete', function (event) {
                event.preventDefault();
                var id = $(this).data("id");
                $("#delete-domain-button").unbind().click(function() {
                $.ajax({
                        type: "delete",
                        url: SITEURL + "/domains/"+id+"/delete/",
                        success: function (data) {
                                if(data.status === 200){
                                    var message = data.message;
                                    $("#kt_content").load(location.href + " #kt_content>*", "");
                                    Swal.fire("Deleted!", message, "success");

                                   // $("#domains-grid").load(location.href + " #domains-grid>*", "");
                                    $('#exampleModal3').modal('toggle');}
                                if(data.status === 400){
                                    var error = data.message
                                    Swal.fire("Error!",error, "error");
                                    $("#domains-grid").load(location.href + " #domains-grid>*", "");
                                    $('#exampleModal3').modal('toggle');
                                }
                                //Permission error
                                if(data.status === 401){
                                    var error = data.message
                                    Swal.fire("Error!", error, "error");
                                    $('#exampleModal').modal('toggle');
                                    $('#domains_form').trigger("reset");
                                }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
            });

            });
            //Delete function ends here

            //Edit member urgency type starts here
            $('body').on('click', '#domain-edit', function (event) {
                    event.preventDefault();
                    var id = $(this).data("id");
                            $.ajax({
                            type: "get",
                            url: SITEURL + "/domains/"+id+"/edit/",
                            dataType: 'json',
                                success:function(data){
                                    if(data.status === 200){
                                         $("#update_domain_form_area").empty();
                                         $('#update_domain_form_area').html(data.html);

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

                                                    var avatar2 = new KTImageInput('kt_image_2');
                                                    KTImageInputDemo.init();

                                    }
                                },
                                error: function (data) {
                                    console.log('Error:', data.responseText);
                                    var error = data.responseText
                                    Swal.fire("Error!", error, "error");
                                }
                        });
            });
         //Edit member urgency type ends here


           //update function starts here
        $('body').on('click', '#update-domain-button', function (event) {
                event.preventDefault();
                var form_data = new FormData(document.getElementById("domains_update_form"));
                $.ajax({
                    data: form_data,
                    url: "{{ route('domains.update')}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 200){
                        var message = data.message;
                        Swal.fire("Updated!", message, "success");
                        $("#domains-grid").load(location.href + " #domains-grid>*", "");
                        $('#exampleModal2').modal('toggle');}
                    if(data.status === 400){
                        var error = data.message
                        var array = $.map(error, function(value, index) {  return [value]; });
                        let list = '';
                        for (var i = 0; i < array.length; i++)
                        list += array[i] + '\n';
                        Swal.fire("Error!",list, "error");
                        $("#domains-grid").load(location.href + " #domains-grid>*", "");
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
                    $('#domains_form').trigger("reset");
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data);
                    }
                });
            });
            //update function ends here

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
