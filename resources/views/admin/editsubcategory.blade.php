@extends('admin.layout.template')
@section('pagetitle')
    Edit Sub Category
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h4>Edit Sub Category</h4>
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
                <form action=" {{ route('admin.updatesubcategory') }} " method="POST">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" value="{{ $subcategory_info->id }}" name="sub_category_id">
                        <div class="form-group">
                            <label for="sub_category_name">Enter Sub Category Name</label>
                            <input type="text" class="form-control" id="sub_category_name" name="sub_category_name" value="{{$subcategory_info->sub_category_name}}">
                        </div>
                        @php
                            $categories = App\Models\Category::where('status', 'active')->get();
                        @endphp
                        <div class="form-group">
                            <label for="category_name">Select Category</label>
                            <select name="category_id" class="form-control">
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}"
                                    @if ($subcategory_info->category_id == $category->id)
                                        selected 
                                    @endif>
                                        {{$category->category_name}}
                                </option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="card-footer">
                        <button class="btn btn-primary">Update Sub Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection