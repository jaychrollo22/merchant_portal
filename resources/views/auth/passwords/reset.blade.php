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
                    <form method="POST" action="{{ route('password.update') }}" aria-label="{{ __('Login') }}" onsubmit='show()' >
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus  placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        </div>
                       
                        @if($errors->any())
                            <div class="form-group alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <strong>{{$errors->first()}}</strong>
                            </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Reset Password</button>
                        </div>

                        <div class="form-group d-md-flex">
                            <div class="w-50"> </div>
                            <div class="w-50 text-md-right">
                                <a href="/login" style="color: #fff">Back to Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection