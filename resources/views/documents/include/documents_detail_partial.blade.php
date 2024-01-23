@if($mainDocument)
    <div class="card card-custom card-stretch" id="kt_todo_view">
    <!--begin::Header-->
    <div class="card-header align-items-center flex-wrap justify-content-between border-0 py-6 h-auto">
        <!--begin::Left-->
        <div class="d-flex align-items-center my-2">
        </div>
        <!--end::Left-->
        <!--begin::Right-->
        <div class="d-flex align-items-center justify-content-end text-right my-2">

            &nbsp;
            <span style="width: 80px !important" class="btn btn-success btn-icon btn-sm share-document" href=""  data-document-id="{{$mainDocument->id}}" data-toggle="tooltip" data-placement="top" title="Share Document">
                <i class="fas fa-share-alt icon-1x"></i> &nbsp; Share
            </span>
            &nbsp;
            <span style="width: 40px !important" class="btn btn-warning btn-icon btn-sm document-history" href="{{route('documents.share_history', ['id'=>$mainDocument->id])}}""  data-document-id="{{$mainDocument->id}}" data-toggle="tooltip" data-placement="top" title="Document history">
                <i class="fas fa-history icon-1x"></i> &nbsp;
            </span>
            @if(auth()->user()->id == $mainDocument->owner_id)
                <div class="btn-group btn-sm">
                    <button type="button" class="btn btn-secondary  btn-sm">{{$mainDocument->document_status_name}}</button>
                    <button type="button" class="btn btn-secondary btn-icon btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" style="">
                        @foreach($selectBoxes['statuses'] as $ts)
                            <a class="dropdown-item change-document-status" data-id="{{$ts->id}}" href="{{route('document.change.status', ['id' => $mainDocument->id, 'status' => $ts->id ])}}">{{$ts->name}}</a>
                        @endforeach
                    </div>
                </div>
                <span class="btn btn-secondary btn-icon btn-sm document-update" href="{{route('documents.edit', ['id'=>$mainDocument->id])}}" data-document-id="{{$mainDocument->id}}" data-toggle="tooltip" data-placement="top" title="Update Document">
                    <i class="fas fa-pencil-alt icon-1x"></i>
                </span>
                &nbsp;&nbsp;
                <span class="btn btn-danger btn-icon btn-sm document-delete" href="{{route('documents.delete', ['id' => $mainDocument->id])}}"  data-document-id="{{$mainDocument->id}}" data-toggle="tooltip" data-placement="top" title="Delete Document">
                    <i class="fas fa-trash-alt icon-1x"></i>
                </span>
            @endif
        </div>
        <!--end::Right-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body p-0">
        <!--begin::Header-->
        <div class="list list-hover min-w-500px task-custom" data-inbox="list">
            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center mr-5" data-inbox="actions">
                        <div class="flex-grow-1 text-center">
                            <div class="symbol symbol-60">
                                <span class="symbol-label" style="background-image:url('{{getDocumentTypeImage(isset($mainDocument->document_type_icon)?$mainDocument->document_type_icon: null)}}');"></span>
                            </div>
                            <div class="text-center">
                                <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning feature-link feature-link-{{$mainDocument->id}} {{ isset($mainDocument->starred) ? 'active' : ''}}" data-id="{{$mainDocument->id}}" data-toggle="tooltip" data-placement="right" title="Featured">
                                    <i class="flaticon-star" @isset($mainDocument->starred)
                                        style="color :  #F8DE7E !important"
                                        @else
                                        style="color :  #b5b5c3 !important"
                                    @endisset></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-grow-1 mt-1 mr-2" data-toggle="view">
                    <div class="font-size-h4 font-weight-bolder mr-2 mt-n2">{{$mainDocument->subject}}</div>
                    <div class="d-flex align-items-center py-1">
                        <a class="d-flex align-items-center text-muted text-hover-primary  mr-2 custom-project-name">
                            <span class="fa fa-genderless text-primary icon-md mr-2 "></span>{{$mainDocument->project_name}}
                        </a>
                        <a class="d-flex align-items-center text-muted text-hover-primary custom-category-name">
                            <span class="fa fa-genderless text-danger icon-md mr-2 "></span>{{$mainDocument->document_type_name}}
                        </a>
                        <a class="d-flex align-items-center text-muted text-hover-primary  mr-2 custom-priority-name">
                            <span class="fa fa-genderless text-danger icon-md mr-2 "></span>{{$mainDocument->priority_name}}
                        </a>
                    </div>
                    <div class="d-flex flex-column mb-5 mt-n2">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-muted mr-2 font-size-sm font-weight-bold"></span>
                            <span class="text-muted font-size-sm font-weight-bold">{{$mainDocument->document_status_name ? $mainDocument->document_status_name : 'Pending'}} </span>
                        </div>
                        {{-- <div class="progress progress-xs w-100">
                            <div class="progress-bar bg-muted" role="progressbar" style="width: {{$mainDocument->task_percentage}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div> --}}
                    </div>
                    <div class="d-flex mt-2 justify-content-between">
                        <div>
                           {{-- <div class="text-muted font-weight-bold text-right" data-toggle="view">{{getComplateDate($mainDocument->dated)}}</div> --}}
                        </div>
                        <div class="align-content-end w-145px max-w-145px min-w-145px" data-toggle="view">
                            <div class="text-muted font-weight-bold text-right" data-toggle="view">{{$mainDocument->dated == null ? "" : getComplateDate($mainDocument->dated)}}</div>
                        </div>
                    </div>
                    <div class="d-flex mt-5 justify-content-between">
                        <div>
                           {{-- @if($mainDocument->tags()->count() > 0)
                                @foreach($mainDocument->tags as $tag_row)
                                    @if($tag_row->tag_name == '') @continue @endif
                                    <span class="label label-light-primary font-weight-bold label-inline custom-label">{{$tag_row->tag_name}}</span>
                                @endforeach
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-spacer-x pt-2 pb-5 toggle-off-item">
            <!--begin::Text-->
            <div class="mb-1 mt-5">
                <p>{!! $mainDocument->description !!}</p>
            </div>
        <!--end::Text-->
            <!--begin::Attachments-->
            <div class="mb-5 mt-5">
                <form action="{{route('documents.file.add', [$mainDocument->id])}}"
                      class=" w-100"
                      id="document-dropzone-{{$mainDocument->id}}">
                      @CSRF
                    <div class="dropzone dropzone-default" id="kt_dropzone_1">
                        <div class="dropzone-msg dz-message needsclick ">
                            <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
                            <span class="dropzone-msg-desc">The File will automatically updates, once dropped or selected</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="d-flex flex-column font-size-sm font-weight-bold" id="document-attachment-{{$mainDocument->id}}">
                @include('documents.include.documents_attachments_partial')
            </div>
            <!--end::Attachments-->
        </div>

        <div class="card-body pt-2">
            <table class="table table-borderless table-vertical-center">
                <thead>
                <tr>
                    <th class="p-0 w-50px"></th>
                    <th class="p-0 min-w-200px"></th>
                    <th class="p-0 min-w-100px"></th>
                    <th class="p-0 min-w-40px"></th>
                </tr>
                </thead>
                <tbody>

                    @isset($tagged_users['tagged_persons'])
                    @foreach($tagged_users['tagged_persons'] as $assignee)
                        @include('documents.include.tagged_users_partial', ['editOption' => true])
                    @endforeach
                    @else
                    <div class="text-center text-muted">There is no assignee</div>
                    @endisset
                </tbody>
            </table>
        </div>
        <!--end::Header-->
        <!--begin::Messages-->
        <div class="mb-3">
            <!--begin::Message-->
            <div>
                <div class="font-size-h6 font-weight-bold border-bottom pl-8 pb-3 mb-3">Comments
                    <span class="font-size-lg text-muted"></span>
                </div>
            </div>
            @isset($document_comments)
                @foreach($document_comments as $index => $note)
                    @include('documents.include.comments_partial')
                @endforeach
            @else
                <div class="text-center text-muted">There is no notes</div>
            @endisset


            <!--end::Message-->

        </div>
        <!--end::Messages-->
        <!--begin::Reply-->
        <div class="card-spacer-x pb-10 pt-5" id="kt_todo_reply">
            <div class="card card-custom shadow-sm">
                <div class="card-body p-0">
                   @include('documents.include.comments_form')
                </div>
            </div>
        </div>
        <!--end::Reply-->
    </div>
    <!--end::Body-->
</div>
@endif
