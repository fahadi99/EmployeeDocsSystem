@extends('layout.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    @include('include.member_menu')

                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">

                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid" id="settings_page">
            <!--begin::Container-->
            <div class="container">
                <div class="row">
                    <button class="btn btn-light-dark btn-sm custom-offcanvas-open mb-5 d-xxl-none ml-12" data-target="kt_profile_aside"><i class="flaticon-cogwheel-2 icon-md " ></i> User Menu</button>
                    <div class="col-xl-12">
                        <div class="d-flex flex-row">
                            <!--begin::Aside-->
                            @include('admin.include.left-aside')
                            <!--end::Aside-->
                            <!--begin::Content-->
                            <div class="flex-row-fluid ml-lg-8 mb-5" >
                                <div class="card card-custom card-stretch">
                                    <!--begin::Header-->
                                    <div class="card-header py-3">
                                        <div class="card-title align-items-start flex-column">
                                            <h3 class="card-label font-weight-bolder text-dark pt-3">{{$topParent->name}}</h3>
                                        </div>

                                    </div>
                                    <div class="card-body" >
                                        <div class="row">
                                            <div class="col-3">
                                                <ul class="nav flex-column nav-pills">
                                                    @foreach($topParent['child'] as $key=>$child)
                                                            <li class="nav-item mb-2">
                                                                <a class="nav-link {{$key++ == 0 ? 'active' : ''}}" id="slug-{{$child->slug}}"
                                                                   data-toggle="tab" href="#slug-{{$child->slug . "_tab"}}">
                                                                    <span class="nav-icon">
                                                                        <i class="flaticon2-chat-1"></i>
                                                                    </span>
                                                                    <span class="nav-text">{{$child->name}}</span>
                                                                </a>
                                                            </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-9">
                                                <div class="tab-content" id="myTabContent5">
                                                    @foreach($topParent['child'] as $key=>$child)
                                                            <div class="tab-pane fade {{$key++ == 0 ? 'active show' : ''}}" id="slug-{{$child->slug}}_tab" role="tabpanel" aria-labelledby="slug-{{$child->slug}}">
                                                                    @if(count($child->rights))
                                                                        <div class="form-group">
                                                                            <label class="font-weight-bolder mb-5">Base Permission</label>
                                                                            @foreach($child->rights as $right)
                                                                                <div class="checkbox-inline">
                                                                                    <label class="checkbox mb-5 mr-10">
                                                                                        @php $name = $right->slug . '-3-0' @endphp
                                                                                        <input type="checkbox" name="Checkboxes2"
                                                                                               {{checkPersonPermission($name, $data->personRights) ? 'checked' : ''}}
                                                                                               class="right-radio-update" data-slug="{{$right->slug}}" data-type = "3" data-type-id = "0" data-member-id="{{$data->member_id}}"
                                                                                        >
                                                                                        <span></span>{{$right->name}}
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif



                                                                    @foreach($child['subChild'] as $key=>$nestedChild)
                                                                        <div class="form-group">
                                                                            @if(count($nestedChild->rights))
                                                                                <label class="font-weight-bolder">{{$nestedChild->name}}</label>
                                                                                <div class="checkbox-inline">
                                                                                    @foreach($nestedChild->rights as $nestedRights)
                                                                                        <label class="checkbox mb-5 mr-10">
                                                                                            @php $name = $nestedRights->slug . '-3-0'  @endphp
                                                                                            <input type="checkbox" name="{{$name}}"
                                                                                                   {{checkPersonPermission($name, $data->personRights) ? 'checked' : ''}}
                                                                                                   class="right-radio-update" data-slug="{{$nestedRights->slug}}" data-type = "3" data-type-id = "0" data-member-id="{{$data->member_id}}"
                                                                                            >
                                                                                            <span></span>{{$nestedRights->name}}
                                                                                        </label>
                                                                                    @endforeach
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    @endforeach

                                                            </div>

                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection
