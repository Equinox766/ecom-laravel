@extends('admin.layout.template')
@section('pagetitle')
    Edit Product Image
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Product Image</h4>
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
                <form action="{{ route('admin.updateproductimg') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="product_name">Previous Image</label>
                            <br>
                            <img src="{{asset($product_info->product_img)}}" alt="">
                        </div>

                        <input type="hidden" value="{{$product_info->id}}" name="product_id">

                        <div class="form-group">
                            <label for="product_img">Update New Image</label>
                            <input  type="file" class="form-control" id="product_img" name="product_img">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Update Product Image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
