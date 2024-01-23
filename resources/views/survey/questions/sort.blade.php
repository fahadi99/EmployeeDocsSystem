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
                <div class="card card-custom card-stretch ">
                    <!--begin::Header-->
                    <div class="card-header pt-5 pb-10">
                        <div class="card-title align-items-start flex-column">
                            <h3 class="card-label font-weight-bolder text-dark">Survey Questions - Sorting</h3>
                            <span class="text-muted font-weight-bold font-size-sm mt-1">{{$survey->questions->count()}} number(s) of questions in this survey</span>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{route('survey.questions', ['id' => $survey->id])}}" class="btn btn-light-secondary text-dark-75 font-weight-bold ml-2">Back To Questions</a>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->

                    <div class="row">
                        <div class="col-12">
                            <div id="kt_kanban_1"></div>
                        </div>
                    </div>

                </div>
            </div>
            <!--end::Content-->
        </div>
    </div>
@include('survey.questions.modals.create')
@include('survey.questions.modals.delete')

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

            $(document).on('change', '.question_type_option', function() {
                if($(this).val() == 'multiple' || $(this).val() == 'single' )
                    $('#question_type_field').removeClass('d-none');
                else
                    $('#question_type_field').addClass('d-none');
            });


            $('body').on('click', '#add-question-button', function (event) {
                event.preventDefault();
                //Ajax code starts here
                var form_data = new FormData(document.getElementById("survey_question_form"));
                console.log(form_data);
                $.ajax({
                    data: form_data,
                    url: "{{ route('survey.question.add', ['id' => $survey->id])}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 200){
                            var message = data.message
                            Swal.fire("Added!", message, "success");
                            $("#survey-question-grid").load(location.href + " #survey-question-grid>*", function(){
                                KTAppTodo.init()
                            });
                            $('#exampleModal').modal('toggle');
                            $('#survey_question_form').trigger("reset");

                        }
                        if(data.status === 400){
                            var error = data.message
                            var array = $.map(error, function(value, index) {  return [value]; });
                            let list = '';
                            for (var i = 0; i < array.length; i++)
                                list += array[i] + '\n <br>';
                            Swal.fire("Error!",list, "error");
                            $("#survey-question-grid").load(location.href + " #survey-question-grid>*", "");
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


            });
            $('body').on('click', '.delete-button-modal', function (event) {
                event.preventDefault();
                var id = $(this).data("id");
                $("#delete-button").unbind().click(function() {
                    $.ajax({
                        type: "delete",
                        url: SITEURL + "/survey/{{$survey->id}}/question/delete/"+id,
                        success: function (data) {
                            if(data.status === 200){
                                var message = data.message;
                                Swal.fire("Deleted!", message, "success");
                                $("#survey-question-grid").load(location.href + " #survey-question-grid>*", function(){
                                    KTAppTodo.init()
                                });
                                $('#exampleModal3').modal('toggle');}
                            if(data.status === 400){
                                var error = data.message
                                Swal.fire("Error!",error, "error");
                                $("#survey-question-grid").load(location.href + " #survey-question-grid>*", function(){
                                    KTAppTodo.init()
                                });
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

            var kanban = new jKanban({
                element: '#kt_kanban_1',
                gutter: '0',
                widthBoard: '100%',
                boards: [{
                    'id': '_inprocess',
                    'title': 'In Process',
                    'class': 'secondary',
                    'item': [
                        @if($survey->questions->count() > 0)
                            @foreach($survey->questions as $key => $row)
                                {
                                    'title': '<span class="font-weight-bold" data-id="{{$row->id}}">{{$row->question}}</span>',
                                },
                            @endforeach
                        @endif
                    ]
                }
                ],
                dropEl: function(el, target, source, sibling){
                    updateRecords();
                },
            });

            function updateRecords() {
                var questions_fields = kanban.getBoardElements('_inprocess');
                var questions = $(questions_fields).map(function (idx, ele) {
                    return $(ele).children('span').data('id');
                }).get();



                $.ajax({
                    url : "{{route('survey.questions.sort.update', ['id'=>$survey->id])}}",
                    type : 'post',
                    data : { 'questions':questions},
                    success : function (res) {
                        showToastr('success', res.message);
                    }
                })

            }
        });
    </script>
@endsection


