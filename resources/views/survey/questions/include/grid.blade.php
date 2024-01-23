<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 bg-gray-100   pt-5 " id="survey-question-grid"  >
    <div class="card card-custom card-stretch gutter-b no-background border-none ">
        <div class="card-body pt-0 pl-0 pr-0 " id="kt_todo_view">
            @if($questions->count() > 0)
                @foreach($questions as $key => $row)
                    <div class="cursor-pointer shadow-xs toggle-off bg-white pt-5 custom_questions" data-inbox="message">
                            <!--begin::Info-->
                            <div class="d-flex align-items-start card-spacer-x py-4">
                                <!--begin::User Photo-->
                                <label class="checkbox checkbox-inline checkbox-primary flex-shrink-0 mr-3">
                                    <input type="checkbox" {{$row->status ? 'checked' : ''}} />
                                    <span></span>
                                </label>
                                <!--end::User Photo-->
                                <!--begin::User Details-->
                                <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
                                    <div class="d-flex">
                                        <a href="#" class="font-size-h5 font-weight-bolder text-dark-75 text-hover-primary mr-2">
                                            {{$row->question}}
                                        </a>
                                        <div class="font-weight-bold text-muted">
                                            <span class="label label-success label-dot mr-2"></span>Added by <span class="font-weight-bold">Junaid Ahmed</span></div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="toggle-off-item">
                                            <span class="font-weight-bold text-muted cursor-pointer" data-toggle="dropdown">to me
                                            <i class="flaticon2-down icon-xs ml-1 text-dark-50"></i></span>

                                        </div>
                                        <div class="text-muted font-weight-bold toggle-on-item mt-5" data-inbox="toggle">
                                            <span class="text-capitalize mr-5 mr-5">{{$row->type}}</span> <span class="text-muted">|</span>
                                            <span class=" mr-5 mr-5 text-{{$row->is_optional ? 'warning' : 'danger'}}">{{$row->is_optional ? 'Optional' : 'Required'}}</span> <span class="text-muted">|</span>
                                            <span class=" mr-5 mr-5" ><span class="font-weight-bold">Sort Order:</span> {{$row->sort_order}} </span>

                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="font-weight-bold text-muted mr-2"><span class="ml-5">{{getBasicDateTimeFormat($row->created_at)}}</span></div>
                                    <div class="dropdown" data-toggle="tooltip" title="Settings">
                                                                        <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="dropdown">
                                                                            <i class="ki ki-bold-more-hor icon-1x"></i>
                                                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-md">
                                            <!--begin::Navigation-->
                                            <ul class="navi navi-hover py-5">
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-drop"></i>
                                                        </span>
                                                        <span class="navi-text">Update Question</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a  class="navi-link delete-button-modal"  data-id="{{$row->id}}"
                                                        data-toggle="modal" data-target="#exampleModal3">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-drop"></i>
                                                        </span>
                                                        <span class="navi-text">Delete Question</span>
                                                    </a>
                                                </li>


                                            </ul>
                                            <!--end::Navigation-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::User Details-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Comment-->
                            <div class="card-spacer-x pt-2 pb-5 toggle-off-item">
                                <!--begin::Text-->
                                <div class="mb-1">
                                    <p>
                                        <span class="text-capitalize mr-5 mr-5">{{$row->type}}</span> <span class="text-muted">|</span>
                                        <span class=" mr-5 ml-5 text-{{$row->is_optional ? 'warning' : 'danger'}}">{{$row->is_optional ? 'Optional' : 'Required'}}</span> <span class="text-muted">|</span>
                                        <span class=" mr-5 ml-5" ><span class="font-weight-bold">Sort Order:</span> {{$row->sort_order}} </span><span class="text-muted">|</span>
                                        <span class="ml-5">{{getBasicDateTimeFormat($row->created_at)}}</span>
                                    </p>
                                    <p>
                                        <span class="font-weight-bolder">Additional Info:</span><br>
                                        {{$row->additional_info}}
                                    </p>

                                    <p>
                                        <span class="font-weight-bolder">Options:</span><br>
                                        @if($row->type == 'standard')
                                            <span>Input Field</span>
                                            {{ Form::text('name','',
                                            ['class' => 'form-control form-control-lg form-control-solid',
                                            'id'=>'survey_name',
                                             'placeholder' => 'Enter Title',
                                             'required'
                                                ])
                                            }}
                                        @endif
                                        @if($row->type == 'single')
                                            <span>Radio Field (Single)</span>
                                            @if($row->getAllOptions()->count() > 0)
                                                <div class="radio-list">
                                                    @foreach($row->getAllOptions() as $option)
                                                        <label class="radio radio-lg mb-7">
                                                            <input type="radio" name="TestRadio" />
                                                            <span></span>
                                                            <div class="font-size-lg text-dark-75 font-weight-bold">{{$option->option_text}}</div>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            @else
                                                No Option Added.
                                            @endif
                                        @endif
                                        @if($row->type == 'multiple')
                                            <span>CheckBox Field (Multiple)</span>
                                            @if($row->getAllOptions()->count() > 0)
                                                <div class="checkbox-list">
                                                    @foreach($row->getAllOptions() as $option)

                                                    <label class="checkbox checkbox-lg mb-7">
                                                        <input type="checkbox" name="TestCheck" />
                                                        <span></span>
                                                        <div class="font-size-lg text-dark-75 font-weight-bold">{{$option->option_text}}</div>
                                                    </label>

                                                    @endforeach
                                                </div>
                                            @else
                                                No Option Added.
                                            @endif

                                        @endif
                                        @if($row->type == 'file')
                                            <span>File Field</span>
                                            <input type="file" name="photo" class="form-control form-control-lg form-control-solid" />


                                        @endif

                                    </p>


                                </div>
                                <!--end::Text-->
                                <!--begin::Attachments-->
                                <div class="d-flex flex-column font-size-sm font-weight-bold">

                                </div>
                                <!--end::Attachments-->
                            </div>
                            <!--end::Comment-->
                        </div>
                @endforeach
            @else
                <div class="text-center pt-40">
                    <h1 class="h2 font-weight-bolder text-dark mb-6">There is no Question Added.</h1>
                    <div class="h4 text-dark-50 font-weight-normal"><a href="" class="btn btn-light-primary font-weight-bold ml-2">Add Question</a></div>

                </div>
            @endif
        </div>
    </div>
</div>


