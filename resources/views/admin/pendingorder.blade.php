@extends('admin.layout.template')
@section('pagetitle')
    Pending Orders
@endsection
@section('content')
        <div class="card">
            <div class="card-header">
                <h4>Pending Orders</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <tr>
                            <th>User Id</th>
                            <th>Shipping Info</th>
                            <th>Product Id</th>
                            <th>Quantity</th>
                            <th>Total Will Pay</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->user_id }}</td>
                                <td>
                                    <ul>
                                        <li>Phone: {{ $order->shipping_phonenumber }}</li>
                                        <li>City: {{ $order->shipping_city }}</li>
                                        <li>Postal Code:{{ $order->shipping_postalcode }}</li>
                                    </ul>
                                </td>
                                <td>{{ $order->product_id }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td class="badge badge-danger mt-3">{{ $order->status }}</td>
                                <td>
                                    <a href="#" class="btn btn-success">Approve Now</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
@endsection
