@extends('user.layouts.template')

@section('pagetitle')
    Checkout
@endsection

@section('main-content')

    <h2>Final steo to place youur order</h2>
    <div class="row my-4">
        <div class="col-8">
            <div class="box_main">
                <h3>Product Will Sent At </h3>
                <p>City  {{$shipping_address->city_name}}</p>
                <p>Postal Code  {{$shipping_address->postal_code}}</p>
                <p>Phone Number  {{$shipping_address->phone_number}}</p>
            </div>
        </div>
        <div class="col-4">
            <div class="box_main">
                <h3>your final products are</h3>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($cartItems as $item)
                            <tr>
                                @php
                                    $product_name = App\Models\Product::where('id', $item->product_id)->value('product_name');
                                @endphp
                                <td>{{$product_name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td> Gs {{$item->product_price}}</td>
                            </tr>
                            @php
                                $total = $total + $item->product_price;
                            @endphp
                        @endforeach
                        @if ( $total > 0 )
                            <tr>
                                <td class="fw-bold">Total:</td>
                                <td></td>
                                <td>{{$total}}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <form action="" method="POST" class="d-flex ml-auto">
            @csrf
            <input type="submit" value="Cancel Order" class="btn btn-danger mr-3">
        </form>
        <form action="{{ route('placeorder') }}" method="POST">
            @csrf
            <input type="submit" value="Place Order" class="btn btn-primary mr-3">
        </form>
    </div>

@endsection

