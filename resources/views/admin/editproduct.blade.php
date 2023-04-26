@extends('admin.layout.template')
@section('pagetitle')
    Edit Product
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Product</h4>
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
                <form action="{{ route('admin.updateproduct') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" value="{{ $product_info->id }}" name="product_id">
                        <div class="form-group">
                            <label for="product_name">Enter Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="{{$product_info->product_name}}">
                        </div>
                        <div class="form-group">
                            <label for="product_price">Enter Product Price</label>
                            <input type="number" class="form-control" id="product_price" name="product_price" value="{{$product_info->product_price}}">
                        </div>
                        <div class="form-group">
                            <label for="product_short_des">Enter Short Description</label>
                            <textarea cols="30" rows="10" class="form-control" id="product_short_des" name="product_short_des">{{$product_info->product_short_des}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_long_des">Enter Long Description</label>
                            <textarea cols="30" rows="10"  class="form-control" id="product_long_des" name="product_long_des" >{{$product_info->product_long_des}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Enter Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="500" value="{{$product_info->quantity}}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
