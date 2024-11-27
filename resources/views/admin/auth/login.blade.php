@php
    $title = 'My Vacay Host';
    $filename = 'Login';
@endphp
@extends('admin.layouts.auth')
@section('title', $title)
@section('filename', $filename) {{-- Set the title in the layout --}}

@section('content')
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="index.html"><img src="{{asset('admin/assets/images/logo/logo4.png')}}" alt="Logo"></a>
                </div>
                <h1 class="auth-title">Log in.</h1>
                <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

                <form id="loginform" name="loginform"action="{{route('admin.login.check')}}" method="POST">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl @error('email') is-invalid @enderror" name="email" placeholder="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror  
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl @error('password') is-invalid @enderror" name="password" placeholder="Password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        @error('password')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="form-check form-check-lg d-flex align-items-end">
                        <input type="checkbox" name="rememberme" id="rememberme" class="form-check-input me-2" @if(\App\Helpers\Admin::getRememberMeCookie()['email']) {{ 'checked' }} @endif>
                        
                        <label class="form-check-label text-gray-600" for="flexCheckDefault">
                            Keep me logged in
                        </label>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    {{-- <p class="text-gray-600">Don't have an account? <a href="auth-register.html" class="font-bold">Sign
                            up</a>.</p> --}}
                    {{-- <p><a class="font-bold" href="">Forgot password?</a>.</p> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </div>
   
    <script type="text/javascript">
        $(document).ready(function(){
            @if(Session::has('flash-message'))
                @if(Session::get('flash-message.status') == 'success')
                    successNotification("{{Session::get('flash-message.msg')}}")
                @elseif(Session::get('flash-message.status') == 'warning')
                    warningNotification("{{Session::get('flash-message.msg')}}")
                @else
                    errorNotification("{{Session::get('flash-message.msg')}}")
                @endif
            @endif
            @if(\App\Helpers\Admin::getRememberMeCookie()['email'] || old('email')) 
                $('.form-line').addClass('focused');
            @endif
            jQuery.validator.addMethod("validEmail", function(value, element) {
                var emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return this.optional(element) || (emailRegex.test(String(value).toLowerCase()));
            }, "Please enter a valid email");
            $("#loginform").validate({
                rules: {
                    email: {
                        required: true,
                        email:email,
                        validEmail: true,
                    },
                    password: {
                        required: true,
                    }
                },
                messages: {
                    email: {
                        required: "Please enter email",
                        email:"Please enter a valid email",
                    },
                    password: {
                        required: "Please enter password",
                    }
                },
                submitHandler:function(form) {
                    loader('show');
                    form.submit();
                },
                highlight: function (input) {
                    $(input).parents('.form-line').addClass('error');
                },
                unhighlight: function (input) {
                    $(input).parents('.form-line').removeClass('error');
                },
                errorPlacement: function (error, element) {
                    $(element).parents('.form-group').append(error);
                }
            });
        });
    </script>   
@endsection
