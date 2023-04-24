@extends('admin.layout.template')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <h4>Create Category</h4>
                </div>
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                          <label for="category_name">Enter Category Name</label>
                          <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Electronics">
                        </div>
                      </div>
                      <div class="card-footer">
                      <button class="btn btn-primary">Create Category</button>
                      </div>
                </form>
            </div>
        </div>
    </div>
@endsection