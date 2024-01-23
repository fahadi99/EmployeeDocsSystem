<form action="{{route('documents.add.comment', ['id' => $mainDocument->id])}}" method="post" id="note-add-form">
    <!--begin::Body-->
    <div class="d-block">
        {!! Form::textarea('comments',null, ['id' => 'kt_summernote_1','class'=>'summernote', 'rows' => 2, 'cols' => 88, 'style' => 'resize:none']) !!}
        @CSRF
    </div>
    <div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5 border-top">
        {{--<div class="d-flex align-items-center mr-3">
            <div class="btn-group mr-4">
                <div class="form-group mb-0 mr-5">
                    <div class="checkbox-inline">
                        <label class="checkbox">
                            <input type="checkbox" value="1" name="is_private">
                            <span></span>Private</label>

                    </div>
                </div>
                {{--                                    <input type="file">--}}
         {{--  </div>
        </div>  --}}
        <div class="d-flex align-items-center">
            <button type="submit" id="notesAddFormButton" class="btn btn-primary">Add</button>
        </div>
    </div>
</form>

<form>
  <div class="d-block">
    <div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5 border-top">
     <div class="container" >
       <div class="row">
         <div class="col-md-6" id="documentVoiceRecorderDiv">
            <audio id="recorder" muted hidden></audio>
            <input name="document_id" id="documentIdValue" type="hidden" value="{{$mainDocument->id}}">
            <a id="start" >
                <span class="svg-icon svg-icon-primary svg-icon-2x"  style="color: red"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Devices/Mic.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M12.9975507,17.929461 C12.9991745,17.9527631 13,17.9762852 13,18 L13,21 C13,21.5522847 12.5522847,22 12,22 C11.4477153,22 11,21.5522847 11,21 L11,18 C11,17.9762852 11.0008255,17.9527631 11.0024493,17.929461 C7.60896116,17.4452857 5,14.5273206 5,11 L7,11 C7,13.7614237 9.23857625,16 12,16 C14.7614237,16 17,13.7614237 17,11 L19,11 C19,14.5273206 16.3910388,17.4452857 12.9975507,17.929461 Z" fill="#000000" fill-rule="nonzero"/>
                        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 8.000000) rotate(-360.000000) translate(-12.000000, -8.000000) " x="9" y="2" width="6" height="12" rx="3"/>
                    </g>
                </svg></span>
            </a>
            &nbsp;&nbsp;
            <a id="stop">
            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Code/Error-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                    <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                </g>
            </svg></span>
            </a>
        </div>
        <div class="col-md-6">
        </div>

       <div class="col-md-6" style=" display:none; ">
            <br>
            <span>Saved Recording</span>
            <audio id="player" controls></audio>
        </div>

       </div>
    </div>
    </div>
  </div>
</form>


