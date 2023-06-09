@extends('admin.layout.template')
@section('pagetitle')
    Create Brand
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <h4>Create Brand</h4>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.storebrand') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                          <label for="brand_name">Enter Brand Name</label>
                          <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Apple">
                        </div>
                      </div>
                      <div class="card-footer">
                      <button class="btn btn-primary">Create Brand</button>
                      </div>
                </form>
            </div>
        </div>
    </div>
@endsection