@extends('layout.master')
@section('styles')
<style>
div#documentAddForm{
  width: auto;
  height: auto;
  overflow: scroll;
  overflow-x:hidden;
}
</style>
<link src="{{URL::to('assets/components/stepwizard/scripts.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
@php $page = 'shared_document'; @endphp
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Mobile Toggle-->
                <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                    <span></span>
                </button>
                <!--end::Mobile Toggle-->
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Shared Document</h5>
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                {{-- <span class="btn btn-light-primary btn-sm text-uppercase font-weight-bolder" data-toggle="modal" data-target="#documentModal">New E doc</span>
                &nbsp; --}}
            </div>
            <!--end::Toolbar-->
        </div>
    </div>


    <div class="container">
       <div class="row">
        <div class="col-md-12 justify-content-center" style="padding: 250px;   margin: auto;
        width: 50%;
        padding: 10px;">
           <h1>Document link</h1>
           <h3 > {{$shared_document_url}} </h3>
           <div class="">

           <button class="btn btn-sm btn-primary" id="copyLinkButton" data-link="{{$shared_document_url}}"> Copy link </button> &nbsp
           <button class="btn btn-sm btn-default" ><a href="{{route('documents.index')}}"> Go Back </a></button>

        </div>

        </div>
       </div>
    </div>


</div>
@endsection
@section('scripts')
    <script src="{{URL::to('assets/js/pages/custom/todo/todo.js')}}"></script>
    <script src="{{URL::to('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js')}}"></script>

<script>

var SITEURL = '{{URL::to('')}}';
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('body').on('click', '#copyLinkButton', function (event) {
    event.preventDefault();
    url = $(this).attr('data-link');
    navigator.clipboard.writeText(url);
    alert("Copied the url: " + url);

});


</script>
@endsection
