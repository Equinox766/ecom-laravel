<div>
    <div class="form-group">
        <label for="product_category_id">Select Product Category</label>
        <select wire:model="selectedCategory" class="form-control" id="product_category_id" name="product_category_id">
            <option value="" selected>Select One</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->category_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="product_subcategory_id">Select Product Sub Category</label>
        <select class="form-control" id="product_subcategory_id" name="product_subcategory_id">
            <option value="" selected>Select One</option>
            @foreach ($subcategories as $subcategory)
                <option value="{{$subcategory->id}}">{{$subcategory->sub_category_name}}</option>
            @endforeach
        </select>
    </div>
</div>
