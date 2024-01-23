<tr>
    <td class="pl-0 py-5 mr-4">
        <div class="symbol symbol-60 mr-4">
            <span class="symbol-label {{$assignee->is_owner === true ? 'is-owner' : ''}}" style="background-image:url('{{getPersonImage($assignee->picture)}}');"></span>
        </div>
    </td>
    <td class="pl-0">
        <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$assignee->first_name}} {{$assignee->last_name}}</a>
        {{--<span class="text-muted font-weight-bold d-block">{{$assignee->designation_name}}</span> --}}
    </td>
    {{--<td>
        @if($assignee->for_info == 0)
            <div class="d-flex flex-column w-100 mr-2">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted mr-2 font-size-sm font-weight-bold">{{$assignee->task_percentage}}%</span>
                    <span class="text-muted font-size-sm font-weight-bold">{{$assignee->task_status_name}}</span>
                </div>
                <div class="progress progress-xs w-100">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{$assignee->task_percentage}}%;" aria-valuenow="{{$assignee->task_percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        @else
            <div class="text-muted text-center">
                For Info Purpose Only.
            </div>s
        @endif
    </td>  --}}
    <td class="text-right pr-0">
       {{-- @if($assignee->for_info == 0)
            @if($assignee->person_id == auth()->user()->id)
                <a href="#" class="btn btn-icon btn-light btn-sm update-status"  data-task-id="{{$assignee->task_id}}" data-id="{{$assignee->id}}">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            @endif
            <a href="#" class="btn btn-icon btn-light btn-sm status-details" data-task-id="{{$assignee->task_id}}" data-id="{{$assignee->id}}" >
                <i class="far fa-eye"></i>
            </a>
        @endif --}}
    </td>
</tr>
