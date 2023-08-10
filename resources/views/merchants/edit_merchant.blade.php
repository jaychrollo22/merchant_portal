@extends('layouts.header')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Merchant : {{$merchant->name}}</h4>
                            <div class="col-md-12">
                                <form method='POST' action='{{url('update-merchant/'.$merchant->id)}}' onsubmit='show()' enctype="multipart/form-data">
                                    @csrf
                                   
                                    <div class="row">
                                        <div class='col-md-6 form-group'>
                                            Name
                                            <input type="text" name="name" value="{{$merchant->name}}" required class="form-control">
                                        </div>
                                        <div class='col-md-12 form-group'>
                                            Address
                                            <input type="text" name="address" value="{{$merchant->address}}" required class="form-control">
                                        </div>
                                        <div class='col-md-4 form-group'>
                                            City
                                            <input type="text" name="city" value="{{$merchant->city}}" required class="form-control">
                                        </div>
                                        <div class='col-md-4 form-group'>
                                            Region
                                            <input type="text" name="region" value="{{$merchant->region}}" required class="form-control">
                                        </div>
                                        <div class='col-md-4 form-group'>
                                            Website
                                            <input type="text" name="website" value="{{$merchant->website}}" class="form-control">
                                        </div>
                                        <div class='col-md-4 form-group'>
                                            Phone
                                            <input type="text" name="phone" value="{{$merchant->phone}}" required class="form-control">
                                        </div>
                                        <div class='col-md-4 form-group'>
                                            ZIP Code
                                            <input type="text" name="zip_code" value="{{$merchant->zip_code}}" class="form-control">
                                        </div>
                                        <div class='col-md-4 form-group'>
                                            Country
                                            <input type="text" name="country" value="{{$merchant->country}}" class="form-control">
                                        </div>
                                        <div class='col-md-12 form-group'>
                                            Notes
                                            <textarea name="notes" id="" cols="30" rows="10" class="form-control">{{$merchant->notes}}</textarea>
                                        </div>
                                        <div class='col-md-4 form-group'>
                                            Contact Person
                                            <input type="text" name="contact_person" value="{{$merchant->contact_person}}" class="form-control">
                                        </div>
                                        <div class='col-md-4 form-group'>
                                            Contact Phone
                                            <input type="text" name="contact_phone" value="{{$merchant->contact_phone}}" class="form-control">
                                        </div>
                                        <div class='col-md-4 form-group'>
                                            Contact Email
                                            <input type="email" name="contact_email" value="{{$merchant->contact_email}}" class="form-control">
                                        </div>
                                        <div class='col-md-4 form-group'>
                                            Status
                                            <select name="status" class="form-control">
                                                <option value="Active" {{ $merchant->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="Inactive" {{ $merchant->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <a href='/merchants' type="button" class="btn btn-secondary">Close</a>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
