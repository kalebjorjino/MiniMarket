<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() 
    {
        // $products = Product::all()->sortByDesc('created_at');
        // return view('admin.categories.index', ['products' => $products]);
        return view('admin.products.index');
    }
}
