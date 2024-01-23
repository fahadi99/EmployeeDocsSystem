<div class="col-12 bottom-grey mb-5">
    <div class="d-flex align-items-center mb-8">
        <!--begin::Symbol-->
        <div class="symbol mr-5 pt-1">
            <div class="symbol-label min-w-80px min-h-80px" style="background-image: url('{{url('assets/media/svg/files/folder.svg')}}')"></div>
        </div>
        <!--end::Symbol-->
        <!--begin::Info-->
        <div class="d-flex flex-column">
            <!--begin::Title-->
            <a href="{{route('project.spaces.details', ['project_id'=>$folder->project_id, 'space_id'=>$folder->project_space_id, 'folder_id'=>$folder->folder_id])}}" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$folder->name}}</a>
            <!--end::Title-->
            <!--begin::Text-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm d-inline-flex">
                @php
                    $folder->breadcrumbs = $folder->generateBreadcrumbs();
                    $i = 1; $count = count($folder->breadcrumbs)
                @endphp
                @foreach($folder->breadcrumbs as $key=>$val)
                    <li class="breadcrumb-item">
                        @if($i++ != $count)
                            <a target="_blank" href="{{$val['link']}}" >{{$val['name']}}</a>
                        @else
                            <span class="text-muted">{{$val['name']}}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
            <!--end::Text-->
            <!--begin::Action-->
            <div>
                <a type="button" target="_blank" href="{{route('project.spaces.details', ['project_id'=>$folder->project_id, 'space_id'=>$folder->project_space_id, 'folder_id'=>$folder->folder_id])}}" class="btn btn-light font-weight-bolder font-size-sm py-2">View Folder</a>
            </div>
            <!--end::Action-->
        </div>
        <!--end::Info-->
    </div>
</div>
