@if(checkPersonPermission('view-domain-3-0'))
    <a href="{{URL::to('document-categories')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3">Document Categories</a>
@endif
@if(checkPersonPermission('view-organization-3-0'))
    <a href="{{URL::to('document-type-logs')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3">Document Types Logs</a>
@endif
@if(checkPersonPermission('view-designation-3-0'))
    <a href="{{URL::to('document-statuses')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3">Document Statuses</a>
@endif
@if(checkPersonPermission('view-department-3-0'))
    <a href="{{URL::to('document-shares')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3">Document Shares</a>
@endif
