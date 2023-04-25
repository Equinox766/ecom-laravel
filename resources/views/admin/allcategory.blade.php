@extends('admin.layout.template')
@section('pagetitle')
    All Category
@endsection
@section('content')
        <div class="card">
          <div class="card-header">
            <h4>All Category</h4>
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
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                <tr>
                  @foreach ($categories as $category)
                    <tr>
                      <td>{{$category->id}}</td>
                      <td>{{$category->category_name}}</td>
                      <td>{{$category->slug}}</td>
                      <td>
                        @if ($category->status == 'active')
                          <div class="badge badge-success">Active</div>
                        @else
                          <div class="badge badge-danger">Not Active</div>
                        @endif
                      </td> 
                      <td class=" d-flex ">
                          <a href="{{ route('admin.editcategory', $category->id) }}" class="btn btn-warning mr-2 ">Edit</a>
                          <a href="{{ route('admin.deletecategory', $category->id)}}" class="btn btn-light mr-2">Delete</a>
                          @if ($category->status == 'active')
                          <form action=" {{ route('admin.deactivatecategory') }} " method="POST">
                            @csrf
                            <input type="hidden" value="{{$category->id}}" name="cat_id">
                            <input type="submit" value="Deactivate It" class="btn btn-warning">
                          </form>
                          @else
                          <form action=" {{ route('admin.activatecategory') }} " method="POST">
                            @csrf
                            <input type="hidden" value="{{$category->id}}" name="cat_id">
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