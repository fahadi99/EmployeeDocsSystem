{!! Form::open(['action','RightsTypesController@update','id'=>'rights_type_update_form','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
{{ Form::hidden('right_type_id',isset($rightType)?$rightType->id:null, array('id' => 'right_type_id')) }}
<div class="form-group">

 {!! Form::label('name','Name: <span class="text-danger">*</span>', ["class"=>"control-label"], false) !!}
 {!! Form::text("name",isset($rightType)?$rightType->name:null,["class"=>"form-control".($errors->has('name')?" is-invalid":"")
 ,"autofocus"
 ,"id"=>"update_organization_name_field"
 ,"placeholder"=>"Right Type Name"
 ,"required"]) !!}


</div>
<div class="form-group">
</div>
{!! Form::close() !!}
