@extends('admin.layout.template')
@section('pagetitle')
    All Product
@endsection
@section('content')
        <div class="card">
          <div class="card-header">
            <h4>All Product</h4>
          </div>
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

          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table table-bordered table-md">
                <tr>
                  <th>#</th>
                  <th>Product Name</th>
                  <th>Img</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                <tr>
                  @foreach ($products as $product)
                    <tr>
                      <td>{{$product->id}}</td>
                      <td>{{$product->product_name}}</td>
                      <td>
                          <img height="100px " src="{{asset($product->product_img)}}" alt="" />
                          <br>
                          <a href="{{ route('admin.editproductimg', $product->id) }}" class="btn btn-primary btn-lg">Update Image</a>
                      </td>
                      <td>{{$product->product_price}}</td>
                      <td>
                        @if ($product->status == 'active')
                          <div class="badge badge-success">Active</div>
                        @else
                          <div class="badge badge-danger">Not Active</div>
                        @endif
                      </td>
                      <td class=" d-flex ">
                          <a href="{{ route('admin.editproduct', $product->id) }}" class="btn btn-warning mr-2 ">Edit</a>
                          <a href="{{ route('admin.deleteproduct', $product->id)}}" class="btn btn-light mr-2">Delete</a>
                          @if ($product->status == 'active')
                          <form action=" {{ route('admin.deactivateproduct') }} " method="POST">
                            @csrf
                            <input type="hidden" value="{{$product->id}}" name="cat_id">
                            <input type="submit" value="Deactivate It" class="btn btn-warning">
                          </form>
                          @else
                          <form action=" {{ route('admin.activateproduct') }} " method="POST">
                            @csrf
                            <input type="hidden" value="{{$product->id}}" name="cat_id">
                            <input type="submit" value="Activate It" class="btn btn-success ">
                          </form>
                          @endif
                      </td>
                    </tr>
                  @endforeach
                </tr>
              </table>
            </div>
          </div>
          <div class="card-footer text-right">
            <nav class="d-inline-block">
              <ul class="pagination mb-0">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1 <span
                      class="sr-only">(current)</span></a></li>
                <li class="page-item">
                  <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
@endsection
