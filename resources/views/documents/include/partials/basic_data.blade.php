{!! Form::open(['action','DocumentsController@update_basic_data','id'=>'update-basic-data-details','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
{{ Form::hidden('document_id',isset($mainDocument)?$mainDocument->id:null, array('id' => 'document_id')) }}

<div class="form-group row">
{!! Form::label('subject','Subject: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
<div class="col-lg-9 col-xl-9">
<input type="text" class="form-control form-control-solid" name="subject" value="{{isset($mainDocument)?$mainDocument->subject:null}}" placeholder="Enter Subject here">
</div>
</div>

<div class="form-group row">
{!! Form::label('dated','Date: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
<div class="col-lg-9 col-xl-9">
<input type="date" class="form-control form-control-solid" placeholder="Enter date here" id="date" name="dated" value="{{Carbon\Carbon::parse($mainDocument->dated)->format('Y-m-d')}}" >
</div>
</div>

<div class="form-group row">
{!! Form::label('Document Types','Document Types: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
<div class="col-lg-9 col-xl-9">
{{Form::select('document_type_id',$selectBoxes['document_types'],isset($mainDocument->document_type_id)?$mainDocument->document_type_id:null,
["class" => "form-control form-control-lg form-control-solid select2 w-100 selectBoxUniqueClass", "id"=>"document_type_id" ,"placeholder" => "Select Document type"])}}
</div>
</div>


<div class="form-group row">
{!! Form::label('Document Priority','Document Priority: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
<div class="col-lg-3 col-xl-3">
{{Form::select('document_priority_id',$selectBoxes['document_priorities'],isset($mainDocument->document_priority_id)?$mainDocument->document_priority_id:null,
["class" => "form-control form-control-lg form-control-solid select2 w-100 selectBoxUniqueClass", "placeholder" => "Select Document Priority"])}}
</div>
{!! Form::label('Document Status','Document Status: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
<div class="col-lg-3 col-xl-3">
{{Form::select('document_status_id',$selectBoxes['document_statuses'],isset($mainDocument->document_status_id)?$mainDocument->document_status_id:null,
["class" => "form-control form-control-lg form-control-solid select2 w-100 selectBoxUniqueClass", "placeholder" => "Select Document Status"])}}
</div>
</div>


<div class="from-group row">
{!! Form::label('Document Category','Document Category: <span class="text-danger">*</span>', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
<div class="col-lg-3 col-xl-3">
<select data-live-search="true" name="categories[]" data-placeholder="Select Categories" class="selectBoxUniqueClass form-control form-control-lg form-control-solid  w-100 selectpicker document_filters"
placeholder="Select Categories"
multiple="multiple"
data-actions-box="true"
id="Taggedcategory">
@isset($selectBoxes['categories'])
@foreach($selectBoxes['categories'] as $key => $c)
<option value="{{$key}}"  @isset($selectedCategores)
@foreach ($selectedCategores as $sd)
@if ($sd->category_id == $key)
  selected
@endif
@endforeach
@endisset>
 {{$c}}
</option>
@endforeach
@endisset
</select>
</div>

{!! Form::label('Is Restricted','Is restricted: <span class="text-danger">*</span>', ["class"=>"col-xl-2 col-lg-2"], false) !!}
<div class="col-lg-3 col-xl-3">
    <div class="checkbox-inline">
        <label class="checkbox">
            <input type="checkbox" class="is_restricted" name="is_restricted" style=" margin-right :80px margin-left:-20px !important; !important; margin-top:10px !important; " @if($mainDocument->is_restricted)
            checked
            @endif value="{{isset($mainDocument->is_restricted)?$mainDocument->is_restricted:null}}" id="is_restricted">
            <span></span>
        </label>
    </div>
</div>
</div>
<br>

<div class="from-group row">
    <div class="col-lg-12 col-xl-12 text-right">
        <button type="submit" class="btn btn-primary font-weight-bold" id="update-basic-data-button">Update Basic Data</button>
    </div>
</div>

{!! Form::close() !!}
