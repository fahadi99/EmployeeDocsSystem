@if ($total_count > 0)
@foreach($data as $row)
<div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12"  >
    <!--begin::Card-->
    <div class="card card-custom gutter-b card-stretch ribbon ribbon-clip ribbon-left" >

        <div class="ribbon-target" style="top: 5px; height: 30px; z-index:0">
            {!! getPersonRibbon($row->is_admin) !!}
        </div>
        <!--begin::Body-->
        <div class="card-body pt-4" >
            <!--begin::Toolbar-->

            <div class="d-flex justify-content-end">

                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                    <a href="#"  class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ki ki-bold-more-hor"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                        <!--begin::Navigation-->

                        <ul class="navi navi-hover" >
                            <li class="navi-header font-weight-bold py-1">
                                <a href="{{URL::to('admin/members/' . $row->member_id . '/profile/') }}" class="dropdown-item" ><i class="far fa-user mr-3"></i> Profile</a>
                            </li>

                           {{-- <li class="navi-header font-weight-bold py-1" data-toggle="modal" data-target="#exampleModal2">
                            <a class="dropdown-item" id="edit-member" data-id="{{$row->member_id}}" href="#"><i class="fas fa-pen mr-3"></i> Update</a>
                            </li>   --}}

                                 <li class="navi-header font-weight-bold py-1" data-toggle="modal" data-target="#exampleModal3">
                            <a class="dropdown-item" id="delete-member" data-id="{{$row->member_id}}" href="#"><i class="fas fa-trash mr-3"></i> Delete</a>
                            </li>

                            <li class="navi-separator"></li>
                            <li class="navi-header font-weight-bold py-1" data-toggle="modal" data-target="{{$row->status == 1 ? "#exampleModal4" : "#exampleModal5" }}">
                                <a class="dropdown-item" id="change-status" data-id="{{$row->member_id}}"  href="#"><i class="fas fa-toggle-on mr-3"></i>  Change Status</a>
                            </li>

                        </ul>

                        <!--end::Navigation-->
                    </div>
                </div>
            </div>

            <!--end::Toolbar-->
            <!--begin::User-->
            <div class="d-flex align-items-end mb-7">
                <!--begin::Pic-->
                <div class="d-flex align-items-center">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                        @if($row['picture'] != '' && is_file(public_path('uploads/members/' . $row['picture'])))
                            <div class="symbol symbol-circle symbol-lg-75">
                                <img src="{{getPersonImage($row->picture)}}">
                            </div>
                        @else
                            <div class="p-6 rounded-circle bg-light-info">
                                <span class="font-size-h3 font-weight-boldest text-capitalize">
                                    {{substr($row->first_name,0,1)}} {{substr($row->last_name, 0, 1)}}
                                </span>
                            </div>
                        @endif
                    </div>
                    <!--end::Pic-->
                    <!--begin::Title-->
                    <div class="d-flex flex-column">
                        <a @cannot('member')  href="{{URL::to('admin/members/' . $row->member_id . '/profile')}}" @endcannot class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">{{$row->first_name}} {{$row->last_name}}</a>
                        <span class="text-muted font-weight-bold">{{$row->designation}} </span>
                        @if($row->status == 1)
                            <span class="label label-light-primary w-70 rounded mt-2">Active</span>
                        @else
                            <span class="label label-light-danger w-70 rounded  mt-2 p-2">In-Active</span>
                        @endif

                    </div>


                    <!--end::Title-->
                </div>
                <!--end::Title-->
            </div>
            <!--end::User-->
            <!--begin::Info-->
            <div class="mb-7">

                <div class="d-flex justify-content-start align-items-center mb-3">
                    <span class="text-dark-75 font-weight-bolder min-w-100px">Email:</span>
                    <a href="#" class="text-muted text-hover-primary">{{$row->email}}</a>
                </div>
                <div class="d-flex justify-content-start align-items-cente my-1 mb-3">
                    <span class="text-dark-75 font-weight-bolder min-w-100px">Phone:</span>
                    <a href="#" class="text-muted text-hover-primary">{{$row->phone}}</a>
                </div>
            </div>
            <!--end::Info-->

            <!--begin::Desc-->

            <!--end::Desc-->

        </div>
        <!--end::Body-->
    </div>
    <!--end::Card-->
</div>
@endforeach
@else
<div class="" style="
margin-top : 40px !important;
margin-left: 850px !important;
width: 50% !important;
padding: 10px !important;">
    <span> No Users found </span>
</div>
@endif


