@php
$col = 6;
if($search_include != '')
    $col = 12;
@endphp
@if($folders !== false)
    <div class="col-lg-{{$col}} col-xl-{{$col}}">
        <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Folders</span>
                {{--<span class="text-muted mt-3 font-weight-bold font-size-sm">24 Folders Found</span>--}}
            </h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-4">
            <!--begin::Container-->
            <div class="row" id="folder-grid">
                @if(count($folders) > 0)
                    @foreach($folders as $folder)
                        @if($folder->hasAccess())
                            @include('pages.dashboard.includes.folder')
                        @endif
                    @endforeach
                        <div class="col-12 text-right folder_pagination">
                            {{ $folders->links() }}
                        </div>
                @else
                    <div class="text-center text-muted w-100 p-5">There are no folders</div>
                @endif
            </div>
            <!--end::Container-->
        </div>
        <!--end::Body-->
    </div>
    </div>
@endif
@if($files !== false)
    <div class="col-lg-{{$col}} col-xl-{{$col}}">
    <div class="card card-custom gutter-b">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Files</span>
                {{--<span class="text-muted mt-3 font-weight-bold font-size-sm">24 Files Found</span>--}}
            </h3>
        </div>
        <div class="card-body pt-4">
            <div class="row" id="file-grid">
                @if(count($files) > 0)
                    @foreach($files as $file)
                        @if($file->hasAccess())
                            @include('pages.dashboard.includes.file')
                        @endif
                    @endforeach
                        <div class="col-12 text-right file_pagination">
                            {{ $files->links() }}
                        </div>
                @else
                    <div class="text-center text-muted w-100 p-5">There are no files</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
