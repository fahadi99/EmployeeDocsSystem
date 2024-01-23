
<div class="modal fade" id="documentUpdateModal"   tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$page}} <small class="text-muted"></small> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body pt-0 mt-0">
                <div class="card card-custom border-0">
                    <!--begin::Header-->
                    <div class="card-header card-header-tabs-line ">
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x" role="tablist">
                                <li class="nav-item mr-3">
                                    <a class="nav-link active" data-toggle="tab" id="basic_data_update_anchor" href="#basic_data_update_tab">
                                        <span class="nav-text font-weight-bold"> Basic Data </span>
                                    </a>
                                </li>
                                <li class="nav-item mr-3">
                                    <a class="nav-link disabled" data-toggle="tab" id="details_update_anchor" href="#details_update_tab">
                                        <span class="nav-text font-weight-bold"> Details </span>
                                    </a>
                                </li>
                                <li class="nav-item mr-3">
                                    <a class="nav-link disabled" data-toggle="tab" id="assignees_update_anchor" href="#assignees_update_tab">
                                        <span class="nav-text font-weight-bold">Assignees</span>
                                    </a>
                                </li>
                            </ul>
                       </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body" id="add_meeting_modal_body">
                        <div class="tab-content pt-5">
                            <!--begin::Tab Content-->
                            {{-- Form starts here --}}
                            <div class="tab-pane active" id="basic_data_update_tab" role="tabpanel">
                                <div class="container" id="basic_data_update_tab_data">

                                </div>
                            </div>
                            <!--end::Tab Content-->
                            <!--begin::Tab Content-->
                            <div class="tab-pane" id="details_update_tab" role="tabpanel">
                                <div class="container" id="details_update_tab_data">

                                </div>
                            </div>
                            <!--end::Tab Content-->
                            <!--begin::Tab Content-->
                            <div class="tab-pane" id="assignees_update_tab" role="tabpanel">
                                <div class="container" id="assignees_update_tab_data">

                                </div>
                            </div>
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        </div>
                        <!--end::Body-->
                        </div>
            </div>
        </div>
    </div>
</div>
