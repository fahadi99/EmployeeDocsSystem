@extends('login.login')

@section('content')
<div class="page-title">
    @include('include.messages')
   </div>
   <br>
   <br>
  {{-- <div class="login-form login-signin py-11">  --}}
    <!--begin::Form-->
    <form class="form" method="POST" action="{{ route('login') }}" id="kt_login_signin_form" novalidate="novalidate"{{--id="kt_login_signin_form"--}} >
        @csrf
        <!--begin::Title-->
        <div class="text-center pb-8">
            <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg"> {{ __('Login') }} </h2>
        </div>
        <!--end::Title-->
        <!--begin::Form group-->
        <div class="form-group">
            <label class="font-size-h6 font-weight-bolder text-dark">{{ __('E-Mail Address') }} or Phone Number </label>
            <input id="username" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg {{-- @error('username') is-invalid @enderror --}}"
            name="username" value="{{ old('username') }}" type="text" name="username" autocomplete="off" />
           {{-- @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror --}}
        </div>
        <!--end::Form group-->
        <!--begin::Form group-->
        <div class="form-group">
            <div class="d-flex justify-content-between mt-n5">
                <label class="font-size-h6 font-weight-bolder text-dark pt-5">{{ __('Password') }}</label>

            </div>
            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg {{-- @error('password') is-invalid @enderror --}}" type="password" name="password" autocomplete="off" />

            <div class="text-right">
                <a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">Forgot Password ?</a>
            </div>
           {{-- @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div> --}}
        <!--end::Form group-->
        <!--begin::Action-->
        <div class="text-center pt-2">
            <button id="kt_login_signin_submit" class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3"> {{ __('Login') }} </button>
        </div>
        <!--end::Action-->
    </form>
    <!--end::Form-->
{{--</div> --}}

@endsection
