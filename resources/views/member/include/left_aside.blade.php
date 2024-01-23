@php $row = $data; @endphp

<div id="kt_profile_aside" class="flex-row-auto card card-custom gutter-b card-stretch ribbon ribbon-clip ribbon-left  offcanvas offcanvas-left offcanvas-off custom">
    <button class="btn btn-light-dark btn-icon btn-sm custom-offcanvas-close custom-offcanvas-close-btn d-xxl-none " data-target="kt_profile_aside"><i class="flaticon2-cross icon-md " ></i></button>

    <div class="ribbon-target" style="top: 5px; height: 30px;">
            <span class="ribbon-inner bg-primary"></span><strong>User</strong>
    </div>
    <!--begin::Body-->
    <div class="card-body pt-15">
        <!--begin::User-->
        <div class="d-flex align-items-end mb-7">
            <!--begin::Pic-->
            <div class="d-flex align-items-center">
                <!--begin::Pic-->
                <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                    @if(getPersonImage($row->picture,false))
                        <div class="symbol symbol-circle symbol-lg-75">
                            <img src="{{getPersonImage($row->picture)}}" alt="image">
                        </div>
                    @else
                        <div class="p-6 rounded-circle bg-light-info">
                            <span class="font-size-h3 font-weight-boldest">{{substr($row['first_name'],0,1)}}{{substr($row['last_name'], 0, 1)}}</span>
                        </div>
                    @endif
                </div>
                <!--end::Pic-->
                <!--begin::Title-->
                <div class="d-flex flex-column">
                    <a href="{{URL::to('members/profile')}}" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">{{$row['first_name']}} {{$row['last_name']}}</a>
                   {{-- <span class="text-muted font-weight-bold">{{$row['designation']}} [{{$row['department']}}]</span>  --}}
                    @if($row['status'] == 1)
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
@php($requestName = Request::route()->getName())
        <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
            <div class="navi-item mb-2">
                <a href="{{URL::to('members/profile')}}" class="navi-link py-4  {{$requestName == 'change_member.detail' ? 'active' : ''}}">
                    <span class="navi-icon mr-2 mt-n1">
                        <i class="fas fa-user-tie icon-md"></i>
                    </span>
                    <span class="navi-text font-size-lg">Profile</span>
                </a>
            </div>

            <div class="navi-item mb-2">
                <a href="{{URL::to('members/change-password')}}" class="navi-link py-4 {{$requestName == 'change_member.password' ? 'active' : ''}}">
                    <span class="navi-icon mr-2 mt-n1">
                        <i class="fas fa-user-lock icon-md"></i>
                    </span>
                    <span class="navi-text font-size-lg">Change Password</span>
                </a>
            </div>

            {{--<div class="navi-item mb-2">
                <a href="{{URL::to('members/settings')}}" class="navi-link py-4 {{$requestName == 'change_member.settings' ? 'active' : ''}}">
                    <span class="navi-icon mr-2 mt-n1">
                        <i class="fas fa-user-cog icon-md"></i>
                    </span>
                    <span class="navi-text font-size-lg">Settings</span>
                </a>
            </div>--}}
        </div>
    </div>
    <!--end::Body-->
</div>
