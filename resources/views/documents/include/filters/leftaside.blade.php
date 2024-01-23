<div class="card card-custom card-stretch">
    <!--begin::Body-->
    <div class="card-body px-5">
        <!--begin:Nav-->
        <div class="navi navi-hover navi-active navi-link-rounded navi-bold navi-icon-center navi-light-icon">



            <div class="navi-section mt-7 mb-2 font-size-h6 font-weight-bold pb-0  pl-0">Projects</div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <select data-live-search="true" class="form-control selectpicker document_filters" multiple="multiple" name="f_project_id" data-actions-box="true" id="project">
                        @isset($selectBoxes['projects'])
                        @foreach($selectBoxes['projects'] as $key => $c)
                        <option value="{{$key}}"
                            {{in_array($key, $filters['project']) ? 'selected="selected"' : ''}}
                        >{{$c}}
                        </option>
                         @endforeach
                        @endisset
                    </select>
                </div>
            </div>

            <div class="navi-section mt-7 mb-2 font-size-h6 font-weight-bold pb-0 pl-0">Date Range</div>
            <div class="form-group row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<input type='text' class="form-control document_filters" id="kt_daterangepicker_1" name="date_range_filter" placeholder="Select Date Range" type="text"/>
				</div>
			</div>

            <div class="navi-section mt-7 mb-2 font-size-h6 font-weight-bold pb-0  pl-0">Categories</div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <select data-live-search="true" class="form-control selectpicker document_filters" multiple="multiple" data-actions-box="true" id="documentCategory">
                        @isset($selectBoxes['categories'])
                        @foreach($selectBoxes['categories'] as $key => $c)
                        <option value="{{$key}}"
                            {{in_array($key, $filters['category']) ? 'selected="selected"' : ''}}
                        >{{$c}}
                        </option>
                         @endforeach
                        @endisset
                    </select>
                </div>
            </div>

            <div class="navi-section mt-7 mb-2 font-size-h6 font-weight-bold pb-0  pl-0">Document Tags</div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <select data-live-search="true" class="form-control selectpicker document_filters" multiple="multiple" data-actions-box="true" id="tagged_peron">
                        @isset($selectBoxes['persons'])
                        @foreach($selectBoxes['persons'] as $person)
                        <option value="{{$person['id']}}"
                            {{in_array($person['id'], $filters['tagged_peron']) ? 'selected="selected"' : ''}}
                        >{{$person['full_name']}}
                        </option>
                        @endforeach
                        @endisset
                    </select>
                </div>
            </div>

            <div class="navi-section mt-7 mb-2 font-size-h6 font-weight-bold pb-0 pl-0">Document Owners</div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <select data-live-search="true" class="form-control selectpicker document_filters" multiple="multiple" data-actions-box="true" id="owner_id">
                       @isset($selectBoxes['persons'] )
                       @foreach($selectBoxes['persons'] as $person)
                       <option value="{{$person['id']}}"
                           {{in_array($person['id'], $filters['owner']) ? 'selected="selected"' : ''}}
                       >{{$person['full_name']}}
                       </option>
                       @endforeach
                       @endisset
                    </select>
                </div>
            </div>

            <!--end:Item-->
            <!--begin:Item-->

            <!--begin:Section-->
            <div class="navi-section mt-7 mb-2 font-size-h6 font-weight-bold pb-0 pl-0">Voting Types</div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <select data-live-search="true" class="form-control selectpicker document_filters" multiple="multiple" data-actions-box="true" id="voting_type">
                        @isset($selectBoxes['voting_types'])
                        @foreach($selectBoxes['voting_types'] as $key => $c)
                        <option value="{{$key}}"
                            {{in_array($key, $filters['voting_type']) ? 'selected="selected"' : ''}}
                        >{{$c}}
                        </option>
                         @endforeach
                        @endisset
                    </select>
                </div>
            </div>


            <!--begin:Section-->
            <div class="navi-section mt-7 mb-2 font-size-h6 font-weight-bold pb-0 pl-0">Domains</div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <select data-live-search="true" class="form-control selectpicker document_filters" multiple="multiple" data-actions-box="true" id="domain_id">
                        @isset($selectBoxes['domains'])
                        @foreach($selectBoxes['domains'] as $key => $c)
                        <option value="{{$key}}"
                            {{in_array($key, $filters['domain']) ? 'selected="selected"' : ''}}
                        >{{$c}}
                        </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>

            <!--begin:Section-->
            <div class="navi-section mt-7 mb-2 font-size-h6 font-weight-bold pb-0 pl-0">Organizations</div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <select data-live-search="true" class="form-control selectpicker document_filters" multiple="multiple" data-actions-box="true" id="organization_id">
                        @isset($selectBoxes['organizations'])
                        @foreach($selectBoxes['organizations'] as $key => $c)
                        <option value="{{$key}}"
                            {{in_array($key, $filters['organization']) ? 'selected="selected"' : ''}}
                        >{{$c}}
                        </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>

            <!--begin:Section-->
            <div class="navi-section mt-7 mb-2 font-size-h6 font-weight-bold pb-0 pl-0">Departments</div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <select data-live-search="true" class="form-control selectpicker document_filters" multiple="multiple" data-actions-box="true" id="department_id">
                        @isset($selectBoxes['departments'])
                        @foreach($selectBoxes['departments'] as $key => $c)
                        <option value="{{$key}}"
                            {{in_array($key, $filters['department']) ? 'selected="selected"' : ''}}
                        >{{$c}}
                        </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>


        </div>
        <!--end:Nav-->
    </div>
    <!--end::Body-->
</div>
