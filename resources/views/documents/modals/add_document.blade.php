
{{--<div class="modal fade" id="documentModal"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentModalLabel"> {{$page}} <small class="text-muted">- Add</small> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" id="documentAddForm">

            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_users_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_{{$page}}_header" data-kt-scroll-wrappers="#kt_modal_add_{{$page}}_scroll" data-kt-scroll-offset="300px" style="max-height: 574px;">
               <div class="fv-row mb-7 fv-plugins-icon-container">

                {!! Form::open(['action','DocumentsController@add','id'=>'documents_add_form','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}

                <div class="form-group row">
                    {!! Form::label('subject',' Subject: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-9">
                            {!! Form::text(
                            "subject",
                            null,
                            ["class"=>"form-control form-control-lg form-control-solid".($errors->has('subject')?" is-invalid":"")
                            ,"autofocus"
                            ,"placeholder"=>"Subject of E docs"
                            ,"required"]) !!}
                        </div>
                </div>

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

                <div class="form-group row">
                {!! Form::label('dated','Date: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                <div class="col-lg-9 col-xl-9">
                <input type="date" class="form-control form-control-solid" placeholder="Enter date here" id="dated" name="dated" value="{{ isset($data)?$data['dated']:null }}" >
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
                        ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Project"])}}
                    </div>
                </div>

                <div class="form-group justify-content-center row">
                    {!! Form::label('Document Types','Document Types: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-9">
                        {{Form::select('document_type_id',$selectBoxes['document_types'],isset($data->document_type_id)?$data->document_type_id:null,
                        ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Document type"])}}
                    </div>
                </div>

                <div class="form-group justify-content-center row">
                    {!! Form::label('Document Priority','Document Priority: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-9">
                        {{Form::select('document_priority_id',$selectBoxes['document_priorities'],isset($data->document_priority_id)?$data->document_priority_id:null,
                        ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Document Priority"])}}
                    </div>
                </div>

                <div class="form-group justify-content-center row">
                    {!! Form::label('Document Status','Document Status: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-9">
                        {{Form::select('document_status_id',$selectBoxes['document_statuses'],isset($data->document_status_id)?$data->document_status_id:null,
                        ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Document Status"])}}
                    </div>
                </div>

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


                <div class="form-group justify-content-center row">
                    {!! Form::label('Categories','Categories:', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-9">
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
                </div>


                <div class="form-group justify-content-center row">
                    {!! Form::label('Is Restricted','Is restricted: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-9">
                        <div class="checkbox-inline">
                            <label class="checkbox">
                                <input type="checkbox" name="is_restricted" id="is_restricted">
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}

              </div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" id="add-documents-button" class="btn btn-primary font-weight-bold">{{$page}}</button>
            </div>
        </div>
    </div>
</div>  --}}
