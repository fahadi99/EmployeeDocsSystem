@extends('layout.general')
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
@php $page = 'shared_document'; @endphp
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Shared Document</h5>
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                {{-- <span class="btn btn-light-primary btn-sm text-uppercase font-weight-bolder" data-toggle="modal" data-target="#documentModal">New E doc</span>
                &nbsp; --}}
            </div>
            <!--end::Toolbar-->
        </div>
    </div>

    @if($mainDocument)
    <div class="container">
       <div class="row">
        <div class="col-md-2">
       </div>
          <div class="col-md-8">
            <div class="card card-custom card-stretch" id="kt_todo_view">
                <!--begin::Header-->
                <div class="card-header align-items-center flex-wrap justify-content-between border-0 py-6 h-auto">
                    <!--begin::Left-->
                    <div class="d-flex align-items-center my-2">
                    </div>
                    <!--end::Left-->
                    <!--begin::Right-->
                    <div class="d-flex align-items-center justify-content-end text-right my-2">
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
                                    <a href="#" class="d-flex align-items-center text-muted text-hover-primary  mr-2 custom-project-name">
                                        <span class="fa fa-genderless text-primary icon-md mr-2 "></span>{{$mainDocument->project_name}}
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-muted text-hover-primary custom-category-name">
                                        <span class="fa fa-genderless text-danger icon-md mr-2 "></span>{{$mainDocument->document_type_name}}
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-muted text-hover-primary  mr-2 custom-priority-name">
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
                        <div class="d-flex flex-column font-size-sm font-weight-bold" id="document-attachment-{{$mainDocument->id}}">
                            @isset($attachments)
                            @if($attachments->count() > 0)
                                @foreach($attachments as $attachment)
                                    <a href="{{route('documents.file.read', [ 'id'=> $mainDocument->id, 'file_id' => $attachment->id])}}"
                                        class="d-flex align-items-center text-muted text-hover-primary py-1">
                                        <span class="flaticon2-clip-symbol text-warning icon-1x mr-2"></span>{{$attachment->name}}</a>
                                @endforeach
                            @endif
                            @endisset
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

                                @isset($assignees['tagged_persons'])
                                @foreach($assignees['tagged_persons'] as $assignee)
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
                        @isset($comments)
                            @foreach($comments as $index => $note)
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

                    </div>
                    <!--end::Reply-->
                </div>
                <!--end::Body-->
                </div>
          </div>
       </div>
    </div>

@endif
</div>
@endsection
@section('scripts')
    <script src="{{URL::to('assets/js/pages/custom/todo/todo.js')}}"></script>
    <script src="{{URL::to('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js')}}"></script>
@endsection
