<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index() 
    {
        $categories = Category::all()->sortByDesc('created_at');
        return view('admin.categories.index', ['categories' => $categories]);
    }
}
