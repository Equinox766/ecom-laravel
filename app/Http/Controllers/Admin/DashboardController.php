<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function AllCategory()
    {
        return view('admin.allcategory');
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
