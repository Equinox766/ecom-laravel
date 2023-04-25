<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        return view('admin.dashboard');
    }

    public function ContactMessage()
    {
        return view('admin.message');
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

    public function CreateSubcategory()
    {
        return view('admin.createsubcategory');
    }
    
    public function AllSubcategory()
    {
        return view('admin.allsubcategory');
    }
    
    public function CreateBrands()
    {
        return view('admin.createbrands');
    }

    
    public function AllBrands()
    {
        return view('admin.allbrands');
    }

    
}
