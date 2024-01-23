<style>
    /* @media (min-width: 1320px) {
  .example {padding: 7px;
    margin-top:50px;

}
} */
</style>
@if(checkPersonPermission('view-person-3-0'))
    <a href="{{URL::to('persons')}}" class="btn btn-light-primary font-weight-bolder example btn-sm mr-3">Persons</a>
@endif

@if(checkPersonPermission('view-organization-3-0'))
    <a href="{{URL::to('organizations')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3 ">Organizations</a>
@endif

@if(checkPersonPermission('view-designation-3-0'))
    <a href="{{URL::to('designations')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3 ">Designations</a>
@endif

@if(checkPersonPermission('view-department-3-0'))
    <a href="{{URL::to('departments')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3 ">Departments</a>
@endif

@if(checkPersonPermission('view-voting-3-0'))
    <a href="{{URL::to('votings')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3 " >Votings</a>
@endif

@if(checkPersonPermission('view-projects-3-0'))
    <a href="{{URL::to('projects')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3 ">Projects</a>
@endif

@if(checkPersonPermission('view-categories-3-0'))
    <a href="{{route('document_categories.index')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3 ">Document Categories</a>
@endif

@if(checkPersonPermission('view-document_priority-3-0'))
    <a href="{{URL::to('document_priority')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3 ">Department Priorities</a>
@endif

@if(checkPersonPermission('view-type-3-0'))
    <a href="{{URL::to('document_types')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3 ">Document Types</a>
@endif

@if(checkPersonPermission('view-module-3-0'))
    <a href="{{URL::to('module')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3  ">Modules</a>
@endif
