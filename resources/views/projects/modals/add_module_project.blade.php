<div class="modal fade" id="moduleProjectModal"  tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="false">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="moduleProjectModalLabel">E docs - {{$page}} <small class="text-muted">- Add</small> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['id'=>'modules_project_form','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}

                <div class="container">

                            <div class="form-group row">
                                {!! Form::label('module','Module : <span class="text-danger">*</span>', ["class"=>"control-label"], false) !!}
                            </div>
                            @isset($modules)
                               <div class="form-group row">
                                @foreach ($modules as $module)
                                    <div class="col-3 col-form-label">
                                        <div class="checkbox-inline">
                                            <label class="checkbox">
                                                <input type="checkbox" name="modules[]" value={{$module['id']}} @if($module['id'] === config('settings.e_docs.module_id'))
                                                   checked
                                                @endif>
                                                <span></span>

                                                @php
                                                $module_name = null;
                                                 if(strlen($module['name']) > 12) $module_name = substr($module['name'], 0, 12).'...'; else $module_name = $module['name'];
                                                @endphp

                                                @isset($module_name)
                                                  {{$module_name}}
                                                @endisset

                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endisset

                            <div class="form-group row">
                                {!! Form::label('project','Project : <span class="text-danger">*</span>', ["class"=>"control-label"], false) !!}
                                {{ Form::select("project_id" , $projects,null, ["class" => "form-control","placeholder" => "Select Project","id"=> "exampleSelect1" ])  }}
                            </div>
                    </div>

                {!! Form::close() !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" id="add_project_modules_button" class="btn btn-primary font-weight-bold">Add {{$page}}</button>
            </div>
        </div>
    </div>
</div>
