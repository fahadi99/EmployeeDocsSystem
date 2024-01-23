
<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head><base href="">
    <meta charset="utf-8" />
    <title>Employee Portal | SmartOne | HRL Digital</title>
    <meta name="description" content="" />
<!---
   <link rel="manifest" href="/manifest.json">
-->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="apple-mobile-web-app-status-bar" content="#3f4254">
     <meta name="theme-color" content="#3f4254"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--begin::Fonts , shrink-to-fit=no-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{URL::to('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}?v={{config('setting.system.version')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{URL::to('assets/plugins/global/plugins.bundle.css')}}?v={{config('setting.system.version')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('assets/plugins/custom/prismjs/prismjs.bundle.css')}}?v={{config('setting.system.version')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('assets/css/style.bundle.css')}}?v={{config('setting.system.version')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('assets/css/custom.bundle.css')}}?v={{config('setting.system.version')}}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{asset('images/hrldigital.ico')}}?v={{config('setting.system.version')}}"/>
    <link href="{{URL::to('assets/plugins/custom/datatables/datatables.bundle.css')}}?v={{config('setting.system.version')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}?v={{config('setting.system.version')}}" rel="stylesheet" type="text/css" />


    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{URL::to('assets/css/themes/layout/header/base/light.css')}}?v={{config('setting.system.version')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('assets/css/themes/layout/header/menu/light.css')}}?v={{config('setting.system.version')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('assets/css/themes/layout/brand/dark.css')}}?v={{config('setting.system.version')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('assets/css/themes/layout/aside/dark.css')}}?v={{config('setting.system.version')}}" rel="stylesheet" type="text/css" />

    <link href="{{URL::to('assets/plugins/custom/kanban/kanban.bundle.css')}}?v={{config('setting.system.version')}}" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="apple-touch-icon" href="/assets/media/logos/smart-files.png">
<!---
 <script type="text/javascript">
      if ('serviceWorker' in navigator) {
          navigator.serviceWorker.register('/serviceWorker.js').then(function(registration) {
          console.log('Service worker registered successfully', registration);
        }).catch(function(err) {
          console.log('Service worker registration failed: ', err);
        });
      };
    </script>
    -->
    {{-- config('system.meetings.min_before_can_join') --}}

    @yield('styles')

</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    {{-- loader code starts here --}}

<!--begin::Main-->
<!--begin::Header Mobile-->
@include('layout.partial.admin.mobile-menu')
<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!-- include('layout.partial.admin.left-menu') -->
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
            <div id="kt_header" class="header header-fixed">
                <!--begin::Container-->
                <div class="container-fluid d-flex align-items-stretch justify-content-between">
                    <!--begin::Header Menu Wrapper-->
                    @include('layout.partial.admin.header-left')
                    <!--end::Header Menu Wrapper-->
                    <!--begin::Topbar-->
                    @include('layout.partial.admin.header-right')
                    <!--end::Topbar-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            @yield('content')
            <!--end::Content-->
            <!--begin::Footer-->
            @include('layout.partial.admin.footer')
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->
@include('layout.partial.admin.user-menu')
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
                <!--end::Svg Icon-->
			</span>
</div>
<!--end::Scrolltop-->

<!-- Modal-->
<div class="modal fade" id="ajaxGetModel" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable  modal-lg" role="document">
        <div id="ajax-model-content" class="modal-content">
        </div>
    </div>
</div>

@if(session()->has('hasPopup'))

    <div class="modal fade" id="notificationModel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{session()->get('messageTitle')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">{{session()->get('messageData')}}</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

@endif


<!--end::Demo Panel-->
<script >
    var HOST_URL = "{{url('/')}}";
</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{URL::to('assets/plugins/global/plugins.bundle.js')}}?v={{config('setting.system.version')}}"></script>
<script src="{{URL::to('assets/plugins/custom/prismjs/prismjs.bundle.js')}}?v={{config('setting.system.version')}}"></script>
<script src="{{URL::to('assets/js/scripts.bundle.js')}}?v={{config('setting.system.version')}}"></script>
<script src="{{URL::to('assets/js/custom.bundle.js')}}?v={{config('setting.system.version')}}"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
<script src="{{URL::to('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}?v={{config('setting.system.version')}}"></script>
    <script src="{{URL::to('assets/js/pages/features/calendar/external-events.js')}}?v={{config('setting.system.version')}}"></script>

    <!--end::Page Vendors-->




<!--begin::Page Scripts(used by this page)-->
<script src="{{URL::to('assets/js/pages/widgets.js')}}?v={{config('setting.system.version')}}"></script>
<!--end::Page Scripts-->

<script src="{{URL::to('assets/plugins/custom/datatables/datatables.bundle.js')}}?v={{config('setting.system.version')}}"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{URL::to('assets/js/pages/crud/datatables/advanced/multiple-controls.js')}}?v={{config('setting.system.version')}}"></script>
<script src="{{URL::to('assets/js/pages/features/cards/tools.js')}}?v={{config('setting.system.version')}}"></script>

<script src="{{URL::to('assets/js/pages/crud/forms/widgets/select2.js')}}?v={{config('setting.system.version')}}"></script>
<script src="{{URL::to('assets/js/pages/crud/forms/widgets/bootstrap-switch.js')}}?v={{config('setting.system.version')}}"></script>
<script src="{{URL::to('assets/js/pages/crud/forms/editors/summernote.js')}}?v={{config('setting.system.version')}}"></script>
        <script src="{{URL::to('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{URL::to('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{URL::to('assets/js/pages/custom/todo/todo.js')}}"></script>
    <script src="{{URL::to('assets/plugins/custom/kanban/kanban.bundle.js')}}"></script>

<!--end::Page Scripts-->

    @if(session()->has('hasPopup'))
        <script type="application/javascript">
            $('#notificationModel').modal('show');
        </script>

    @endif

        @yield('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
    //$('#loading-background').fadeOut(1000);
    $('#loader').fadeOut(1000);

        /*document.onreadystatechange = function () {
        var state = document.readyState
        if (state == 'interactive') {
            // document.getElementById('contents').style.visibility="hidden";
        } else if (state == 'complete') {
            setTimeout(function(){
               document.getElementById('interactive');
               document.getElementById('loader').style.visibility="hidden";
               document.getElementById('contents').style.visibility="visible";
            },1000);
        }
        }
        */


    });

    $(document).ready(function(){
        @if($success = session('success', false))
            showToastr('success', '{{$success}}')
        @endif
        @if($error = session('error', false))
            showToastr('error', '{{$error}}')
        @endif


    })

    </script>
</body>
<!--end::Body-->
</html>
