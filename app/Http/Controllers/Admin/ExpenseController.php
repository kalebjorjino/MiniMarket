<?php

namespace App\Http\Controllers\Admin;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    public function index() 
    {
        // $expenses = Expense::all()->sortByDesc('created_at');
        // return view('admin.expenses.index', ['expenses' => $expenses]);
        
        $categories = Category::all();
        $products = Product::all();
        return view('admin.expenses.index', ['products' => $products, 'categories' => $categories]);
    }

    
    public function getProduct(Request $request)
    {
         $id=$request['search'] ?? "";
         if ($id !=""){
             $query = Product::find($id);
         }
        return response()->json($query);
    }
}
