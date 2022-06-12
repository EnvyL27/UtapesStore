@extends('dashboard.layouts.main')
@section('content')
<form method="POST" action="/dashboard/product/{{ $product->slug }}" class="mb-5" enctype="multipart/form-data">
    
    @method('put')
    @csrf
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Edit Product</p>
                            <button class="btn btn-primary btn-sm ms-auto" type="submit">Save</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Product Information</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Product Name</label>
                                    <input class="form-control" type="text" name="product_name" id="product_name"
                                        value="{{old('name',$product->product_name)}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Slug</label>
                                    <input class="form-control" type="text" name="slug" id="slug"
                                        value="{{old('slug',$product->slug)}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Category Name</label>
                                    <select class="form-control" name="category_id">
                                        @foreach($categories as $category)
                                        <option value ={{ $category->id }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Quantity</label>
                                    <input class="form-control" type="text" name="quantity"
                                        value="{{old('slug',$product->quantity)}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Price</label>
                                    <input class="form-control" type="text" name="price"
                                        value="{{old('slug',$product->price)}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Description</label>
                                    <input class="form-control" type="text" name="description"
                                        value="{{old('desc',$product->description)}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" name="oldImage" value="{{ $product->image }}">
                            <div class="col-md-3 mt-3">
                                @if($product->image)
                                <label for="">Old Image</label>
                                <img src="{{ asset('storage/'.$product->image) }}" alt="products Image"
                                    style="width: 200px;" class="d-flex">
                                @endif
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Categoy Image</label>
                                    <input type="file" name="image" id="" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection