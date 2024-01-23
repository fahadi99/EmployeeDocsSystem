<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
	    <base href="../../../">
		<meta charset="utf-8" />
		<title>Login - Employee Portal | SmartOne</title>
		<!---
		<link rel="manifest" href="/manifest.json">
-->
		<meta name="apple-mobile-web-app-status-bar" content="#3f4254">
         <meta name="theme-color" content="#3f4254"/>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--begin::Fonts , shrink-to-fit=no-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="assets/css/pages/login/login-2.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
        <link rel="shortcut icon" href="/assets/media/logos/favicon.ico"/>
		<!--begin::Layout Themes(used by all pages)-->
		<link href="assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
		<link rel="apple-touch-icon" href="/assets/media/logos/smart-files.png">

		<!--end::Layout Themes-->
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
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
				<!--begin::Aside-->
				<div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
					<!--begin: Aside Container-->
					<div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
						<!--begin::Logo-->
						<a href="#" class="text-center pt-2">
{{--							<img src="assets/media/logos/smart-files.png" class="max-h-100px" alt="" />--}}
						</a>
						<!--end::Logo-->
						<!--begin::Aside body-->
						<div class="d-flex flex-column-fluid flex-column flex-center">
							<!--begin::Signin-->

                            <div class="login-form login-signin py-11"{{-- id="kt_login_signin_form"--}}>
                                <main>
                                    @yield('content')
                                </main>
                            </div>


                            	<!--begin::Forgot-->
                                <div class="login-form login-forgot pt-11" >
                                    <!--begin::Form-->
                                    <form class="form" action="{{ route('forgot.password') }}"  method="POST" id="kt_login_forgot_form" >
                                        @csrf

                                        <div class="page-title">
                                            @include('include.messages')
                                           </div>
                                           <br>
                                           <br>

                                        <!--begin::Title-->
                                        <div class="text-center pb-8">
                                            <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Forgotten Password ?</h2>
                                            <p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password</p>
                                        </div>
                                        <!--end::Title-->
                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off" />
                                        </div>
                                        <!--end::Form group-->
                                        <!--begin::Form group-->
                                        <div class="form-group d-flex flex-wrap flex-center pb-lg-0 pb-3">

                                            <button type="submit"  id="forgot-password" class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Submit</button>
                                            <button type="button" id="kt_login_forgot_cancel" onclick="window.location.reload();" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Cancel</button>
                                        </div>
                                        <!--end::Form group-->
                                    </form>
                                    <!--end::Form-->
                                </div>

							{{-- <div class="login-form login-signin py-11">
								<!--begin::Form-->
								<form class="form" novalidate="novalidate" id="kt_login_signin_form">
									<!--begin::Title-->
									<div class="text-center pb-8">
										<h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Sign In</h2>
									</div>
									<!--end::Title-->
									<!--begin::Form group-->
									<div class="form-group">
										<label class="font-size-h6 font-weight-bolder text-dark">Email</label>
										<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text" name="username" autocomplete="off" />
									</div>
									<!--end::Form group-->
									<!--begin::Form group-->
									<div class="form-group">
										<div class="d-flex justify-content-between mt-n5">
											<label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
											<a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">Forgot Password ?</a>
										</div>
										<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password" autocomplete="off" />
									</div>
									<!--end::Form group-->
									<!--begin::Action-->
									<div class="text-center pt-2">
										<button id="kt_login_signin_submit" class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3">Sign In</button>
									</div>
									<!--end::Action-->
								</form>
								<!--end::Form-->
							</div>  --}}
							<!--end::Signin-->


                            {{-- Adding terms of service and privacy policy pages here for time being --}}

                            <div class="copyright"> {{date('Y')}} &copy; Powered by Smart Tech One, Project of FDH.</div>
                                <div class="copyright">
                                  <a href="{{route('terms.of.service')}}" style="color: black !important;">Terms of Service</a>
                                 | <a href="{{route('privacy.policy')}}" style="color: black !important;">Privacy Policy</a>
                                 </div>


							<!--end::Forgot-->
						</div>
						<!--end::Aside body-->

					</div>
					<!--end: Aside Container-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0" style="background-color: #82b9fc;">
					<!--begin::Title-->
					<div class="d-flex flex-column justify-content-center text-center pt-lg-40 pt-md-5 pt-sm-5 px-lg-0 pt-5 px-7">
						<h3 class="display4 font-weight-bolder my-7 text-dark" style="color: #986923;">Employee Portal</h3>
						<p class="font-weight-bolder font-size-h2-md font-size-lg text-dark opacity-70">Work smarter, not harder.</p>
					</div>
					<!--end::Title-->
					<!--begin::Image-->
					<div class="content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url(assets/media/svg/illustrations/login-visual-2.svg);"></div>
					<!--end::Image-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="assets/js/pages/custom/login/login-general.js"></script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>
