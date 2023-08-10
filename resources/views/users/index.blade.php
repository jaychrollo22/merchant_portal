@extends('layouts.header')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                          <h4>Users </h4>
                        </div>

                        <div class="card-body">
                            <form method='get' onsubmit='show();' enctype="multipart/form-data" class="mb-3">
                                @if(session()->has('status'))
                                    <div class="alert alert-success alert-dismissable">
                                        {{session()->get('status')}}
                                    </div>
                                @endif
                                <div class="row mr-2">
                                    <div class="col-md-1">
                                        <select class="form-control" name='limit'>
                                            <option value="">Show</option>
                                            <option value="5" @if($limit==5) selected @endif>5</option>
                                            <option value="10" @if($limit==10) selected @endif>10</option>
                                            <option value="50" @if($limit==50) selected @endif>50</option>
                                            <option value="100" @if($limit==100) selected @endif>100</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <input class='form-control' name='search' value="{{$search}}" placeholder="Search User">
                                    </div>
                                    

                                    <div class="col-md-3">
                                        <button class="btn btn-primary mr-1" type="submit">Filter</button>
                                    </div>
                                </div>
                            </form>

                            <table border="1" class="table table-hover table-bordered">
                              <thead>
                                <tr>
                                  <th>Users</th>
                                  <th>Email</th>
                                  <th>Role</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->role}}</td>
                                            <td>
                                                <a href="/edit-user-role/{{$user->id}}" target="_blank" class="btn btn-outline-info btn-icon-text btn-sm">
                                                    Edit
                                                    <i class="ti-file btn-icon-append"></i>
                                                </a>
                                                <a href="/change-password/{{$user->id}}" target="_blank" class="btn btn-outline-info btn-icon-text btn-sm">
                                                    Change Password
                                                    <i class="ti-key btn-icon-append"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                              </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
