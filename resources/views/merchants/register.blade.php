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
            <div class="col-md-8 col-lg-8">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">{{ config('app.name', 'Merchant Portal') }}</h3>
                    <form method="POST" action="/store-register-merchant"  aria-label="{{ __('Fill Up Information') }}" onsubmit='show()' >
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required  placeholder="Merchant">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}" required  placeholder="Address">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="city" value="{{ old('city') }}" required  placeholder="City">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="region" value="{{ old('region') }}" required  placeholder="Region">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="website" value="{{ old('website') }}" required  placeholder="Website">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required  placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="zip_code" value="{{ old('zip_code') }}" required  placeholder="ZIP Code">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control" id="country" name="country" value="{{ old('country') }}" required>
                                        <option value="" class="text-dark ">Choose</option>
                                        @foreach($countries as $key => $country)
                                            <option value="{{$country->cca2}}" class="text-dark flag-icon flag-icon-{{ strtolower($country->cca2) }}" @if($country->cca2 == 'PH') selected @endif> {{$country->name->common}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="contact_person" value="{{ old('contact_person') }}" required  placeholder="Contact Person">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="contact_phone" value="{{ old('contact_phone') }}" required  placeholder="Contact Phone">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="contact_email" value="{{ old('contact_email') }}" required  placeholder="Contact Email">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Register</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50"> </div>
                            <div class="w-50 text-md-right">
                                <a href="/login" onclick='show()' style="color: #fff">Back to Sign In</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
