@extends('layouts.header')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Change Password User : {{$user->name}}</h4>
                            
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
                                <form method='POST' action='{{url('change-password-user/'.$user->id)}}' onsubmit='show()' enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class='col-md-6 form-group'>
                                            Password
                                            <input type="password" name="password" required class="form-control" placeholder="Password" value="{{old('password')}}">
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            Confirm Password
                                            <input type="password" name="password_confirmation" required class="form-control" placeholder="Confirm Password" value="{{old('confirm_password')}}">
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
