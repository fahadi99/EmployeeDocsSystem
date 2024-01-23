{!! Form::open(['action','DocumentsController@update_details','id'=>'update-details','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
{{ Form::hidden('document_id',isset($mainDocument)?$mainDocument->id:null, array('id' => 'document_id')) }}

<div class="form-group row">
    {!! Form::label('short_description','Short Description: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
    <div class="col-lg-9 col-xl-9">
    <textarea id=""
    name="short_description" rows="2" placeholder="Enter Short description here" value="" class="form-control form-control-lg form-control-solid{{($errors->has("short_description")?" is-invalid":"")}}" cols="20">{{isset($mainDocument)?$mainDocument->short_description:null}}
   </textarea>
    </div>
    </div>

    <div class="form-group row">
    {!! Form::label('description',' Description:', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
    <div class="col-lg-9 col-xl-9">
    <textarea id=""
    name="description" rows="4" value="" placeholder="Enter Description here" class="form-control form-control-lg form-control-solid{{($errors->has("description")?" is-invalid":"")}}" cols="50">{{isset($mainDocument)?$mainDocument->description:null}}
   </textarea>
    </div>
    </div>

    <div class="form-group justify-content-center row">
        {!! Form::label('Organization','Organization:', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
        <div class="col-lg-9 col-xl-9">
            {{Form::select('organization_id', $selectBoxes['organizations'],isset($mainDocument->organization_id)?$mainDocument->organization_id:null,
            ["class" => "selectBoxUniqueClass form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Organization"])}}
        </div>
    </div>

    <div class="form-group justify-content-center row">
        {!! Form::label('Department','Department:', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
        <div class="col-lg-9 col-xl-9">
            {{Form::select('department_id',$selectBoxes['departments'],isset($mainDocument->department_id)?$mainDocument->department_id:null,
            ["class" => "selectBoxUniqueClass form-control form-control-lg form-control-solid select2 w-100", "placeholder" => "Select Department"])}}
        </div>
    </div>

    <div class="form-group justify-content-center row">
        {!! Form::label('Domian','Domain:', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
        <div class="col-lg-9 col-xl-9">
            {{Form::select('domain_id',$selectBoxes['domains'],isset($mainDocument->domain_id)?$mainDocument->domain_id:null,
            ["class" => "form-control form-control-lg form-control-solid  w-100", "placeholder" => "Select Domain"])}}
        </div>
    </div>

    <div class="form-group justify-content-center row">
        {!! Form::label('Project','Project:', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
        <div class="col-lg-9 col-xl-9">
            {{Form::select('project_id',$selectBoxes['projects'],isset($mainDocument->project_id)?$mainDocument->project_id:null,
            ["class" => "form-control form-control-lg form-control-solid w-100", "placeholder" => "Select Project"])}}
        </div>
    </div>

<div class="from-group row">
    <div class="col-lg-12 col-xl-12 text-right">
        <button type="submit" class="btn btn-primary font-weight-bold" id="update-details-button">Update Details</button>
    </div>
</div>

{!! Form::close() !!}
