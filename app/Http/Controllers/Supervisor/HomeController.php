<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        //counts for first row in page ....
        //first card
        $data['categories'] = Category::select('id')->count();
        $data['products'] = Product::select('id')->count();
        return view('supervisor.pages.home',
            compact('data'));
    }
}
