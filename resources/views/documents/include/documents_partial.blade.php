@isset($documents)
@if($documents->count())
    @foreach($documents as $doc)

        <div id="doc-{{$doc->id}}" class="list-doc list list-hover min-w-500px doc-custom {{ ($mainDocument && $mainDocument->id == $doc->id) ? 'active' : ''}}">
            <!--begin::Item-->
            <div class="d-flex align-items-start list-item card-spacer-x py-4" data-inbox="message">
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center mr-5" data-inbox="actions">
                        <div class="flex-grow-1 text-center">
                            <div class="symbol symbol-60">
                                <span class="symbol-label" style="background-image:url('{{getDocumentTypeImage(isset($doc->document_type_icon)?$doc->document_type_icon: null)}}');"></span>
                            </div>
                            <div class="text-center">


                                <a href="#" class="btn btn-icon btn-xs btn-hover-text-warning NewStarredClass feature-link feature-link-{{$doc->id}}" {{ isset($doc->starred) ? 'active' : ''}} data-id="{{$doc->id}}" data-toggle="tooltip" data-placement="right" title="Starred">
                                    <i class="flaticon-star" @isset($doc->starred)
                                        style="color :  #F8DE7E !important"
                                        @else
                                        style="color :  #b5b5c3 !important"
                                    @endisset ></i>
                                </a>


                            </div>
                        </div>
                    </div>

                </div>
                <!--end::Toolbar-->
                <!--begin::Info-->

                 <div class="flex-grow-1 mt-1 mr-2 doc-details" data-toggle="view" data-id="{{$doc->id}}">
                    <div class="font-weight-bolder mr-2 " >{{$doc->subject}}</div>
                    <div class="d-flex align-items-center py-1">
                        <a class="d-flex align-items-center text-muted text-hover-primary  mr-2 custom-project-name">
                            <span class="fa fa-genderless text-primary icon-md mr-2 "></span>{{$doc->project_name}}
                        </a>
                        <a class="d-flex align-items-center text-muted text-hover-primary custom-type-name">
                            <span class="fa fa-genderless text-danger icon-md mr-2 "></span>&nbsp;{{$doc->document_type_name}}
                        </a>
                        &nbsp;
                        <a class="d-flex align-items-center text-muted text-hover-primary  mr-2 custom-priority-name">
                            <span class="fa fa-genderless text-danger icon-md mr-2 "></span>{{$doc->priority_name}}
                        </a>
                    </div>
                    <div class="align-content-end w-145px max-w-145px min-w-145px" data-toggle="view">
                        <div class="text-muted font-weight-bold text-right" data-toggle="view">{{getComplateDate($doc->dated)}}</div>
                    </div>
                    <div class="d-flex flex-column mb-5 mt-n2">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-muted mr-2 font-size-sm font-weight-bold"></span>
                            <span class="text-muted font-size-sm font-weight-bold">{{$doc->document_status_name ? $doc->document_status_name : 'Pending'}} </span>
                        </div>

                        {{-- <div class="progress progress-xs w-100">
                            <div class="progress-bar bg-muted" role="progressbar" style="width: {{$doc->doc_percentage}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div> --}}
                    </div>
                    <div class="d-flex mt-2 justify-content-between">
                        {{-- <div>
                            @if($doc->tags()->count() > 0)
                                @foreach($doc->tags as $tag_row)
                                    @if($tag_row->tag_name == '') @continue @endif
                                    <span class="label label-light-primary font-weight-bold label-inline custom-label">{{$tag_row->tag_name}}</span>
                                @endforeach
                            @endif
                        </div> --}}
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Info-->
                <!--begin::Details-->

                <!--end::Details-->
            </div>
            <!--end::Item-->
        </div>
    @endforeach


   <!--begin::Pagination-->
<div class="d-flex align-items-center my-2 my-6 card-spacer-x justify-content-end">
    <div class="d-flex align-items-center mr-2" data-toggle="tooltip" title="Records per page">
        <span class="text-muted font-weight-bold mr-2" data-toggle="dropdown">
            {{getPaginationFrom($documents->currentPage(), $documents->perPage())}}
            -
            {{getPaginationTo($documents->currentPage(), $documents->perPage(), $documents->total() )}}
            of
            {{$documents->total()}}
        </span>
        <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
            <ul class="navi py-3">
                <li class="navi-item">
                    <a href="#" class="navi-link">
                        <span class="navi-text per-page {{$filters['per_page'] == 10 ? 'active' : ''}}" data-value="10">10 per page</span>
                    </a>
                </li>
                <li class="navi-item">
                    <a href="#" class="navi-link">
                        <span class="navi-text per-page {{$filters['per_page'] == 20 ? 'active' : ''}}" data-value="20">20 par page</span>
                    </a>
                </li>
                <li class="navi-item">
                    <a href="#" class="navi-link">
                        <span class="navi-text per-page {{$filters['per_page'] == 30 ? 'active' : ''}}" data-value="30">30 per page</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <span data-value="{{$documents->currentPage() - 1}}" class="prev-page btn btn-default btn-icon btn-sm mr-2 {{$documents->onFirstPage() ? "disabled" : ""}}"
        {!! $documents->onFirstPage() ? 'data-toggle="tooltip" title="No record"' : 'data-toggle="tooltip" title="Previous page"' !!}>
        <i class="ki ki-bold-arrow-back icon-sm"></i>
    </span>
    <span data-value="{{$documents->currentPage() + 1}}" class="next-page btn btn-default btn-icon btn-sm {{$documents->lastPage() == $documents->currentPage() ? "disabled" : ""}}"
        {!! $documents->lastPage() == $documents->currentPage() ? 'data-toggle="tooltip" title="No record"' : 'data-toggle="tooltip" title="Next page"' !!}>
        <i class="ki ki-bold-arrow-next icon-sm"></i>
    </span>
</div>
<!--end::Pagination-->
@else
<div class="text-center p-10 text-muted">There are no <strong>documents</strong> found.</div>
@endif


@endisset



