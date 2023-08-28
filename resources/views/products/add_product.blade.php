@extends('layouts.header')

@section('content')
<new-product></new-product>
{{-- <div class="main-content">
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>New Product</h4>
                    </div>
                    <div class="card-body">
                        <form action="/new-product" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="images[]" id="imageInput" multiple>

                            <div class="container-fix">

                            
                            <div class="image-container">
                                <div class="cropper-container"></div>
                            </div>

                        </div>

                            <button type="submit">Upload and Crop</button>
                        </form>
                        
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection
