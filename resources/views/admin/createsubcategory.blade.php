@extends('admin.layout.template')
@section('pagetitle')
    Create Sub Category
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <h4>Create Sub Category</h4>
                </div>
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                          <label for="subcategory_name">Enter Sub Category Name</label>
                          <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" placeholder="Mobile">
                        </div>
                        <div class="form-group">
                            <label for="category_name">Select Category</label>
                            <select name="category_id" class="form-control">
                              <option>Option 1</option>
                              <option>Option 2</option>
                              <option>Option 3</option>
                            </select>
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