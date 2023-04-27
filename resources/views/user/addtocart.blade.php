
@extends('user.layouts.template')

@section('pagetitle')
    Cart
@endsection

@section('main-content')
    <br>
    <h2>Add to cart</h2>
    @if (session()->has('message'))
        <div id="alert-container">
            <div class="alert alert-success text-center">{{session()->get('message')}}</div>
        </div>

        <script>
            setTimeout(function() {
                var alertContainer = document.getElementById('alert-container');
                var alertElement = alertContainer.querySelector('.alert');
                alertContainer.removeChild(alertElement);
            }, 5000); // Elimina la alerta después de 5 segundos
        </script>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="box_main">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($cart_items as $item)
                            <tr>
                                @php
                                    $product_name = App\Models\Product::where('id', $item->product_id)->value('product_name');
                                    $img = App\Models\Product::where('id', $item->product_id)->value('product_img')
                                @endphp
                                <td><img src="{{asset($img)}}" style="height: 50px"></td>
                                <td>{{$product_name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td> Gs {{$item->product_price}}</td>
                                <td><a href="{{ route('removeitem', $item->id) }}" class="btn btn-warning">Remove</a></td>
                            </tr>
                            @php
                                $total = $total + $item->product_price;
                            @endphp
                        @endforeach
                            @if ( $total > 0 )
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="fw-bold">Total:</td>
                                    <td>{{$total}}</td>
                                    <td><a href="{{ route('shippingaddress') }}" class="btn btn-primary">Checkout Now</a></td>
                                </tr>
                            @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
