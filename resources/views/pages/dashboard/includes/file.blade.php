<div class="col-12">
    <div class="d-flex align-items-center mb-8">
        <!--begin::Symbol-->
        <div class="symbol mr-5 pt-1">
            <div class="symbol-label min-w-65px min-h-100px" >
                <a href="{{$file->getPermanentURL()}}/view-watermark?v={{uniqid()}}"  class=" imageViewWatermark btn btn-sm btn-primary mr-2 bg-transparent border-0">
                    <img alt="" class="max-h-90px max-w-100" src="{{url('thumbnails/' . $file->thumb)}}">
                </a>
            </div>
        </div>
        <!--end::Symbol-->
        <!--begin::Info-->
        <div class="d-flex flex-column">
            <!--begin::Title-->
            @if($file->isCompleted())
                <a class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg" href="{{route('project.spaces.view.file', [$file->project_id, $file->project_space_id, $file->folder_id, $file->file_id])}}">{{$file->file_name}}</a>
            @else
                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg edit-form-modal" data-project-id="{{$file->project_id}}" data-project-space-id="{{$file->project_space_id}}" data-folder-id="{{$file->folder_id}}"  data-file-id="{{$file->file_id}}">{{$file->file_name}}</a>
            @endif

            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm d-inline-flex">
                @php
                    $file->breadcrumbs = $file->generateBreadcrumbs();
                    $i = 1; $count = count($file->breadcrumbs)
                @endphp
                @foreach($file->breadcrumbs as $key=>$val)
                    <li class="breadcrumb-item">
                        <a target="_blank" href="{{$val['link']}}" >{{$val['name']}}</a>
                    </li>
                @endforeach
            </ul>

            <div>
                @if(!$file->isCompleted())
                        <span class="badge badge-primary">Pending</span>
                @endif
                @if($file->isHotFile())
                        <span class="badge badge-danger">Hot File</span>
                @endif
                @if($file->isDeleted())
                        <span class="badge badge-warning">Archived</span>
                @endif
            </div>

            @if(checkPersonPermission('move-files-2-'. $file->project_space_id))
                <a target="_blank" href="{{route('project.spaces.move.file_start', [$file->project_id, $file->project_space_id, $file->folder_id, $file->file_id])}}" title="Move File" class="mt-3"><i class="fas fa-random icon-xl"></i></a>
            @endif

            <!--end::Action-->
        </div>
        <!--end::Info-->
    </div>
</div>
