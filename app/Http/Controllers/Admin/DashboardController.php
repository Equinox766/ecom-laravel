<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        return view('admin.dashboard');
    }

    public function PendingOrder()
    {
        $orders = Order::where('status', 'pending')->latest()->get();
        return view('admin.pendingorder', compact('orders'));
    }

    public function CreateCategory()
    {
        return view('admin.createcategory');
    }

    public function StoreCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ','-',$request->category_name))
        ]);

        return redirect()
            ->route('admin.allcategory')
            ->with('message', 'Category Added Successfully');
    }

    public function AllCategory()
    {
        $categories = Category::latest()->get();
        return view('admin.allcategory', compact('categories'));
    }

    public function EditCategory($id)
    {
        $category_info = Category::findOrFail($id);
        return view('admin.editcategory', compact('category_info'));
    }

    public function UpdateCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);

        $id = $request->category_id;

        Category::findOrFail($id)->update([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ','-',$request->category_name))
        ]);

        return redirect()
            ->route('admin.allcategory')
            ->with('message', 'Category Updated Successfully');
    }

    public function DeleteCategory($id)
    {
        Category::findOrFail($id)->delete();

        return redirect()
            ->route('admin.allcategory')
            ->with('message', 'Category Deleted Successfully');
    }

    public function DeactivateCategory(Request $request)
    {
        $id =  $request->cat_id;
        Category::where('id', $id)->update([
            'status' => 'notactive'
        ]);

        return redirect()
            ->route('admin.allcategory')
            ->with('message', 'Category Deactivate Successfully');
    }

    public function ActivateCategory(Request $request)
    {
        $id =  $request->cat_id;
        Category::where('id', $id)->update([
            'status' => 'active'
        ]);

        return redirect()
            ->route('admin.allcategory')
            ->with('message', 'Category Activate Successfully');
    }

    public function CreateSubcategory()
    {
        return view('admin.createsubcategory');
    }

    public function StoreSubcategory(Request $request)
    {
        $request->validate([
            'sub_category_name' => 'required|unique:sub_categories'
        ]);

        $category_name = Category::where('id', $request->category_id)->value('category_name');

        SubCategory::insert([
            'sub_category_name' => $request->sub_category_name,
            'slug' => strtolower(str_replace(' ','-',$request->sub_category_name)),
            'product_count' => 0,
            'category_id' => $request->category_id,
            'category_name' => $category_name,
        ]);

        return redirect()
        ->route('admin.allsubcategory')
        ->with('message', 'Sub Category Added Successfully');
    }

    public function AllSubcategory()
    {
        $subcategories = SubCategory::latest()->get();
        return view('admin.allsubcategory', compact('subcategories'));
    }
    public function EditSubCategory($id)
    {
        $subcategory_info = SubCategory::findOrFail($id);
        return view('admin.editsubcategory', compact('subcategory_info'));
    }

    public function UpdateSubCategory(Request $request)
    {
        $request->validate([
            'sub_category_name' => 'required|unique:sub_categories'
        ]);

        $id = $request->sub_category_id;

        $category_name = Category::where('id', $request->category_id)->value('category_name');

        SubCategory::findOrFail($id)->update([
            'sub_category_name' => $request->sub_category_name,
            'slug' => strtolower(str_replace(' ','-',$request->sub_category_name)),
            'category_id' => $request->category_id,
            'category_name' => $category_name,
        ]);

        return redirect()
            ->route('admin.allsubcategory')
            ->with('message', 'Sub Category Updated Successfully');
    }

    public function DeleteSubCategory($id)
    {
        SubCategory::findOrFail($id)->delete();

        return redirect()
            ->route('admin.allsubcategory')
            ->with('message', 'Sub Category Deleted Successfully');
    }

    public function DeactivateSubCategory(Request $request)
    {
        $id =  $request->cat_id;
        SubCategory::where('id', $id)->update([
            'status' => 'notactive'
        ]);

        return redirect()
            ->route('admin.allsubcategory')
            ->with('message', 'Sub Category Deactivate Successfully');
    }

    public function ActivateSubCategory(Request $request)
    {
        $id =  $request->cat_id;
        SubCategory::where('id', $id)->update([
            'status' => 'active'
        ]);

        return redirect()
            ->route('admin.allsubcategory')
            ->with('message', 'Sub Category Activate Successfully');
    }

    public function CreateBrands()
    {
        return view('admin.createbrands');
    }

    public function StoreBrand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|unique:brands'
        ]);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'slug' => strtolower(str_replace(' ','-',$request->brand_name))
        ]);

        return redirect()
            ->route('admin.allbrand')
            ->with('message', 'Brand Added Successfully');
    }

    public function AllBrand()
    {
        $brands = Brand::latest()->get();
        return view('admin.allbrand', compact('brands'));
    }

    public function EditBrand($id)
    {
        $brand_info = Brand::findOrFail($id);
        return view('admin.editbrand', compact('brand_info'));
    }

    public function UpdateBrand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|unique:brands'
        ]);

        $id = $request->brand_id;

        Brand::findOrFail($id)->update([
            'brand_name' => $request->brand_name,
            'slug' => strtolower(str_replace(' ','-',$request->brand_name))
        ]);

        return redirect()
            ->route('admin.allbrand')
            ->with('message', 'Brand Updated Successfully');
    }

    public function DeleteBrand($id)
    {
        Brand::findOrFail($id)->delete();

        return redirect()
            ->route('admin.allbrand')
            ->with('message', 'Brand Deleted Successfully');
    }

    public function DeactivateBrand(Request $request)
    {
        $id =  $request->cat_id;
        Brand::where('id', $id)->update([
            'status' => 'notactive'
        ]);

        return redirect()
            ->route('admin.allbrand')
            ->with('message', 'Brand Deactivate Successfully');
    }

    public function ActivateBrand(Request $request)
    {
        $id =  $request->cat_id;
        Brand::where('id', $id)->update([
            'status' => 'active'
        ]);

        return redirect()
            ->route('admin.allbrand')
            ->with('message', 'Brand Activate Successfully');
    }

}
