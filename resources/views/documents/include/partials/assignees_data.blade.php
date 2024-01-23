{!! Form::open(['action','DocumentsController@update_assignees','id'=>'update-assignees','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data','files'=>true]) !!}
{{ Form::hidden('assignees_document_id',isset($mainDocument)?$mainDocument->id:null, array('id' => 'document_id')) }}

<div class="form-group justify-content-center row">
    {!! Form::label('Users','Users:', ["class"=>"col-xl-3 col-lg-3 col-form-label"], false) !!}
    <div class="col-lg-9 col-xl-9">
        <select data-live-search="true" name="users[]" data-placeholder="Select Users" class="selectBoxUniqueClass form-control form-control-lg form-control-solid  w-100 selectpicker document_filters"
                placeholder="Select Users"
                multiple="multiple"
                data-actions-box="true"
                id="tagged_peron">
            @isset($selectBoxes['persons'])
            @foreach($selectBoxes['persons'] as $person)
            <option value="{{$person['id']}}"
            @isset($selectedTaggedPeople)
            @foreach ($selectedTaggedPeople as $sd)
            @if ($sd->person_id == $person['id'])
              selected
            @endif
            @endforeach
            @endisset>
                {{$person['full_name']}}
            </option>
            @endforeach
            @endisset
        </select>
    </div>
</div>

<div class="from-group row">
    <div class="col-lg-12 col-xl-12 text-right">
        <button type="submit" class="btn btn-primary font-weight-bold" id="update-assignees-button">Update Assignees</button>
    </div>
</div>
</div>

{!! Form::close() !!}
