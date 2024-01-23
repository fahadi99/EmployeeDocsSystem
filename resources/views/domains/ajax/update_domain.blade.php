{!! Form::open(['action','DomainsController@update','id'=>'domains_update_form','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
{{ Form::hidden('domain_id',isset($domain)?$domain->id:null, array('id' => 'domain_id')) }}

<div class="form-group">
    {!! Form::label('name','Name: <span class="text-danger">*</span>', ["class"=>"control-label"], false) !!}
    {!! Form::text("name",isset($domain)?$domain->name:null,["class"=>"form-control alphanumeric".($errors->has('name')?" is-invalid":"")
    ,"autofocus"
    ,"placeholder"=>"Name"
    ,"required"]) !!}
</div>

<div class="form-group">
    {!! Form::label('address','Address:', ["class"=>"control-label"], false) !!}
    {!! Form::text("address",isset($domain)?$domain->address:null,["class"=>"form-control".($errors->has('address')?" is-invalid":"")
    ,"autofocus"
    ,"placeholder"=>"Address"
    ,"required"]) !!}
</div>

<div class="form-group">
    {!! Form::label('phone','Phone:', ["class"=>"control-label"], false) !!}
    {!! Form::text("phone",isset($domain)?$domain->phone:null,["class"=>"form-control".($errors->has('phone')?" is-invalid":"")
    ,"autofocus"
    ,"placeholder"=>"Phone"
    ,"required"]) !!}
</div>

<div class="form-group">
    {!! Form::label('latitude','Latitude:', ["class"=>"control-label"], false) !!}
    {!! Form::text("latitude",isset($domain)?$domain->latitude:null,["class"=>"form-control".($errors->has('latitude')?" is-invalid":"")
    ,"autofocus"
    ,"placeholder"=>"Latitude"
    ,"required"]) !!}
</div>

<div class="form-group">
    {!! Form::label('longitude','Longitude:', ["class"=>"control-label"], false) !!}
    {!! Form::text("longitude",isset($domain)?$domain->longitude:null,["class"=>"form-control".($errors->has('longitude')?" is-invalid":"")
    ,"autofocus"
    ,"placeholder"=>"longitude"
    ,"required"]) !!}
</div>

<div class="form-group justify-content-center row">
    <label class="col-xl-3 col-lg-3 col-form-label">Avatar
        <span class="text-primary font-size-h5">*</span>
    </label>

    <div class="col-lg-9 col-xl-6">
        <div class="image-input image-input-outline" id="kt_image_2">
            <div class="image-input-wrapper" style="background-image: url({{getDomainImage($domain->picture)}})"></div>
            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" name="domain_avatar" id="profile_avatar">
                <input type="hidden" name="domain_avatar_remove" value="0">
            </label>
            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
                <i class="ki ki-bold-close icon-xs text-muted"></i>
            </span>
        </div>
        <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
    </div>
</div>

<div class="form-group">
    {!! Form::label('status','Status:', ["class"=>"control-label"], false) !!}
        <div class="radio-inline">
            <label class="radio radio-primary">
            {!! Form::radio('status', 1 ,isset($domain)?$domain->status==1?true:false : true ) !!}
            <span></span>Active</label>
            <label class="radio radio-primary">
            {!! Form::radio('status', 0, isset($domain)?$domain->status==0?true:false : false) !!}
            <span></span>Inactive</label>
        </div>
</div>

{!! Form::close() !!}
