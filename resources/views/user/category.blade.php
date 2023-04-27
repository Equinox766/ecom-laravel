@extends('user.layouts.template')

@section('pagetitle')
    Category
@endsection

@section('main-content')
    <!-- fashion section start -->
    <div class="fashion_section">
        <div id="main_slider">
            <div class="container">
                <h1 class="fashion_taital mt-6">{{$category->category_name}} - ({{$category->product_count}})</h1>
                <div class="fashion_section_2">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-lg-4 col-sm-4">
                                <div class="box_main">
                                    <h4 class="shirt_text">{{$product->product_name}}</h4>
                                    <p class="price_text">Price  <span style="color: #262626;">$ {{$product->product_price}}</span></p>
                                    <div class="tshirt_img"><img src="{{asset($product->product_img)}}"></div>
                                    <div class="btn_main">
                                        <div class="buy_bt d-flex">
                                            <form action="{{ route('addproducttocart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                                <input type="hidden" value="{{$product->product_price}}" name="product_price">
                                                <input type="hidden" value="1" name="quantity">
                                                <input class="btn btn-warning" type="submit" value="Buy Now">
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
