@if ($total_count > 0)
@foreach($data as $row)
<div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-5  ">
    <div class="card card-custom pl-2 pt-5 pb-5" id="kt_card_1">
        <div class="card-header border-0 pr-3 ribbon ribbon-clip ribbon-left">
          {{--  <div class="ribbon-target" style="top: 15px; height: 45px;">
                @if($row['parent_id'] == 0)
                    <span class="ribbon-inner bg-primary"></span><strong>D</strong>
                @else
                    <span class="ribbon-inner bg-success"></span><strong>S</strong>
                @endif
            </div> --}}
            <div class="card-title w-70 max-w-70" style="word-break : break-all">
                <h3 class="card-label">{{$row['name']}}
                </h3>
            </div>
            <div class="card-toolbar">

                    <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary" id="department-edit" data-id="{{$row['id']}}" data-toggle="modal" data-placement="top" title=""  data-target="#exampleModal2">
                        <i class="fas fa-pencil-alt"></i>
                    </a>

                    <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" id="department-delete" data-id="{{$row['id']}}" data-toggle="modal" data-placement="top" title="" data-target="#exampleModal3">
                    <i class="far fa-trash-alt"></i>
                    </a>


            </div>
            <div class="w-100 d-flex mt-n1">
                <div class="text-muted mr-5">{{date('F j, Y', strtotime($row['created_at']))}}</div>
                <div class="text-muted "><a href=""> {{--{{rand(10,20)}}--}} {{$row->count}} members </a></div>
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
