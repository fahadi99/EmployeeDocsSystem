<div class="cursor-pointer shadow-xs {{$index == 0 ? 'toggle-on' : 'toggle-off'}}" data-inbox="message">
    <!--begin::Info-->
    <div class="d-flex align-items-start card-spacer-x py-4">
        <!--begin::User Photo-->
        <span class="symbol symbol-35 mr-3 mt-5">
                        <span class="symbol-label" style="background-image: url('{{getPersonImage($note->picture)}}')"></span>
                    </span>
        <!--end::User Photo-->
        <!--begin::User Details-->
        <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
            <div class="d-flex">
                <a href="#" class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary mr-2">{{$note->first_name}} {{$note->last_name}}</a>
                <div class="font-weight-bold text-muted">{{getBasicDateFormat($note->created_at)}}</div>
            </div>

        </div>
        <div class="d-flex align-items-center">
            <div class="font-weight-bold text-muted mr-2">{{getBasicTimeFormat($note->created_at)}}</div>
        </div>
        <!--end::User Details-->
    </div>
    <!--end::Info-->
    <!--begin::Comment-->
    <div class="card-spacer-x pt-2 pb-5 toggle-off-item" id="voiceAndTextCommentsDiv">
        <!--begin::Text-->
        <div class="ml-15">

            @if ($note->comment_type == 'voice')
            <audio id="player" src="{{asset('comments/voice_notes/'.$note->comments)}}" controls></audio>
            @else
            <span style="position: relative; top:-30px; left:6px;">  {!! $note->comments  !!}</span>
            @endif

        </div>
        <!--end::Text-->
        <!--begin::Attachments-->
    {{--                            <div class="d-flex flex-column font-size-sm font-weight-bold">--}}
    {{--                                <a href="#" class="d-flex align-items-center text-muted text-hover-primary py-1">--}}
    {{--                                    <span class="flaticon2-clip-symbol text-warning icon-1x mr-2"></span>Agreement Samle.pdf</a>--}}

    {{--                            </div>--}}
    <!--end::Attachments-->
    </div>
    <!--end::Comment-->
</div>
