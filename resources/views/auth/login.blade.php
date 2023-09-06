@extends('layouts.app')

@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <img alt="image"  src="{{asset('login_css/images/logo.png')}}" style='width:135px;'>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">{{ config('app.name', 'Merchant Portal') }}</h3>

                    @if(request('registered'))
                        @if(request('registered') == true)
                            <div class="form-group alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <strong>Successfully Registered. We will get back to you once we validate your information. Thank you.</strong>
                            </div>
                        @endif
                    @endif

                    <form method="POST" action="{{ route('login') }}"  aria-label="{{ __('Login') }}" onsubmit='show()' >
                        @csrf
                        <div class="form-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus  placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input id="password-field" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required >
                            <span toggle="#password-field" id='no-password' onclick='show_password();' class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        @if($errors->any())
                            <div class="form-group alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <strong>{{$errors->first()}}</strong>
                            </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50"> </div>
                            <div class="w-50 text-md-right">
                                <a href="{{ route('password.request') }}" onclick='show()' style="color: #fff">Forgot Password? </a>
                                <a href="/register-merchant" onclick='show()' style="color: #fff">Register</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
