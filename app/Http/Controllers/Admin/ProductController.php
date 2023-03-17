<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index() 
    {
        $products = Product::all()->sortByDesc('created_at');
        return view('admin.products.index', ['products' => $products]); 
    }

    // Create a record
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create-product', ['categories' => $categories, 'brands' => $brands]);
    }

    // Store a record
    public function store(Request $request)
    {
        //  dd($request);
  
         $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,       
            'stocks' => $request->stocks,       
            'featured' => $request->exists('featured') ? 1 : 0,
            'status' => $request->exists('status') ? 1 : 0,
            'brand_id' => $request->brand,
            'category_id' => $request->category,
        ]);

        // Path1: public/products/category-name/product-id/
        // $cat = $this->getCategory($request->category_id);
        // $path = '/products' .'/'. $cat .'/'. $product->id;
        // $directory = '/products' . substr($directory, strripos($directory, '/'));

        // Path2: public/products/product-id/
         $path = '/products'.'/'. $product->id;
        
        if ($request->hasFile('product_cover')){
            $product_cover_name = $request->file('product_cover')->getClientOriginalName();

            // $product_cover = Storage::disk('public')->put($path . '/product_cover' .'/'. $product_cover_name, $request->file('product_cover'));
            $product_cover = Storage::disk('public')->put($path . '/product_cover', $request->file('product_cover'));
            $product->update(['product_cover' => $product_cover]);
        }


        // Reference - to delete 
            //      if ($request->hasFile('product_samples')) {
            // $product_samples_name = $request->file('product_samples')->getClientOriginalName();
            // $request->file('product_samples')->storeAs('products_product_samples', $product->id . '/' . $product_samples_name, 'public');
            // $product->update(['product_samples' => $product_samples_name]);
        // }

        return redirect()->route('products.index')->with('success', 'Product created succesfully');
    }

    public function getCategory($id)
    {
        $category = Category::find($id);
        return Str::slug($category->name, '-');
    }

    // Delete a record 
    public function destroy($id)
    {
        $record = Product::findOrFail($id);
        if($record->product_cover){
            Storage::disk('public')->deleteDirectory('/products' . '/' . $id);
        }
        $record->delete(); 
        return response()->json([
            'status' => 200
        ]); 
    }
}
