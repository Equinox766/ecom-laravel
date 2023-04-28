@extends('user.layouts.user')

@section('pagetitle')
    Pending Orders
@endsection

@section('profilecontent')
    <h2>Pending Orders</h2>
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
    <table class="table">
        <tr>
            <th>Product ID</th>
            <th>Price</th>
        </tr>
        @foreach ($pendingOrders as $order)
            <tr>
                <td>{{$order->product_id}}</td>
                <td>{{$order->total_price}}</td>
            </tr>
        @endforeach
    </table>

@endsection
