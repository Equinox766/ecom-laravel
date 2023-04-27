@extends('user.layouts.template')

@section('pagetitle')
    Single Product
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="box_main mt-4">
                    <div class="tshirt_img">
                        <img src="{{ asset($product->product_img) }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="box_main  mt-4">
                    <div class="product-item">
                        <h4 class="shirt_text text-left">{{ $product->product_name }}</h4>
                        <p class="price_text text-left">Price <span style="color: #262626">$ {{ $product->product_price }}</span></p>
                    </div>
                    <div class="my-3 product-detail">
                        <p class="lead">{{ $product->product_long_des }}</p>
                        <ul class="p-2 bg-light my-2">
                            <li>Category - {{ $product->product_category_name }}</li>
                            <li>Sub Category - {{ $product->product_subcategory_name }}</li>
                            <li>Product Brand - {{ $product->product_brand_name }}</li>
                            <li>Available quantity - {{ $product->quantity }}</li>
                        </ul>
                    </div>
                    <div class="btn_main">
                        <form action="{{ route('addproducttocart') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$product->id}}" name="product_id">
                            <div class="form-group">
                                <input type="hidden" value="{{$product->product_price}}" name="product_price">
                                <label for="quantity">How Many Pics?</label>
                                <input class="form-control" type="number" min="1" value="1"  max="{{$product->quantity}}" name="quantity">
                            </div>
                            <input class="btn btn-warning" type="submit" value="Add To Cart">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- fashion section start -->
    <div class="fashion_section">
        <div id="main_slider">
            <div class="container">
                <h1 class="fashion_taital mt-6">Related Products</h1>
                <div class="fashion_section_2">
                    <div class="row">
                        @foreach($related_products as $product)
                            <div class="col-lg-4 col-sm-4">
                                <div class="box_main">
                                    <h4 class="shirt_text">
                                        {{$product->product_name}}
                                    </h4>
                                    <p class="price_text">Price  <span style="color: #262626;">$
                                            {{$product->product_price}}
                                        </span></p>
                                    <div class="tshirt_img"><img src="
                                    {{asset($product->product_img)}}
                                    "></div>
                                    <div class="btn_main">
                                        <div class="buy_bt d-flex">
                                            <form action="{{ route('addproducttocart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                                <input type="hidden" value="{{$product->product_price}}" name="product_price">
                                                <input type="hidden" value="1" name="quantity">
                                                <input class="btn btn-warning" type="submit" value="Add To Cart">
                                            </form>
                                            <div class="seemore_bt"><a href="{{ route('singleproduct', [$product->id, $product->slug]) }}">See More</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
