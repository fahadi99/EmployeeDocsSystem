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
                <div class="d-flex align-items-center">

                    <a href="#" class="btn btn-light-primary font-weight-bolder btn-sm mr-3"
                       data-toggle="modal" data-target="#addRightModel"
                    >Add Right</a>

                    <a href="#" class="addoc btn btn-light-primary font-weight-bolder btn-sm "
                       data-toggle="modal" data-target="#addModel"
                    >Add Right Type</a>


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
                            <span class="font-weight-bolder text-dark font-size-h3-lg">Right Types
                                <span class="text-muted font-size-h5-lg">- Listing</span>
                                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 pl-5 my-2 font-size-sm d-inline-flex">
                                        <li class="breadcrumb-item"><a href="{{route('right.types', ['id' => 0])}}">Types</a></li>
                                    @php $i = 1; $count = count($parentList) @endphp
                                    @foreach($parentList as $key=>$pl)
                                        <li class="breadcrumb-item">
                                            @if($i++ != $count)
                                                <a href="{{route('right.types', ['id' => $pl->id])}}" >{{$pl->name}}</a>
                                            @else
                                                <span class="text-muted">{{$pl->name}}</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>

                            </span>

                        </div>

                    </div>
                    <div class="text-primary mt-3 d-inline font-weight-bold font-size-base mr-5 col-smjustify-content-end">Total 8</div>


                </div>

                <div class="row mt-10" id="data-grid">
                    <div class="col-xl-6 col-lg-12" style="border-right: 3px solid #ccc;">
                        <div class="row">
                            @if($data->count() > 0)
                                @foreach($data as $row)
                                    <div class="col-xl-6 col-sm-12 mb-5 ">
                                        <div class="card card-custom pl-2 pt-5 pb-5" id="kt_card_1">
                                            <div class="card-header border-0 pr-3">

                                                <div class="card-title w-70 max-w-70" style="word-break : break-all">
                                                    <h3 class="card-label">
                                                        <a href="{{route('right.types', ['id'=>$row->id])}}">{{$row->name}}</a>
                                                    </h3>
                                                </div>
                                                <div class="card-toolbar">
                                                    <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary" id="rights-edit" data-id="{{$row->id}}" data-toggle="modal" data-placement="top" title=""  data-target="#edit-right-type-modal">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </div>
                                                <div class="w-100 d-flex mt-n1">

                                                    <div class="text-muted mr-5">{{date('F j, Y', strtotime($row->created_at))}}</div>
                                                    <div class="text-muted "><a href=""> {{rand(10,20)}} childs</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="no-record mr-2">
                                    There is no Sub types, <a href="#" data-toggle="modal" data-target="#addModel">Add New</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="row">
                            <div class="col-12">
                                <table class="p-5 bg-white w-100 p-20">
                                    <thead>
                                    <tr>
                                        <th class="p-5"  width="100px">ID</th>
                                        <th class="p-5"  width="150px">Name</th>
                                        <th class="p-5"  width="150px">Slug</th>
                                        <th class="p-5" >Created at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rights as $right)
                                            <tr>
                                                <td class="p-5">{{$right->id}}</td>
                                                <td class="p-5">{{$right->name}}</td>
                                                <td class="p-5">{{$right->slug}}</td>
                                                <td cl1ass="p-5">{{getBasicDateTimeFormat($right->created_at)}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>



    <div class="modal fade" id="addModel"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Right Type <small class="text-muted">- Add</small> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                        {!! Form::open(['id'=>'add_form','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>false]) !!}

                         <div class="form-group">

                        {!! Form::label('name','Name: <span class="text-danger">*</span>', ["class"=>"control-label"], false) !!}
                        {!! Form::text("name",null,["class"=>"form-control alphanumeric".($errors->has('name')?" is-invalid":"")
                        ,"autofocus"
                        ,"placeholder"=>"Name"
                        ,"required"]) !!}

                    </div>
                    {!! Form::hidden('parent_id', $id) !!}

                    {!! Form::close() !!}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="button" id="add-button" class="btn btn-primary font-weight-bold">Add Right Type</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addRightModel"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Right <small class="text-muted">- Add</small> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    {!! Form::open(['id'=>'add_right_form','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>false]) !!}

                    <div class="form-group">

                        {!! Form::label('name','Name: <span class="text-danger">*</span>', ["class"=>"control-label"], false) !!}
                        {!! Form::text("name",null,["class"=>"form-control alphanumeric".($errors->has('name')?" is-invalid":"")
                        ,"autofocus"
                        ,"placeholder"=>"Name"
                        ,"required"]) !!}

                    </div>
                    {!! Form::hidden('right_types_id', $id) !!}

                    {!! Form::close() !!}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="button" id="add-right-button" class="btn btn-primary font-weight-bold">Add Right</button>
                </div>
            </div>
        </div>
    </div>


    @include('rights.types.modals.edit')



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

        $('#organization_form').bind("keypress", function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
        });


       $('body').on('click', '#add-button', function (event) {
                event.preventDefault();
                $.ajax({
                    data: $('#add_form').serialize(),
                    url: "{{ route('right.types.add')}}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if(data.status === 200) {
                            var message = data.message
                            Swal.fire("Added!", message, "success");
                            $("#kt_content").load(location.href + " #kt_content>*", "");
                            $('#addModal').modal('toggle');
                            $('#add_form').trigger("reset");
                        }
                    if(data.status === 400) {
                        var error = data.message
                        var array = $.map(error, function(value, index) {  return [value]; });
                        let list = '';
                        for (var i = 0; i < array.length; i++)
                        list += array[i] + '\n';
                        Swal.fire("Error!",list, "error");
                        $("#data-grid").load(location.href + " #data-grid>*", "");
                    }
                    if(data.status === 409){
                        var error = data.message
                        Swal.fire("Error!", error, "error");
                        $('#addModal').modal('toggle');
                        $('#add_form').trigger("reset");
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                        Swal.fire("Error!", error, "error");
                        $('#addModal').modal('toggle');
                        $('#add_form').trigger("reset");
                    }
              });
         });


        $('body').on('click', '#add-right-button', function (event) {
        event.preventDefault();
        $.ajax({
            data: $('#add_right_form').serialize(),
            url: "{{ route('right.add')}}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if(data.status === 200) {
                    var message = data.message
                    Swal.fire("Added!", message, "success");
                    $ $("#kt_content").load(location.href + " #kt_content>*", "");
                    $('#addModal').modal('toggle');
                    $('#add_form').trigger("reset");
                }
                if(data.status === 400) {
                    var error = data.message
                    var array = $.map(error, function(value, index) {  return [value]; });
                    let list = '';
                    for (var i = 0; i < array.length; i++)
                        list += array[i] + '\n';
                    Swal.fire("Error!",list, "error");
                    $("#data-grid").load(location.href + " #data-grid>*", "");
                }
                if(data.status === 409){
                    var error = data.message
                    Swal.fire("Error!", error, "error");
                    $('#addModal').modal('toggle');
                    $('#add_form').trigger("reset");
                }
            },
            error: function (data) {
                console.log('Error:', data.responseText);
                var error = data.responseText
                Swal.fire("Error!", error, "error");
                $('#addModal').modal('toggle');
                $('#add_form').trigger("reset");
            }
        });
    });


           $('body').on('click', '#rights-edit', function (event) {
                    event.preventDefault();
                    var id = $(this).data("id");
                            $.ajax({
                            type: "get",
                            url: SITEURL + "/rights/types/"+id+"/edit/",
                            dataType: 'json',
                                success:function(data){
                                    if(data.status === 200){
                                         $("#update_rights_type_form_area").empty();
                                         $('#update_rights_type_form_area').html(data.html);
                                    }
                                },
                                error: function (data) {
                                    console.log('Error:', data.responseText);
                                    var error = data.responseText
                                    Swal.fire("Error!", error, "error");
                                }
                        });
            });


        $('body').on('click', '#update-right-type-button', function (event) {
                event.preventDefault();
                $.ajax({
                    data: $('#rights_type_update_form').serialize(),
                    url: "{{ route('right-types.update')}}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if(data.status === 200){
                        var message = data.message;
                        Swal.fire("Updated!", message, "success");
                        $("#data-grid").load(location.href + " #data-grid>*", "");
                        $('#edit-right-type-modal').modal('toggle');}
                    if(data.status === 400){
                        var error = data.message
                        var array = $.map(error, function(value, index) {  return [value]; });
                        let list = '';
                        for (var i = 0; i < array.length; i++)
                        list += array[i] + '\n';
                        Swal.fire("Error!",list, "error");
                        $("#data-grid").load(location.href + " #data-grid>*", "");
                        $('#edit-right-type-modal').modal('toggle');
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

             //Allow Alphanumeric checks
             $('.alphanumeric').keyup(function() {
            if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
                this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
            }
            });

            $('.alphanumeric').focusout(function() {
            this.value = this.value.trim();
            });

              //Allow Alphanumeric checks ends
});
</script>
<script>



    </script>
@endsection
