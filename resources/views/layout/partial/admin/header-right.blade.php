<div class="topbar">
    <div class="topbar-item">
        <div class="btn btn-icon btn-clean btn-lg mr-1" id="kt_quick_panel_toggle">
            <i class="far fa-bell icon-2x"></i>
        </div>
    </div>
    <!--begin::User-->
    <div class="topbar-item">
        <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
            <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
            <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"> @auth {{ Auth::user()->first_name }}&nbsp;{{ Auth::user()->last_name }} @endauth </span>
            <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
			    <img @auth src="{{getPersonImage(Auth::user()->picture)}}" @endauth >
			</span>
        </div>




    </div>
    <!--end::User-->
</div>
<div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10 offcanvas-off">
    <!--begin::Header-->
    <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5" kt-hidden-height="45" style="">
        <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_logs">Meeting (10)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_settings">System (6)</a>
            </li>
        </ul>
        <div class="offcanvas-close mt-n1 pr-5">
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content px-10">
        <div class="tab-content">
            <!--begin::Tabpane-->
            <div class="tab-pane fade pt-3 pr-5 mr-n5 scroll ps active show ps--active-y" id="kt_quick_panel_logs" role="tabpanel" style="height: 643px; overflow: hidden;">
                <div class="mb-5">
                    <!--begin: Item-->
                    <div class="d-flex align-items-center mb-5 pb-5 border-bottom-grey border-bottom">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40 symbol-white mr-5">
                                            <span class="symbol-label">
                                               <i class="fas fa-users icon-2x text-dark-50"></i>
                                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                            <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Meeting Invitation</a>
                            <span class="text-muted">You are invited to join <a href=""><span class="text-danger font-weight-bold">This is meeting title</span></a> at 10 Feb 2021 10.45 PM by <a href="">Aslam Malik</a></span>
                        </div>
                        <!--end::Text-->
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline ml-2 pl-1 pr-1" data-toggle="tooltip" title="" data-placement="left" data-original-title="Your Status">
                            <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown">
                                <span class="text-muted font-weight-bold"> 9min </span>
                                <span class="fas fa-arrow-down text-muted pl-2"> </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right ">
                                <a class="dropdown-item" href=""><span class="far fa-check-circle text-success mr-2 ml-2 font-size-h6"></span> Coming</a>
                                <a class="dropdown-item" href=""><span class="far fa-times-circle text-danger  text-success  mr-2 ml-2  font-size-h6"></span> Not Coming</a>
                                <a class="dropdown-item" href=""><span class="far fa-question-circle text-warning   mr-2 ml-2  font-size-h6"></span> Maybe</a>

                            </div>

                        </div>

                        <!--end::Dropdown-->
                    </div>
                    <!--end: Item-->

                    <!--begin: Item-->
                    <div class="d-flex align-items-center mb-5 pb-5 border-bottom-grey border-bottom">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40 symbol-white mr-5">
                                            <span class="symbol-label">
                                               <i class="fas fa-plus-circle icon-2x text-dark-50"></i>
                                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                            <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg"><span class="font-weight-bold">Notes Added.</span></a>
                            <span class="text-muted">
                                                <a href="">Rehman Saeed</a> added a public note in <a href=""><span class="text-green">This is meeting Title</span></a>
                                            </span>
                        </div>
                        <!--end::Text-->
                        <!--begin::Dropdown-->
                        <div class=" ml-2 pl-1 pr-1">
                            <span class="text-muted font-weight-bold"> 2d </span>
                        </div>
                        <!--end::Dropdown-->
                    </div>
                    <!--end: Item-->

                    <!--begin: Item-->
                    <div class="d-flex align-items-center mb-5 pb-5 border-bottom-grey border-bottom">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40 symbol-white mr-5">
                                            <span class="symbol-label">
                                               <i class="fas fa-user-plus icon-2x text-dark-50"></i>
                                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                            <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg"><span class="font-weight-bold">User Added to meeting.</span></a>
                            <span class="text-muted">
                                                <a href="">Junaid Ahmed</a> added <a href="">Khurram Jamil</a> in <a href="">This is meeting Title</a>
                                            </span>
                        </div>
                        <!--end::Text-->
                        <div class=" ml-2 pl-1 pr-1">
                            <span class="text-muted font-weight-bold"> 1m </span>
                        </div>

                    </div>
                    <!--end: Item-->


                    <!--begin: Item-->
                    <div class="d-flex align-items-center mb-5 pb-5 border-bottom-grey border-bottom">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40 symbol-white mr-5">
                                            <span class="symbol-label">
                                               <i class="far fa-check-circle text-success  mr-1 icon-2x "></i>
                                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                            <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg"><span class="font-weight-bold">Junaid Ahmed is Coming.</span></a>
                            <span class="text-muted">
                                                <a href="#">Junaid Ahmed</a> marked coming to <a href="#">This is meeting title</a>
                                            </span>
                        </div>
                        <!--end::Text-->
                        <div class=" ml-2 pl-1 pr-1">
                            <span class="text-muted font-weight-bold"> 10d </span>
                        </div>

                    </div>
                    <!--end: Item-->

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="members/notifications" class="btn btn-light-dark btn-hover-bg-primary font-weight-lighter mt-5">View all notifications</a>
                        </div>
                    </div>

                </div>
            </div>
            <!--end::Tabpane-->

            <!--begin::Tabpane-->
            <div class="tab-pane fade pt-3 pr-5 mr-n5 scroll ps" id="kt_quick_panel_settings" role="tabpanel" style="height: 643px; overflow: hidden;">
                <div class="mb-5">
                    <!--begin: Item-->
                    <div class="d-flex align-items-center mb-5 pb-5 border-bottom-grey border-bottom">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40 symbol-white mr-5">
                            <span class="symbol-label">
                               <i class="fas fa-plus-circle icon-2x text-dark-50"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                            Password Changed
                            <span class="text-muted">
                                Password changed successfully.
                            </span>
                        </div>
                        <!--end::Text-->
                        <!--begin::Dropdown-->
                        <div class=" ml-2 pl-1 pr-1">
                            <span class="text-muted font-weight-bold"> 2d </span>
                        </div>
                        <!--end::Dropdown-->
                    </div>
                    <!--end: Item-->



                    <!--begin: Item-->
                    <div class="d-flex align-items-center mb-5 pb-5 border-bottom-grey border-bottom">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40 symbol-white mr-5">
                            <span class="symbol-label">
                               <i class="fas fa-plus-circle icon-2x text-dark-50"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                            Forgot password
                            <span class="text-muted">
                                Someone requested forgot password request.
                            </span>
                        </div>
                        <!--end::Text-->
                        <!--begin::Dropdown-->
                        <div class=" ml-2 pl-1 pr-1">
                            <span class="text-muted font-weight-bold"> 2d </span>
                        </div>
                        <!--end::Dropdown-->
                    </div>
                    <!--end: Item-->

                    <!--begin: Item-->
                    <div class="d-flex align-items-center mb-5 pb-5 border-bottom-grey border-bottom">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40 symbol-white mr-5">
                            <span class="symbol-label">
                               <i class="fas fa-plus-circle icon-2x text-dark-50"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                            Login
                            <span class="text-muted">
                                Successfully login 21 Feb 2021 5.09AM
                            </span>
                        </div>
                        <!--end::Text-->
                        <!--begin::Dropdown-->
                        <div class=" ml-2 pl-1 pr-1">
                            <span class="text-muted font-weight-bold"> 2d </span>
                        </div>
                        <!--end::Dropdown-->
                    </div>
                    <!--end: Item-->


                </div>
            </div>
        </div>
    </div>
    <!--end::Content-->
</div>
