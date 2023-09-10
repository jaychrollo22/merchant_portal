@extends('layouts.header')

@section('content')
<div class="main-content">
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Category</h4>
                    </div>
                    <div class="card-body">  
                        <form action="/update-product-category/{{$product_category->id}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        Category
                                        <input name="name" type="text" class="form-control" value="{{$product_category->name}}"
                                            placeholder="Category">
                                    </div>
                                </div>
                                <a href='/product-categories' type="button" class="btn btn-secondary mt-3">Close</a>
                                <button type="submit" class="btn btn-primary mt-3" >Save</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
