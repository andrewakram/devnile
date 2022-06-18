<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supervisor;

class HomeController extends Controller
{
    public function index()
    {
        //counts for first row in page ....
        //first card
        $data['supervisors'] = Supervisor::select('id')->count();
        $data['categories'] = Category::select('id')->count();
        $data['products'] = Product::select('id')->count();

        return view('admin.pages.home',
            compact('data'));
    }
}
