@if ($total_count > 0)
@foreach($data as $row)
<div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12"  >
    <!--begin::Card-->
    <div class="card card-custom gutter-b card-stretch ribbon ribbon-clip ribbon-left" >

        <div class="ribbon-target {{$row->status ? 'bg-primary' : 'bg-danger'}}" style="top: 5px; height: 30px; z-index:0">
            {{$row->status ? 'Active' : 'Inactive'}}
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
                                <a href="" class="dropdown-item" ><i class="far fa-user mr-3"></i>Questions</a>
                            </li>

                           {{-- <li class="navi-header font-weight-bold py-1" data-toggle="modal" data-target="#exampleModal2">
                            <a class="dropdown-item" id="edit-member" data-id="{{$row->member_id}}" href="#"><i class="fas fa-pen mr-3"></i> Update</a>
                            </li>   --}}

                             <li class="navi-header font-weight-bold py-1" data-toggle="modal" data-target="#exampleModal3">
                                <a class="dropdown-item" id="delete-member" data-id="{{$row->id}}" href="#"><i class="fas fa-trash mr-3"></i> Employee</a>
                            </li>

                            <li class="navi-separator"></li>

                            <li class="navi-header font-weight-bold py-1">
                                <a class="dropdown-item update-button" data-id="{{$row->id}}" href="#"><i class="fas fa-trash mr-3"></i> Update</a>
                            </li>
                            <li class="navi-header font-weight-bold py-1" data-toggle="modal" data-target="{{$row->status == 1 ? "#exampleModal4" : "#exampleModal5" }}">
                                <a class="dropdown-item" id="change-status" data-id="{{$row->id}}"  href="#"><i class="fas fa-toggle-on mr-3"></i>  Change Status</a>
                            </li>
                            <li class="navi-header font-weight-bold py-1" data-toggle="modal" data-target="#exampleModal3">
                                <a class="dropdown-item" id="delete-survey" data-id="{{$row->id}}" href="#"><i class="fas fa-trash mr-3"></i> Delete</a>
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

                    <!--begin::Title-->
                    <div class="d-flex flex-column">
                        <a href="{{route('survey.detail', ['id' => $row->id])}}"><span class="font-size-h3 font-weight-boldest text-capitalize">
                            {{$row->name}}
                        </span></a>
                        <span class="text-muted font-weight-bold">{{$row->short_description}} </span>
                    </div>


                    <!--end::Title-->
                </div>
                <!--end::Title-->
            </div>
            <!--end::User-->
            <!--begin::Info-->
            <div class="mb-7">
                <div class="d-flex justify-content-start align-items-center mb-3">
                    <span class="text-dark-75 font-weight-bolder min-w-100px">Start Date:</span>
                    <a href="#" class="text-muted text-hover-primary">{{getBasicDateFormat($row->start_date)}}</a>
                </div>

                <div class="d-flex justify-content-start align-items-center mb-3">
                    <span class="text-dark-75 font-weight-bolder min-w-100px">End Date:</span>
                    <a href="#" class="text-muted text-hover-primary">{{$row->end_date ? getBasicDateFormat($row->end_date) : "No Deadline"}}</a>
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
    <span> No records found </span>
</div>
@endif


