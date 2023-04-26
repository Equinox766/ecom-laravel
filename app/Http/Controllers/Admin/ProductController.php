<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function AddProduct()
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        return view('admin.addproduct', compact('categories', 'subcategories'));
    }


    public function AllProduct()
    {
        $products = Product::latest()->get();
        return view('admin.allproduct', compact('products'));
    }

    public function StoreProduct(Request $request)
    {
        $request->validate([
           'product_name'           => 'required|unique:products',
           'product_price'          => 'required',
           'quantity'               => 'required',
           'product_short_des'      => 'required',
           'product_long_des'       => 'required',
           'product_category_id'    => 'required',
           'product_subcategory_id' => 'required',
           'product_brand_id'       => 'required',
           'product_img'            => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


         if ($request->hasFile('product_img') && $request->file('product_img')->isValid()) {
             $img_name = time().'.'.$request->product_img->extension();
             $request->product_img->move(public_path('upload'), $img_name);
             $img_url = 'upload/' . $img_name;
        }

        $brand_id = $request->product_brand_id;
        $category_id = $request->product_category_id;
        $subcategory_id = $request->product_subcategory_id;

        $brand_name = Brand::where('id', $brand_id)->value('brand_name');
        $category_name = Category::where('id', $category_id)->value('category_name');
        $subcategory_name = SubCategory::where('id', $subcategory_id)->value('sub_category_name');

        Product::insert([
            'product_name'              => $request->product_name,
            'product_price'             => $request->product_price,
            'product_short_des'         => $request->product_short_des,
            'product_long_des'          => $request->product_long_des,
            'product_img'               => $img_url,
            'product_category_id'       => $category_id,
            'product_category_name'     => $category_name,
            'product_subcategory_id'    => $subcategory_id,
            'product_subcategory_name'  => $subcategory_name,
            'product_brand_id'          => $brand_id,
            'product_brand_name'        => $brand_name,
            'quantity'                  => $request->quantity,
            'slug'                      => strtolower(str_replace(' ','-',$request->product_name))
        ]);

        Category::where('id', $category_id)
            ->increment('product_count',1);
        SubCategory::where('id', $subcategory_id)
            ->increment('product_count',1);

        return redirect()
            ->route('admin.allproduct')
            ->with('message', 'Product Added Successfully');

    }

    public function EditProduct($id)
    {
        $product_info = Product::findOrFail($id);
        return view('admin.editproduct', compact('product_info'));
    }

    public function UpdateProduct(Request $request)
    {
        $request->validate([
            'product_name'           => 'required|unique:products',
            'product_price'          => 'required',
            'quantity'               => 'required',
            'product_short_des'      => 'required',
            'product_long_des'       => 'required'
        ]);

        $id = $request->product_id;

        product::findOrFail($id)->update([
            'product_name'         => $request->product_name,
            'product_price'        => $request->product_price,
            'product_short_des'    => $request->product_short_des,
            'product_long_des'     => $request->product_long_des,
            'quantity'             => $request->quantity,
            'slug'                 => strtolower(str_replace(' ','-',$request->product_name))
        ]);

        return redirect()
            ->route('admin.allproduct')
            ->with('message', 'Product Updated Successfully');
    }

    public function DeleteProduct( $id)
    {
        $category_id = Product::where('id', $id)
            ->value('product_category_id');
        $subcategory_id = Product::where('id', $id)
            ->value('product_subcategory_id');;

        Product::findOrFail($id)->delete();

        Category::where('id', $category_id)
            ->decrement('product_count',1);
        SubCategory::where('id', $subcategory_id)
            ->decrement('product_count',1);


        return redirect()
            ->route('admin.allproduct')
            ->with('message', 'Product Deleted Successfully');
    }

    public function DeactivateProduct(Request $request)
    {
        $id =  $request->cat_id;
        Product::where('id', $id)->update([
            'status' => 'notactive'
        ]);

        return redirect()
            ->route('admin.allproduct')
            ->with('message', 'Product Deactivate Successfully');
    }

    public function ActivateProduct(Request $request)
    {
        $id =  $request->cat_id;
        Product::where('id', $id)->update([
            'status' => 'active'
        ]);

        return redirect()
            ->route('admin.allproduct')
            ->with('message', 'Product Activate Successfully');
    }

    public function EditProductImg($id)
    {
        $product_info = Product::findOrFail($id);
        return view('admin.editproductimg', compact('product_info'));
    }

    public function UpdateProductImg(Request $request)
    {
        $request->validate([
            'product_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $id = $request->product_id;
        if ($request->hasFile('product_img') && $request->file('product_img')->isValid()) {
            $img_name = time().'.'.$request->product_img->extension();
            $img_url = 'upload/' . $img_name;
        }

        Product::findOrFail($id)->update([
            'product_img' => $img_url
        ]);

        $request->product_img->move(public_path('upload'), $img_name);

        return redirect()
            ->route('admin.allproduct')
            ->with('message', 'Product Image Update Successfully');
    }
}
