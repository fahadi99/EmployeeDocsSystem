@extends('layout.master')
@section('styles')
<style>
div#documentAddForm{
  width: auto;
  height: auto;
  overflow: scroll;
  overflow-x:hidden;
}

</style>
<link src="{{URL::to('assets/components/stepwizard/scripts.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
@php $page = 'documents'; @endphp
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Mobile Toggle-->
                <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                    <span></span>
                </button>
                <!--end::Mobile Toggle-->
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">E Docs</h5>
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                {{-- <span class="btn btn-light-primary btn-sm text-uppercase font-weight-bolder" data-toggle="modal" data-target="#documentModal">New E doc</span>
                &nbsp; --}}
                <span class="btn btn-light-primary btn-sm text-uppercase font-weight-bolder" data-toggle="modal" data-target="#documentCreateModal">Add document</span>
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Todo-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-325px" id="kt_todo_aside">
                    <!--begin::Card-->
                  @include('documents.include.filters.leftaside')
                    <!--end::Card-->
                </div>
                <!--end::Aside-->
                <!--begin::List-->
                <div class="flex-row-fluid ml-lg-8">
                    <div class="d-flex flex-column flex-grow-1">
                        <!--begin::Row-->
                        <div class="row">
                            <div id="task-listing-col" class="col-xl-6">
                                <!--begin::Card-->
                                <div class="card card-custom card-stretch" id="kt_todo_list">
                                    <!--begin::Header-->
                                    <div class="card-header align-items-center flex-wrap py-6 border-0 h-auto">
                                          @include('documents.include.filters.topsearch')
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body p-0">
                                        <!--begin::Responsive container-->
                                        <div class="table-responsive" id="documents-container">
                                            @include('documents.include.documents_partial')
                                        </div>
                                        <!--end::Responsive container-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <div class="col-xl-6 pt-10 pt-xl-0" id="docs-detail-container">
                                    @include('documents.include.documents_detail_partial')
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                </div>
                <!--end::List-->
            </div>
            <!--end::Todo-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

{{--<div class="modal fade custom-modal z-index-1041" id="detailDocument"   tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content" id="detailDocumentContainer">
            @if($mainDocument)
                @include('documents.include.documents_detail_partial')
            @endif
        </div>
    </div>
</div>
<div id="task-close-div" class="bottom-close-div c-hide">
    Close
</div> --}}



@include('documents.modals.create_document',['page'=> 'Add Document'])
@include('documents.modals.update_document',['page'=> 'Update Document'])
@include('documents.modals.delete_document',['page'=> 'Delete Document'])
@include('documents.modals.share_document', ['page'=> 'Share Document'])
@include('documents.modals.history_document', ['page'=> 'Document'])


@endsection
@section('scripts')
<script src="{{URL::to('assets/js/pages/custom/todo/todo.js')}}"></script>
<script src="{{URL::to('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js')}}"></script>
<script>
$("#show").click(function(){
  $("p").show();
});
</script>
<script type="text/javascript">

   $('#basic-data-details').submit(function () {
            $('#basic_data_anchor').removeClass('active');
            $('#details_anchor').removeClass('disabled').addClass('active');
            $('#basic_data_tab').removeClass('active');
            $('#details_tab').addClass('active');
            return false;
    });

    $('#add-details').submit(function () {
            $('#details_anchor').removeClass('active');
            $('#assignees_anchor').removeClass('disabled').addClass('active');
            $('#details_tab').removeClass('active');
            $('#assignees_tab').addClass('active');
            return false;
    });

    $('.is_restricted').on('change', function(){
    this.value = this.checked ? 1 : 0;
    }).change();

    $(function () {

        var SITEURL = '{{URL::to('')}}';
        $.ajaxSetup({
           headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });


        Dropzone.autoDiscover = false;
        var SITEURL = '{{URL::to('')}}';
        var bodyWidth;

        $('body').on('click', '#add-basic-data-button', function (event) {
        event.preventDefault();
        var form_data = new FormData(document.getElementById("basic-data-details"));
             console.log(form_data);
             $.ajax({
                    data: form_data,
                    url: "{{ route('documents.add_basic_data')}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 403) {
                            var error = data.message
                            showToastr('error', data.message);
                        }

                        if(data.status === 200){
                        var message = data.message
                        showToastr('success',message);

                        $('#details_document_id').val(data.id);
                        $('#assignees_document_id').val(data.id);

                        $('#basic_data_anchor').removeClass('active');
                        $('#details_anchor').removeClass('disabled').addClass('active');
                        $('#basic_data_tab').removeClass('active');
                        $('#details_tab').addClass('active');


                    }
                    if(data.status === 400){
                        showToastr('error', data.message, 'list');
                    }
                    if(data.status === 409){
                        var error = data.message
                        showToastr('error', error);
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                    showToastr('error', error);
                    }
              });
        });

        $('body').on('click', '.resetDocumentButtonRefresh', function (event) {
            event.preventDefault();
            window.location.href= "{{route('documents.index')}}";
        });

        $('body').on('click', '#update-basic-data-button', function (event) {
        event.preventDefault();
        var form_data = new FormData(document.getElementById("update-basic-data-details"));
             console.log(form_data);
             $.ajax({
                    data: form_data,
                    url: "{{ route('documents.update_basic_data')}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 403) {
                            var error = data.message
                            showToastr('error', data.message);
                        }

                        if(data.status === 200){
                        var message = data.message
                        showToastr('success',message);
                    }
                    if(data.status === 400){
                        showToastr('error', data.message, 'list');
                    }
                    if(data.status === 409){
                        var error = data.message
                        showToastr('error', error);
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                    showToastr('error', error);
                    }
              });
        });

        $('body').on('click', '#add-details-button', function (event) {
        event.preventDefault();
        var form_data = new FormData(document.getElementById("add-details"));
             console.log(form_data);
             $.ajax({
                    data: form_data,
                    url: "{{ route('documents.add_details')}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 403) {
                            var error = data.message
                            showToastr('error', data.message);
                        }

                        if(data.status === 200){
                        var message = data.message
                        showToastr('success',message);

                        $('#details_anchor').removeClass('active');
                        $('#assignees_anchor').removeClass('disabled').addClass('active');
                        $('#details_tab').removeClass('active');
                        $('#assignees_tab').addClass('active');
                    }
                    if(data.status === 400){
                        showToastr('error', data.message, 'list');
                    }
                    if(data.status === 409){
                        var error = data.message
                        showToastr('error', error);
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                    showToastr('error', error);
                    }
              });
        });

        //update
        $('body').on('click', '#update-details-button', function (event) {
        event.preventDefault();
        var form_data = new FormData(document.getElementById("update-details"));
             console.log(form_data);
             $.ajax({
                    data: form_data,
                    url: "{{ route('documents.update_details')}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 403) {
                            var error = data.message
                            showToastr('error', data.message);
                        }

                        if(data.status === 200){
                        var message = data.message
                        showToastr('success',message);

                    }
                    if(data.status === 400){
                        showToastr('error', data.message, 'list');
                    }
                    if(data.status === 409){
                        var error = data.message
                        showToastr('error', error);
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                    showToastr('error', error);
                    }
              });
        });

        $('body').on('click', '#add-assignees-button', function (event) {
        event.preventDefault();
        var form_data = new FormData(document.getElementById("add-assignees"));
             console.log(form_data);
             $.ajax({
                    data: form_data,
                    url: "{{ route('documents.add_assignees')}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 403) {
                            var error = data.message
                            showToastr('error', data.message);
                        }

                        if(data.status === 200){
                        var message = data.message
                        showToastr('success',message);

                        setTimeout(function(){
                        window.location.reload();
                        }, 3000);

                    }
                    if(data.status === 400){
                        showToastr('error', data.message, 'list');
                    }
                    if(data.status === 409){
                        var error = data.message
                        showToastr('error', error);
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                    showToastr('error', error);
                    }
              });
        });

        $('body').on('click', '#update-assignees-button', function (event) {
        event.preventDefault();
        var form_data = new FormData(document.getElementById("update-assignees"));
             console.log(form_data);
             $.ajax({
                    data: form_data,
                    url: "{{ route('documents.update_assignees')}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 403) {
                            var error = data.message
                            showToastr('error', data.message);
                        }

                        if(data.status === 200){
                        var message = data.message
                        showToastr('success',message);

                        setTimeout(function(){
                        window.location.reload();
                        }, 3000);

                    }
                    if(data.status === 400){
                        showToastr('error', data.message, 'list');
                    }
                    if(data.status === 409){
                        var error = data.message
                        showToastr('error', error);
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                    showToastr('error', error);
                    }
              });
        });

        //Share Document button
        $('body').on('click', '#shareDocumentButton', function (event) {
        event.preventDefault();
        var form_data = new FormData(document.getElementById("share_document_form"));

             console.log(form_data);
             $.ajax({
                    data: form_data,
                    url: "{{ route('documents.share_document')}}",
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {

                        if(data.status === 403) {
                            var error = data.message
                            showToastr('error', data.message);
                        }

                        if(data.status === 200){
                        var message = data.message
                        showToastr('success',message);
                        var url = data.url;
                        copyToClipboard(url);
                        $('#shareDocumentModal').modal('hide');

                        setTimeout( function() {  window.location.href = url;   }, 3000);

                       }

                    if(data.status === 400){
                        showToastr('error', data.message, 'list');
                    }
                    if(data.status === 409){
                        var error = data.message
                        showToastr('error', error);
                    }
                    },
                    error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                    showToastr('error', error);
                    }
              });
        });

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text);
        }

        //update starts here
        $(document).on('click', '.document-update', function(event){
            event.preventDefault();
            document_id = $(this).attr('data-document-id');
            getURL = $(this).attr('href');
                console.log(getURL);
                $.ajax({
                    url: getURL,
                    method: 'get',
                    success: function(result){
                        $('#basic_data_update_tab_data').html(result.basic_data);
                        $('#details_update_tab_data').html(result.details_data);
                        $('#assignees_update_tab_data').html(result.assignees_data);
                        $('#basic_data_update_anchor').removeClass('disabled').addClass('active');
                        $('#details_update_anchor').removeClass('disabled');
                        $('#assignees_update_anchor').removeClass('disabled');
                        $(".selectBoxUniqueClass").select2();

                        $('.is_restricted').on('change', function(){
                        this.value = this.checked ? 1 : 0;
                        }).change();

                    },
                });

            $('#documentUpdateModal').modal('show');

            return false;
        });

        //Share document
        $(document).on('click', '.share-document', function(event){
            event.preventDefault();
            $('#shareDocumentModal').modal('show');
            document_id = $(this).attr('data-document-id');
            $('#shareDocumentId').val(document_id);
            return false;
        });

        $('body').on('click', '.copyLinkHistoryButton', function (event) {
            event.preventDefault();
            url = $(this).attr('data-link');
            navigator.clipboard.writeText(url);
            alert("Copied the url: " + url);

        });

        //Delete starts here
        $(document).on('click', '.document-delete', function(event){
            event.preventDefault();

            $('#documentDeleteModal').modal('show');
            getURL = $(this).attr('href');
            document_id = $(this).attr('data-document-id');
            $(document).on('click', '#delete-document-button', function(event){
                event.preventDefault();
                $.ajax({
                    url: getURL,
                    method: 'delete',
                    success: function(data){
                        console.log(data);
                        $('#documentDeleteModal').modal('hide');
                        showToastr('success', data.message);
                        setTimeout(function(){
                        window.location.href= "{{route('documents.index')}}";
                        }, 3000);
                    },
                });
            });

            return false;
        });

        $(document).on('click', '.document-history', function(event){
            event.preventDefault();

                getURL = $(this).attr('href');
                $.ajax({
                    url: getURL,
                    method: 'get',
                    success: function(result){
                        console.log(result);
                        $('#documentShareHistory').html(result.document_history);
                    },
                    error: function (result) {
                    console.log('Error:', result.responseText);
                    var error = result.responseText
                    showToastr('error', error);
                    }
                });

                $('#documentHistoryModal').modal('show');
                return false;
        });

        page = '{{$filters['page']}}';
        per_page = '{{$filters['per_page']}}';

        function showAttachments(documentId) {
            var filterArray = {
                "document" : documentId,
                "type" : "attachments"
            };
            const url = new URL(window.location);
            $.each(filterArray, function( index, value) {
                value == ''
                    ? url.searchParams.delete(index)
                    : url.searchParams.set(index, value);
            });

            $.ajax({
                url: url.href,
                type: "get",
                dataType: 'json',
                cache:false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if(data.status === 200){
                        var loadedData = data.attachments;
                        $('#document-attachment-' + documentId).html(loadedData);
                    }
                },
                error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                    Swal.fire("Error!", error, "error");
                }
            });
            window.history.pushState({}, '', url);
          }


           $('body').on('submit', '#note-add-form', function (event) {
                event.preventDefault();
                var form_data = new FormData(document.getElementById("" +
                    "note-add-form"));


                $.ajax({
                    data: form_data,
                    url: $(this).attr('action'),
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.status === 200){
                        showToastr('success', data.message);

                            $('button[type=submit], input[type=submit]').prop('disabled',true);

                            updateResults();
                            showDetail(data.document_id);



                        }
                        if(data.status === 400){
                            showToastr('error', data.message, 'list');

                        }
                        if(data.status === 409){
                            showToastr('error', data.message);
                        }
                    },
                    error: function (data) {
                        showToastr('error', data.responseText);
                    }
                });

                return false;

            });

            var recordingFunction = function() {
                class VoiceRecorder {
                constructor() {
                    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                        console.log("getUserMedia supported")
                    } else {
                        console.log("getUserMedia is not supported on your browser!")
                    }

                    this.mediaRecorder
                    this.stream
                    this.chunks = []
                    this.isRecording = false

                    this.recorderRef = document.querySelector("#recorder")
                    this.playerRef = document.querySelector("#player")
                    this.startRef = document.querySelector("#start")
                    this.stopRef = document.querySelector("#stop")

                    this.startRef.onclick = this.startRecording.bind(this)
                    this.stopRef.onclick = this.stopRecording.bind(this)

                    this.constraints = {
                        audio: true,
                        video: false
                    }

                }

                handleSuccess(stream) {
                    this.stream = stream
                    this.stream.oninactive = () => {
                        console.log("Stream ended!")
                    };
                    this.recorderRef.srcObject = this.stream
                    this.mediaRecorder = new MediaRecorder(this.stream)
                    console.log(this.mediaRecorder)
                    this.mediaRecorder.ondataavailable = this.onMediaRecorderDataAvailable.bind(this)
                    this.mediaRecorder.onstop = this.onMediaRecorderStop.bind(this)
                    this.recorderRef.play()
                    this.mediaRecorder.start()
                }

                handleError(error) {
                    console.log("navigator.getUserMedia error: ", error)
                }

                onMediaRecorderDataAvailable(e) { this.chunks.push(e.data) }

                uploadRecordings (blob) {

                var formdata = new FormData();
                formdata.append('audio', blob);
                var id = $('#documentIdValue').val();
                var SITEURL = '{{URL::to('')}}';

                $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: 'POST',
                            url: SITEURL + "/documents/" + id + "/upload-audio",
                            data: formdata,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                if(data.status === 200){
                                    showToastr('success', data.message);
                                    setTimeout(() => {
                                        showDetail(data.document_id);
                                    }, 5000);
                                }
                                if(data.status === 400){
                                    showToastr('error', data.message, 'list');
                                    //window.location.href = url;
                                }
                                if(data.status === 409){
                                    showToastr('error', data.message);
                                    //window.location.href = url;
                                }
                            },
                            error: function(data) {
                                showToastr('error', data.responseText);
                            }
                        });
                }

                onMediaRecorderStop(e) {
                        console.log($(this).data('id'));
                        const blob = new Blob(this.chunks, { 'type': 'audio/ogg; codecs=opus' })
                        this.uploadRecordings(blob)

                        //upload code starts here
                    /*   var formdata = new FormData();
                        formdata.append('audio-blob', blob);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: //your url,
                            data: formdata,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                if(data.status === 200){
                                    showToastr('success', data.message);
                                    window.location.reload();
                                }
                                if(data.status === 400){
                                    showToastr('error', data.message, 'list');
                                    window.location.href = url;
                                }
                                if(data.status === 409){
                                    showToastr('error', data.message);
                                    window.location.href = url;
                                }
                            },
                            error: function(data) {
                                showToastr('error', data.responseText);
                            }
                        });  */
                        //Upload code ends here

                        const audioURL = window.URL.createObjectURL(blob)
                        this.playerRef.src = audioURL
                        this.chunks = []
                        this.stream.getAudioTracks().forEach(track => track.stop())
                        this.stream = null
                }

                startRecording() {
                    if (this.isRecording) return
                    this.isRecording = true
                    this.startRef.innerHTML = ' Recording... '
                    this.playerRef.src = ''
                    navigator.mediaDevices
                        .getUserMedia(this.constraints)
                        .then(this.handleSuccess.bind(this))
                        .catch(this.handleError.bind(this))
                }

                stopRecording() {
                    if (!this.isRecording) return
                    this.isRecording = false
                    this.startRef.innerHTML = '<span class="svg-icon svg-icon-primary svg-icon-2x"  style="color: red"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Devices/Mic.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M12.9975507,17.929461 C12.9991745,17.9527631 13,17.9762852 13,18 L13,21 C13,21.5522847 12.5522847,22 12,22 C11.4477153,22 11,21.5522847 11,21 L11,18 C11,17.9762852 11.0008255,17.9527631 11.0024493,17.929461 C7.60896116,17.4452857 5,14.5273206 5,11 L7,11 C7,13.7614237 9.23857625,16 12,16 C14.7614237,16 17,13.7614237 17,11 L19,11 C19,14.5273206 16.3910388,17.4452857 12.9975507,17.929461 Z" fill="#000000" fill-rule="nonzero"/><rect fill="#000000" opacity="0.3" transform="translate(12.000000, 8.000000) rotate(-360.000000) translate(-12.000000, -8.000000) " x="9" y="2" width="6" height="12" rx="3"/></g> </svg></span>'
                    this.recorderRef.pause()
                    this.mediaRecorder.stop()
                }
            }

            window.voiceRecorder = new VoiceRecorder()
                return;
            }

           function updateResults() {
            const url = new URL(window.location);
            var filterArray = {
                "project": '',
                "category": '',
                "tagged_peron": '',
                "owner": '',
                "voting_type" : '',
                "priority": '',
                "status": '',
                "feature": '',
                "per_page": '',
                "my_documents": '',
                "unread": '',
                "page": '',
                "s" : '',
                "domain" : '',
                "organization" : '',
                "department" : '',
                "dateRangeStringValue" : '',
                "type" : 'search'
            };

            filterArray.my_documents = $("input[name='f_my_documents']:checked").val();
            filterArray.my_documents > 0 ? $('#my-document-icon').addClass('icon-active') : $('#my-document-icon').removeClass('icon-active')
            filterArray.per_page = per_page;
            filterArray.page = page;
            filterArray.s = $('#text-search').val();
            filterArray.dateRangeStringValue = $('#kt_daterangepicker_1').val();
            filterArray.project = $('#project').val();
            filterArray.category = $('#documentCategory').val();
            filterArray.tagged_peron = $('#tagged_peron').val();
            filterArray.owner = $('#owner_id').val();
            filterArray.voting_type = $('#voting_type').val();
            filterArray.domain = $('#domain_id').val();
            filterArray.organization = $('#organization_id').val();
            filterArray.department = $('#department_id').val();

            temp = false;
            $("input:checkbox[name=f_priority]:checked").each(function(){
                temp = true;
                filterArray.priority += $(this).data('value') + ',';
            });
            filterArray.priority = trim(filterArray.priority, ',');
            temp ? $('#priority-icon').addClass('icon-active') : $('#priority-icon').removeClass('icon-active')

            temp = false;
            $("input:checkbox[name=f_status]:checked").each(function(){
                temp = true;
                filterArray.status += $(this).data('value') + ',';
            });
            filterArray.status = trim(filterArray.status, ',');
            temp ? $('#status-icon').addClass('icon-active') : $('#status-icon').removeClass('icon-active')

            if($('#feature-filter').data('value') == 'on')
            {
                filterArray.feature = 1;
                $('#feature-icon').addClass('icon-active')
            } else {
                $('#feature-icon').removeClass('icon-active')
            }

            console.log(filterArray);

            $.each(filterArray, function( index, value) {
                value == ''
                    ? url.searchParams.delete(index)
                    : url.searchParams.set(index, value);
            });

            $.ajax({
                url: url.href,
                type: "get",
                dataType: 'json',
                cache:false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    if(data.status === 200){
                        console.log(data);
                        var loadedDate = data.data;
                        $('#documents-container').html(loadedDate);
                    }
                    if(data.status === 400){
                        var error = data.message
                        var array = $.map(error, function(value, index) {  return [value]; });
                        let list = '';
                        for (var i = 0; i < array.length; i++)
                            list += array[i] + '\n <br>';
                        Swal.fire("Error!",list, "error");
                    }
                    if(data.status === 409){
                        var error = data.message
                        Swal.fire("Error!", error, "error");
                    }
                },
                error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                    Swal.fire("Error!", error, "error");
                }
            });
            window.history.pushState({}, '', url);
           }

           bodyWidth = $(document).innerWidth();
            if(bodyWidth > 1382) {
                $('#detailDocumentContainer').html('');
            } else {
                $('#detailDocumentContainer').html('');
                @if($mainDocument)
                    showDetail({{$mainDocument->id}});
                @endif
            }

           $('#documentAddForm').attr('overflow','auto');

           $(document).on('click', '.doc-details', function(event) {
                console.log($(this).data('id'));
                showDetail($(this).data('id'));
           });

           function initializeDropZone(documentId) {
            var myDropzone = new Dropzone("#document-dropzone-" + documentId, { });
                myDropzone.on("success", function(file) {
            });

            myDropzone.on("queuecomplete", function (file) {
                showToastr('success', "File Uploaded Successfully");
                showDetail(documentId);

                //showAttachments(documentId);
                // setTimeout(function(){
                //         window.location.reload();
                //         }, 3000);
            });
          }

           function showDetail(documentId) {

            var filterArray = {
                "document" : documentId,
                "type" : "document"
            };

            const url = new URL(window.location);

            $.each(filterArray, function( index, value) {
                value == ''
                    ? url.searchParams.delete(index)
                    : url.searchParams.set(index, value);
            });

            $(".list-doc").removeClass('active');
            $("#doc-" + documentId ).addClass('active');
            $("#doc-" + documentId ).removeClass('unread');

            $.ajax({
                url: url.href,
                type: "get",
                dataType: 'json',
                cache:false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if(data.status === 200) {
                        var loadedData = data.document;
                        console.log(loadedData);
                        if(bodyWidth > 1382) {
                            $('#docs-detail-container').html(loadedData);
                            initializeDropZone(documentId);
                            $('.summernote').summernote({
                                height: 130,
                                tabsize: 2
                            });
                            recordingFunction();


                        } else {
                            $('#detailDocumentContainer').html(loadedData);
                            initializeDropZone(documentId);
                            $('#detailTask').modal('show');
                            $('#task-close-div').removeClass('c-hide');
                            recordingFunction();

                        }


                        updateToggle();
                    }
                    if(data.status === 400){
                        var error = data.message
                        var array = $.map(error, function(value, index) {  return [value]; });
                        let list = '';
                        for (var i = 0; i < array.length; i++)
                            list += array[i] + '\n <br>';
                        Swal.fire("Error!",list, "error");
                        // $("#meetings_grid").load(location.href + " #meetings_grid>*", "");
                    }
                    if(data.status === 409){
                        var error = data.message
                        Swal.fire("Error!", error, "error");
                    }
                },
                error: function (data) {
                    console.log('Error:', data.responseText);
                    var error = data.responseText
                    Swal.fire("Error!", error, "error");
                }
            });
            window.history.pushState({}, '', url);
           }


          //Adding Documents here
           $('body').on('click', '#add-documents-button', function (event) {
            event.preventDefault();
                    var form_data = new FormData(document.getElementById("documents_add_form"));
                        $.ajax({
                        data: form_data,
                        url: "{{ route('documents.add')}}",
                        type: "POST",
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function (result) {
                            if(result.status == 200) {
                                            show_message('success', result.message);
                                            setTimeout(function(){
                                                window.location.href = "{{route('documents.index')}}";
                                            }, 3000);
                                        } else {
                                            show_message('error', result.message, 'list');
                                        }
                        },
                        error: function (data) {
                        console.log('Error:', data);
                        }
                    });
            });


           $(document).on('click', '.per-page', function(event){
            per_page = $(this).data('value');
            page = 1;
            updateResults();
            return false;
            });

            $(document).on('click', '.prev-page', function(event){
                page = $(this).data('value');
                if($(this).hasClass('disabled'))
                    return false;
                updateResults();
                return false;
            });

            $(document).on('click', '.next-page', function(event){
                page = $(this).data('value');
                if($(this).hasClass('disabled'))
                    return false;
                updateResults();
                return false;
            });

            $(document).on('click', '#text-search-button', function(event){
                updateResults();
                return false;
            });


            $('#feature-filter').on('click', function(){
            $(this).toggleClass('active');
            $(this).data('value', $(this).data('value') == 'on' ? 'off' : 'on');
            updateResults();
            });

            $(document).on('click', '#reset-search', function(){
                window.location.href = '{{route('documents.index')}}';
            })

           $('.document_filters').on('change', function(){
                  updateResults();
           });

            $('#kt_daterangepicker_1').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            updateResults();
            });

         $(document).on('click', '.feature-link', function(event){

            const url = new URL(window.location);

           $(this).hasClass('active')
               ? $('.feature-link-' + $(this).data('id')).removeClass('active')
               : $('.feature-link-' + $(this).data('id')).addClass('active')

            $.ajax({
                url: SITEURL + "/documents/" + $(this).data('id') + "/starred",
                type: "get",
                dataType: 'json',
                cache:false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if(data.status === 200){
                        showToastr('success', data.message);
                        window.location.reload();
                    }
                    if(data.status === 400){
                        showToastr('error', data.message, 'list');
                        window.location.href = url;
                    }
                    if(data.status === 409){
                        showToastr('error', data.message);
                        window.location.href = url;
                    }
                },
                error: function (data) {
                    showToastr('error', data.responseText);
                }
              });
           });

           $('body').on('click', '.change-document-status', function (event) {
                event.preventDefault();

                $.ajax({
                    url: $(this).attr('href'),
                    type: "get",
                    cache:false,
                    success: function (data) {
                        if(data.status === 200){
                            showToastr('success', data.message);
                            updateResults();
                            showDetail(data.document_id);
                        }
                        if(data.status === 400){
                            showToastr('error', data.message, 'list');

                        }
                        if(data.status === 409){
                            showToastr('error', data.message);
                        }
                    },
                    error: function (data) {
                        showToastr('error', data.responseText);
                    }
                });
                return false;
            });

            @if($mainDocument)
            initializeDropZone({{$mainDocument->id}});
            @endif

            function updateToggle () {

                KTUtil.on(KTUtil.getById('kt_todo_view'), '[data-inbox="message"]', 'click', function(e) {
                        var message = this.closest('[data-inbox="message"]');

                        var dropdownToggleEl = KTUtil.find(this, '[data-toggle="dropdown"]');
                        var toolbarEl = KTUtil.find(this, '[data-inbox="toolbar"]');

                        // skip dropdown toggle click
                        if (e.target === dropdownToggleEl || (dropdownToggleEl && dropdownToggleEl.contains(e.target) === true)) {
                            return false;
                        }

                        // skip group actions click
                        if (e.target === toolbarEl || (toolbarEl && toolbarEl.contains(e.target) === true)) {
                            return false;
                        }

                        if (KTUtil.hasClass(message, 'toggle-on')) {
                            KTUtil.addClass(message, 'toggle-off');
                            KTUtil.removeClass(message, 'toggle-on');
                        } else {
                            KTUtil.removeClass(message, 'toggle-off');
                            KTUtil.addClass(message, 'toggle-on');
                        }
                    });
            }


});


$(document).ready(function() {
    recordingFunction();
});






</script>
<script>
var KTBootstrapDaterangepicker = function () {
var demos = function () {
    $('#kt_daterangepicker_1, #kt_daterangepicker_1_modal').daterangepicker({
        "setDate": new Date(),
        "autoclose": true,
        "opens": 'up',
        "immediateUpdates": false,
        "todayBtn": true,
        "todayHighlight": true,
         "autoUpdateInput": false,
    });


}

return {
    init: function() {
        demos();
    }
};
}();

jQuery(document).ready(function() {
KTBootstrapDaterangepicker.init();
});
</script>
<script src="{{getAssetsURLs('plugins/custom/tinymce/tinymce.bundle.js')}}"></script>
<script>


</script>
<script type="text/javascript">

    $('#is_restricted').on('change', function(){
      this.value = this.checked ? 1 : 0;
    }).change();

    function initMCEexact(e){

        tinymce.init({
        selector : "textarea#"  +  e,
        max_height: 30,
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        },
        menubar: 'insert view code restoredraft insertdatetime toc',
        toolbar: 'undo redo | styleselect | fontselect |  alignleft aligncenter alignright alignjustify | bold italic underline |  image | media |  link | preview | code | fullscreen | numlist | bullist ',
        plugins: 'code table fullscreen lists advlist autosave image insertdatetime link preview toc visualblocks wordcount textpattern quickbars charmap directionality anchor autoresize media',

      });
    }

    initMCEexact("kt_docs_tinymce_basic_1");
    initMCEexact("kt_docs_tinymce_basic_2");
</script>
@endsection
