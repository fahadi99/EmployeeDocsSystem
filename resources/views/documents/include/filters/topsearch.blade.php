<!--begin::Toolbar-->
<div class="d-flex flex-wrap align-items-center max-w-180px">
    <div class="d-flex align-items-center mr-1 my-2">
        <div class="input-group">
            <input id="text-search" value="{{$filters['s']}}" type="text" class="form-control" autocomplete="off" placeholder="Enter search text ...">
            <div class="input-group-append">
                <span id="text-search-button" class="input-group-text cursor-pointer">
                    <i class="la la-search icon-lg"></i>
                </span>
            </div>
        </div>
    </div>
</div>


<div class="d-flex align-items-center my-2">
    <div class="dropdown mr-2" data-toggle="tooltip" title="Priorities">
        <span class="btn btn-default btn-icon btn-sm" data-toggle="dropdown">
            <i id="priority-icon" class="la la-sort-numeric-up-alt icon-lg   {{count($filters['priority']) > 0 ? 'icon-active' : ''}}"></i>
        </span>
    <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
    <ul class="navi py-3">

        <div class="form-group">
            <div class="checkbox-list ml-10 mt-5">
                @foreach($selectBoxes['priorities'] as $key => $priority)
                    <label class="checkbox">
                        <input data-value="{{$priority['id']}}" type="checkbox" class="document_filters" name="f_priority"
                            {{in_array($key, $filters['priority']) ? 'checked="checked"' : ''}}
                        >
                        <span></span>{{$priority['name']}}
                    </label>
                @endforeach
            </div>
        </div>
    </ul>
    </div>
    </div>

    <div class="dropdown mr-2" data-toggle="tooltip" title="Status">
        <span class="btn btn-default btn-icon btn-sm" data-toggle="dropdown">
            <i id="status-icon" class="la la-list-alt icon-lg  {{count($filters['status']) > 0 ? 'icon-active' : ''}}"></i>
        </span>
    <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
    <ul class="navi py-3">
        <div class="form-group">
            <div class="checkbox-list ml-10 mt-5">
                @foreach($selectBoxes['statuses'] as $statuses)
                    <label class="checkbox">
                        <input data-value="{{$statuses['id']}}" type="checkbox" class="document_filters"  name="f_status"
                            {{in_array($statuses['id'], $filters['status']) ? 'checked="checked"' : ''}}
                        >
                        <span></span>{{$statuses['name']}}
                    </label>
                @endforeach
            </div>
        </div>
    </ul>
    </div>
    </div>

    <div class="dropdown mr-2" data-toggle="tooltip" title="My Documents">
        <span class="btn btn-default btn-icon btn-sm" data-toggle="dropdown">
            <i id="my-document-icon" class="far fa-user-circle icon-lg {{$filters['my_documents'] != 0 ? 'icon-active' : ''}} "></i>
        </span>
        <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
            <ul class="navi py-3">
                <div class="form-group">

                    <div class="radio-list ml-10 mt-5">
                            <label class="radio">
                                <input value="0" type="radio" {{$filters['my_documents'] == 0 ? 'checked' : ''}} class="document_filters"  name="f_my_documents">
                                <span></span>All Documents
                            </label>
                        <label class="radio">
                            <input value="1" type="radio" {{$filters['my_documents'] == 1 ? 'checked' : ''}} class="document_filters"  name="f_my_documents">
                            <span></span>My Documents
                        </label>
                        <label class="radio">
                            <input value="2" type="radio" {{$filters['my_documents'] == 2 ? 'checked' : ''}} class="document_filters"  name="f_my_documents">
                            <span></span>Assigned to me
                        </label>
                        <label class="radio">
                            <input value="3" type="radio" {{$filters['my_documents'] == 3 ? 'checked' : ''}} class="document_filters"  name="f_my_documents">
                            <span></span>Related to me
                        </label>
                    </div>
                </div>
            </ul>
        </div>
    </div>


    <a href="#" class="btn btn-icon btn-default btn-sm mr-2" data-toggle="tooltip" title="Starred Documents" id="feature-filter" data-value="{{$filters['feature'] == true  ? 'on' : 'off'}}">
        <i id="feature-icon"  class="flaticon-star icon-1x {{$filters['feature'] == true  ? 'icon-active' : ''}} "></i>
     </a>

    <span class="btn btn-light-danger btn-sm text-uppercase font-weight-bolder" id="reset-search">Reset Search</span>
</div>
