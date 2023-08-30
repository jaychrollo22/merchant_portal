@extends('layouts.header')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                          <h4>Products </h4>

                          <a href="/create-product" class="btn btn-primary">New</a>
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
                                        <input class='form-control' name='search' value="{{$search}}" placeholder="Search Product">
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

                            <table border="1" class="table table-hover table-bordered">
                                <thead>
                                  <tr>
                                    <th>Product Name</th>
                                    <th>Catalog</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->catalog}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>
                                                <a href="/edit-product/{{$product->id}}" class="btn btn-outline-info btn-icon-text btn-sm">
                                                    Edit
                                                    <i class="ti-file btn-icon-append"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
