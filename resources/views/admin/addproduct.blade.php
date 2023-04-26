@extends('admin.layout.template')
@section('pagetitle')
    Add Product
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Product</h4>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.storeproduct') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="product_name">Enter Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name"
                                placeholder="iPhone 13 Pro Max">
                        </div>
                        <div class="form-group">
                            <label for="product_price">Enter Product Price</label>
                            <input type="number" class="form-control" id="product_price" name="product_price">
                        </div>
                        <div class="form-group">
                            <label for="product_short_des">Enter Short Description</label>
                            <textarea cols="30" rows="10" class="form-control" id="product_short_des" name="product_short_des"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_long_des">Enter Long Description</label>
                            <textarea cols="30" rows="10"  class="form-control" id="product_long_des" name="product_long_des"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_img">Select Product Image</label>
                            <input  type="file" class="form-control" id="product_img" name="product_img">
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="product_category_id">Select Product Category</label>
                                <select class="form-control" id="product_category_id" name="product_category_id">
                                    <option value="" selected>Select One</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_subcategory_id">Select Product Sub Category</label>
                                <select class="form-control" id="product_subcategory_id" name="product_subcategory_id">
                                    <option value="" selected>Select One</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{$subcategory->id}}">{{$subcategory->sub_category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @php
                            $brands = App\Models\Brand::get();
                        @endphp

                        <div class="form-group">
                            <label for="product_brand_id">Select Product Brand</label>
                            <select class="form-control" id="product_brand_id" name="product_brand_id">
                                <option value="" selected>Select One</option>
                                @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Enter Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                placeholder="500">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Create Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
