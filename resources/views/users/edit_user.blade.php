@extends('layouts.header')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit User : {{$user->name}}</h4>
                            
                            @if(count($errors) > 0 )
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <div class="col-md-12">
                                <form method='POST' action='{{url('update-user/'.$user->id)}}' onsubmit='show()' enctype="multipart/form-data">
                                    @csrf
                                   
                                    <div class="row">
                                        <div class='col-md-6 form-group'>
                                            Name
                                            <input type="text" name="name" required class="form-control" placeholder="Name" value="{{$user->name}}">
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            Email
                                            <input type="text" name="email" required class="form-control" placeholder="Email" value="{{$user->email}}">
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            Role
                                            <select name="role" class="form-control">
                                                <option value="Merchant" {{ $user->role == 'Merchant' ? 'selected' : '' }}>Merchant</option>
                                                <option value="Administrator" {{ $user->role == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                                            </select>
                                        </div>

                                        <div class='col-md-6 form-group'>
                                            Select Merchant
                                            <select class="form-control" name="merchant_id">
                                                @foreach($merchants as $merchant)
                                                    <option value="{{$merchant->id}}" {{ $user->merchant_id == $merchant->id ? 'selected' : '' }}>{{$merchant->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <a href='/users' type="button" class="btn btn-secondary">Close</a>
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
