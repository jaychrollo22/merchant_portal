@extends('layouts.header')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                          <h4>Variants</h4>

                          <a href="/create-product-variant" class="btn btn-primary">New</a>
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
                                        <input class='form-control' name='search' value="{{$search}}" placeholder="Search Variant">
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
                                    <th>Variant</th>
                                    <th>Date Modified</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($product_variants as $product)
                                        <tr>
                                            <td>{{$product->name}}</td>
                                            <td>{{ date('F d, Y h:i A',strtotime($product->updated_at)) }}</td>
                                            <td>
                                                <a href="/edit-product-category/{{$product->id}}" class="btn btn-outline-info btn-icon-text btn-sm">
                                                    Edit
                                                    <i class="ti-file btn-icon-append"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $product_variants->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
