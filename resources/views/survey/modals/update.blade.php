<div class="modal fade" id="exampleModal2"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content" id="update-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="example2ModalLabel"><small class="text-muted"></small> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action','SurveyController@update','id'=>'update_form','class'=>'horizontal-form','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}

                <div class="form-group justify-content-center row">
                    {!! Form::label('name','Survey Name:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        {{ Form::text('name',null,
                        ['class' => 'form-control form-control-lg form-control-solid',
                        'id'=>'survey_name',
                         'placeholder' => 'Enter Title',
                         'required'
                    ]) }}
                    </div>
                </div>
                <div class="form-group justify-content-center row">
                    {!! Form::label('short_description','Short Description:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        {{ Form::textarea('short_description',null,
                        ['class' => 'form-control form-control-lg form-control-solid',
                         'id'=>'short_description',
                         'rows' => 3,
                         'placeholder' => 'Enter Short Description',
                         'required'
                        ]) }}
                    </div>
                </div>
                <div class="form-group justify-content-center row">
                    {!! Form::label('long_description','Long Description:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        {{ Form::textarea('long_description',null,
                        ['class' => 'form-control form-control-lg form-control-solid',
                         'id'=>'long_description2',
                         'rows' => 7,
                         'placeholder' => 'Enter Long Description',
                         'required'
                        ]) }}
                    </div>
                </div>

                <div class="form-group justify-content-center row">
                    {!! Form::label('start_date','Start Date:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group date" id="kt_datetimepicker_1" data-target-input="nearest">
                            {!! Form::text("start_date",null,["class"=>"form-control datetimepicker-input".($errors->has('start_date')?" is-invalid":"")
                            ,"autofocus"
                            ,"id" => "start_date"
                            ,"placeholder"=>"Select date &amp; time"
                            ,"data-target"=>"#kt_datetimepicker_1"
                            ,"required"]) !!}
                            <div class="input-group-append" data-target="#kt_datetimepicker_1" data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="ki ki-calendar"></i>
                                                    </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group justify-content-center row">
                    {!! Form::label("end_date","End Date",["class"=>"col-xl-3 col-lg-3  col-form-label"]) !!}
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group date" id="kt_datetimepicker_2" data-target-input="nearest">
                            {!! Form::text("end_date",null,["class"=>"form-control datetimepicker-input".($errors->has('end_date')?" is-invalid":"")
                            ,"autofocus"
                            ,"id" => "end_date"
                            ,"placeholder"=>"Select date &amp; time"
                            ,"data-target"=>"#kt_datetimepicker_2"
                            ,"required"]) !!}
                            <div class="input-group-append" data-target="#kt_datetimepicker_2" data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="ki ki-calendar"></i>
                                                    </span>
                            </div>
                        </div>
                    </div>
                </div>


                {{ Form::hidden('survey_id', '', array('id' => 'survey_id')) }}

                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="update-button">Update Survey</button>
            </div>
        </div>
    </div>
</div>
