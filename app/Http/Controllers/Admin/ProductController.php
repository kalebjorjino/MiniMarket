<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index() 
    {
        // $products = Product::all()->sortByDesc('created_at');
        // return view('admin.categories.index', ['products' => $products]);
        return view('admin.products.index');
    }

    // Create a record
    public function create()
    {
        return view('admin.products.create-product');
    }


    // Delete a record 
    public function destroy($id)
    {
        $record = Product::findOrFail($id);
        if($record->brand_image){
            Storage::disk('public')->deleteDirectory('/products' . '/' . $id);
        }
        $record->delete(); 
        return response()->json([
            'status' => 200
        ]); 
    }
}
