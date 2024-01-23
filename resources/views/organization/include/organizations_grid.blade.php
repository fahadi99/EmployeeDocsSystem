@if ($total_count > 0)
@foreach($data as $row)
<div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-5 ">
    <div class="card card-custom pl-2 pt-5 pb-5" id="kt_card_1">
        <div class="card-header border-0 pr-3">

            <div class="card-title w-70 max-w-70" style="word-break : break-all">
                <h3 class="card-label">{{$row['name']}}
                </h3>
            </div>
            <div class="card-toolbar">
                @if(checkPersonPermission('update-organization-3-0'))
                    <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary" id="organization-edit" data-id="{{$row['id']}}" data-toggle="modal" data-placement="top" title=""  data-target="#exampleModal2">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                @endif
                @if(checkPersonPermission('delete-organization-3-0'))
                    <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" id="organization-delete" data-id="{{$row['id']}}" data-toggle="modal" data-placement="top" title="" data-target="#exampleModal3">
                        <i class="far fa-trash-alt"></i>
                    </a>
                @endif
            </div>
            <div class="w-100 d-flex mt-n1">

                <div class="text-muted mr-5">{{date('F j, Y', strtotime($row['created_at']))}}</div>
                <div class="text-muted "><a href=""> {{-- {{rand(10,20)}}--}} {{$row->count}} members</a></div>
            </div>
        </div>
    </div>
</div>
@endforeach
@else
<div class="" style="
margin-top : 40px !important;
margin-left: 850px !important;
width: 50% !important;
padding: 10px !important;">
    <span> No records found </span>
</div>
@endif
