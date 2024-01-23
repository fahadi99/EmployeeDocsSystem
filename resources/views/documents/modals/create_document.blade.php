
    <div class="modal fade" id="documentCreateModal"   tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
        <div class="modal-dialog  modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$page}} <small class="text-muted"></small> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body pt-0 mt-0">

                   {{-- <div class="alert alert-custom alert-outline-danger fade show mb-5" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">You Don't have permission to create meeting</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                            </button>
                        </div>
                    </div>  --}}

                    <div class="card card-custom border-0">
                        <!--begin::Header-->
                        <div class="card-header card-header-tabs-line ">
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x" role="tablist">
                                    <li class="nav-item mr-3">
                                        <a class="nav-link active" data-toggle="tab" id="basic_data_anchor" href="#basic_data_tab">
                                            <span class="nav-text font-weight-bold"> Basic Data <span class="text-danger">*</span> </span>
                                        </a>
                                    </li>
                                    <li class="nav-item mr-3">
                                        <a class="nav-link disabled" data-toggle="tab" id="details_anchor" href="#details_tab">
                                            <span class="nav-text font-weight-bold"> Details <span class="text-danger">*</span> </span>
                                        </a>
                                    </li>
                                    <li class="nav-item mr-3">
                                        <a class="nav-link disabled" data-toggle="tab" id="assignees_anchor" href="#assignees_tab">
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
                                <div class="tab-pane active" id="basic_data_tab" role="tabpanel">
                                    {!! Form::open(['action','DocumentsController@add_basic_data','id'=>'basic-data-details','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}

                                       <div class="form-group row">
                                        {!! Form::label('subject','Subject: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                        <div class="col-lg-9 col-xl-9">
                                            <input type="text" class="form-control form-control-solid" name="subject" value="" placeholder="Enter Subject here">
                                        </div>
                                        </div>

                                        <div class="form-group row">
                                        {!! Form::label('dated','Date: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                        <div class="col-lg-9 col-xl-9">
                                        <input type="date" class="form-control form-control-solid" placeholder="Enter date here" id="date" name="dated" value="{{date('Y-m-d')}}" >
                                        </div>
                                        </div>

                                        <div class="form-group row">
                                        {!! Form::label('file','File: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                        <div class="col-lg-9 col-xl-9">
                                        <input type="file" name="document_file" class="" value="" id="file">
                                        </div>
                                        </div>

                                        <div class="form-group row">
                                        {!! Form::label('Document Types','Document Types: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                        <div class="col-lg-9 col-xl-9">
                                        {{Form::select('document_type_id',$selectBoxes['document_types'],isset($data->document_type_id)?$data->document_type_id:null,
                                            ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Document type"])}}
                                        </div>
                                        </div>


                                        <div class="form-group row">
                                        {!! Form::label('Document Priority','Document Priority: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                        <div class="col-lg-3 col-xl-3">
                                        {{Form::select('document_priority_id',$selectBoxes['document_priorities'],isset($data->document_priority_id)?$data->document_priority_id:null,
                                        ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Document Priority"])}}
                                        </div>
                                        {!! Form::label('Document Status','Document Status: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                        <div class="col-lg-3 col-xl-3">
                                        {{Form::select('document_status_id',$selectBoxes['document_statuses'],isset($data->document_status_id)?$data->document_status_id:null,
                                        ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Document Status"])}}
                                        </div>
                                        </div>

                                        <div class="from-group row">
                                        {!! Form::label('Document Category','Document Category: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                        <div class="col-lg-3 col-xl-3">
                                        <select data-live-search="true" name="categories[]" data-placeholder="Select Categories" class="form-control form-control-lg form-control-solid  w-100 selectpicker document_filters"
                                        placeholder="Select Categories"
                                        multiple="multiple"
                                        data-actions-box="true"
                                        id="Taggedcategory">
                                        @isset($selectBoxes['categories'])
                                        @foreach($selectBoxes['categories'] as $key => $c)
                                        <option value="{{$key}}"> {{$c}}  </option>
                                        @endforeach
                                        @endisset
                                        </select>
                                        </div>

                                        {!! Form::label('Is Restricted','Is restricted:', ["class"=>"col-xl-2 col-lg-2 "], false) !!}
                                        <div class="col-lg-1 col-xl-1">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="is_restricted" id="is_restricted" class=" mt-5 mr-5" style=" margin-right :80px margin-left:-20px !important; !important; margin-top:10px !important; ">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        </div>
                                        <br>

                                        <div class="from-group row">
                                            <div class="col-lg-12 col-xl-12 text-right">
                                                <button class="btn btn-default font-weight-bold resetDocumentButtonRefresh ">Cancel</button>
                                                <button type="submit" class="btn btn-primary font-weight-bold" id="add-basic-data-button">Add Basic Data</button>
                                            </div>
                                        </div>

                                    {!! Form::close() !!}
                                </div>
                                <!--end::Tab Content-->
                                <!--begin::Tab Content-->
                                <div class="tab-pane" id="details_tab" role="tabpanel">

                                    {!! Form::open(['action','DocumentsController@add_details','id'=>'add-details','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                                    {{ Form::hidden('details_document_id',null, array('id' => 'details_document_id')) }}

                                    <div class="form-group row">
                                    {!! Form::label('short_description','Short Description: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                    <div class="col-lg-9 col-xl-9">
                                    <textarea id=""
                                    name="short_description" rows="2" placeholder="Enter Short description here" class="form-control form-control-lg form-control-solid{{($errors->has("short_description")?" is-invalid":"")}}" cols="20"></textarea>
                                    </div>
                                    </div>

                                    <div class="form-group row">
                                    {!! Form::label('description',' Description: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                    <div class="col-lg-9 col-xl-9">
                                    <textarea id=""
                                    name="description" rows="4" placeholder="Enter Description here" class="form-control form-control-lg form-control-solid{{($errors->has("description")?" is-invalid":"")}}" cols="50"></textarea>
                                    </div>
                                    </div>

                                    <div class="form-group justify-content-center row">
                                        {!! Form::label('Organization','Organization: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                        <div class="col-lg-9 col-xl-9">
                                            {{Form::select('organization_id', $selectBoxes['organizations'],isset($data->organization_id)?$data->organization_id:null,
                                            ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Organization"])}}
                                        </div>
                                    </div>

                                    <div class="form-group justify-content-center row">
                                        {!! Form::label('Department','Department: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                        <div class="col-lg-9 col-xl-9">
                                            {{Form::select('department_id',$selectBoxes['departments'],isset($data->department_id)?$data->department_id:null,
                                            ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Department"])}}
                                        </div>
                                    </div>

                                    <div class="form-group justify-content-center row">
                                        {!! Form::label('Domian','Domain: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                        <div class="col-lg-9 col-xl-9">
                                            {{Form::select('domain_id',$selectBoxes['domains'],isset($data->domain_id)?$data->domain_id:null,
                                            ["class" => "form-control form-control-lg form-control-solid  w-100", "placeholder" => "Select Domain"])}}
                                        </div>
                                    </div>

                                    <div class="form-group justify-content-center row">
                                        {!! Form::label('Project','Project: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                        <div class="col-lg-9 col-xl-9">
                                            {{Form::select('project_id',$selectBoxes['projects'],isset($data->project_id)?$data->project_id:null,
                                            ["class" => "form-control form-control-lg form-control-solid w-100", "placeholder" => "Select Project"])}}
                                        </div>
                                    </div>

                                    <div class="from-group row">
                                        <div class="col-lg-12 col-xl-12 text-right">
                                            <button class="btn btn-default font-weight-bold resetDocumentButtonRefresh">Cancel</button>
                                            <button type="submit" class="btn btn-primary font-weight-bold" id="add-details-button">Add Details</button>
                                        </div>
                                    </div>

                                    {!! Form::close() !!}
                                </div>
                                <!--end::Tab Content-->
                                <!--begin::Tab Content-->
                                <div class="tab-pane" id="assignees_tab" role="tabpanel">
                                        <div class="container">
                                            {!! Form::open(['action','DocumentsController@add_assignees','id'=>'add-assignees','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
                                            {{ Form::hidden('assignees_document_id',null, array('id' => 'assignees_document_id')) }}

                                            <div class="form-group justify-content-center row">
                                                {!! Form::label('Users','Users:', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                                                <div class="col-lg-9 col-xl-9">
                                                    <select data-live-search="true" name="users[]" data-placeholder="Select Users" class="form-control form-control-lg form-control-solid  w-100 selectpicker document_filters"
                                                            placeholder="Select Users"
                                                            multiple="multiple"
                                                            data-actions-box="true"
                                                            id="tagged_peron">
                                                        @isset($selectBoxes['persons'])
                                                        @foreach($selectBoxes['persons'] as $person)
                                                        <option value="{{$person['id']}}"
                                                        >{{$person['full_name']}}
                                                        </option>
                                                        @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="from-group row">
                                                <div class="col-lg-12 col-xl-12 text-right">
                                                    <button type="submit" class="btn btn-primary font-weight-bold" id="add-assignees-button">Add Assignees</button>
                                                </div>
                                            </div>
                                        </div>

                                        {!! Form::close() !!}
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
