@extends('layouts.header')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                          <h4>Merchants </h4>

                          <a href="/create-merchant" class="btn btn-primary">New</a>
                        </div>

                        <div class="card-body">
                            <form method='get' onsubmit='show();' enctype="multipart/form-data" class="mb-3">
                                @if(session()->has('status'))
                                    <div class="alert alert-success alert-dismissable">
                                        {{session()->get('status')}}
                                    </div>
                                @endif
                                <div class="row mr-2">
                                    

                                    <div class="col-md-4 mt-1">
                                        <input class='form-control' name='search' value="{{$search}}" placeholder="Search User">
                                    </div>
                                    
                                    <div class="col-md-1 mt-1">
                                        <select class="form-control" name='limit'>
                                            <option value="">Show</option>
                                            <option value="5" @if($limit==5) selected @endif>5</option>
                                            <option value="10" @if($limit==10) selected @endif>10</option>
                                            <option value="50" @if($limit==50) selected @endif>50</option>
                                            <option value="100" @if($limit==100) selected @endif>100</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mt-1">
                                        <button class="btn btn-primary mr-1" type="submit">Filter</button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table border="1" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                    <th>Company</th>
                                    <th>Address</th>
                                    <th>Website</th>
                                    <th>Phone</th>
                                    <th>Contact Person</th>
                                    <th>Contact Phone</th>
                                    <th>Contact Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($merchants as $merchant)
                                            <tr>
                                                <td>{{$merchant->name}}</td>
                                                <td>{{$merchant->address}}</td>
                                                <td>
                                                    <a href="{{ $merchant->website }}" target="_blank">{{$merchant->website}}</a>
                                                </td>
                                                <td>{{$merchant->phone}}</td>
                                                
                                                <td>{{$merchant->contact_person}}</td>
                                                <td>{{$merchant->contact_phone}}</td>
                                                <td>{{$merchant->contact_email}}</td>
                                                <td>{{$merchant->status}}</td>
                                                <td>
                                                    <a href="/edit-merchant/{{$merchant->id}}" target="_blank" class="btn btn-outline-info btn-icon-text btn-sm">
                                                        Edit
                                                        <i class="ti-file btn-icon-append"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                                </table>
                            </div>
                            {{ $merchants->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
