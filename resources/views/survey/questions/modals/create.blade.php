<div class="modal fade" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Survey <small class="text-muted">- Add</small> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action','SurveyController@add_question','id'=>'survey_question_form','class'=>'horizontal-form','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}

                <div class="form-group justify-content-center row">
                    {!! Form::label('question','Question:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        {{ Form::text('question',null,
                        ['class' => 'form-control form-control-lg form-control-solid',
                        'id'=>'question',
                         'placeholder' => 'Enter Question',
                         'required'
                    ]) }}
                    </div>
                </div>
                <div class="form-group justify-content-center row">
                    {!! Form::label('additional_info','Additional Info:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        {{ Form::textarea('additional_info',null,
                        ['class' => 'form-control form-control-lg form-control-solid',
                         'id'=>'additional_info',
                         'rows' => 3,
                         'placeholder' => 'Enter Additional Infomation',
                         'required'
                        ]) }}
                    </div>
                </div>

                <div class="form-group justify-content-center row">
                    {!! Form::label('is_optional','Optional:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        <div class="form-group">
                            <div class="radio-inline">
                                <label class="radio radio-lg">
                                    <input type="radio" checked="checked" name="is_optional" value="0" />
                                    <span></span>Required</label>
                                <label class="radio radio-lg">
                                    <input type="radio" name="is_optional" value="1" />
                                    <span></span>Optional</label>

                            </div>
                            <span class="form-text text-muted">Question is mandatory to answer or not.</span>
                        </div>
                    </div>
                </div>



                <div class="form-group justify-content-center row">
                    {!! Form::label('type','Question Type:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        <div class="form-group">
                            <div class="radio-inline">
                                <label class="radio radio-lg">
                                    <input class="question_type_option" type="radio" checked="checked" name="type" value="standard" />
                                    <span></span>Standard</label>
                                <label class="radio radio-lg">
                                    <input class="question_type_option" type="radio" name="type" value="file" />
                                    <span></span>File</label>
                                <label class="radio radio-lg">
                                    <input class="question_type_option" type="radio" name="type" value="single" />
                                    <span></span>Single Choice</label>
                                <label class="radio radio-lg">
                                    <input  class="question_type_option" type="radio" name="type" value="multiple" />
                                    <span></span>Multiple Choices</label>

                            </div>
                            <span class="form-text text-muted">Type of question, let you get more options.</span>
                        </div>
                    </div>
                </div>
                <div class="form-group justify-content-center row d-none" id="question_type_field">
                    {!! Form::label('question_options','Question Options:  <span class="text-danger font-size-h3">*</span> ',["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
                    <div class="col-lg-9 col-xl-6">
                        <div class="form-group">
                            {{Form::select('question_options[]',[],[],
                                ["class" => "form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Write Question Options",
                                "multiple" => true
                            ])}}
                            <span class="form-text text-muted">Add multiple questions options, Press Enter to add more.</span>
                        </div>
                    </div>
                </div>


              {{ Form::close() }}
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="add-question-button">Add Question</button>
            </div>
        </div>
    </div>
</div>
