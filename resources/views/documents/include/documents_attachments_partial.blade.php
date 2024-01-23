@isset($attachments)
@if($attachments->count() > 0)
    @foreach($attachments as $attachment)
        <a href="{{route('documents.file.read', [ 'id'=> $mainDocument->id, 'file_id' => $attachment->id])}}"
            class="d-flex align-items-center text-muted text-hover-primary py-1">
            <span class="flaticon2-clip-symbol text-warning icon-1x mr-2"></span>{{$attachment->name}}</a>
    @endforeach
@endif
@endisset

