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
                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Login') }}" onsubmit='show()' >
                        @csrf
                        <div class="form-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus  placeholder="Email">
                        </div>
                       
                        @if($errors->any())
                            <div class="form-group alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <strong>{{$errors->first()}}</strong>
                            </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Send Password Reset Link</button>
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