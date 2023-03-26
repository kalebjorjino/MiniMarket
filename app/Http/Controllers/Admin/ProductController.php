<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
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
        $data = $request->validate(['title' => ['required', 'string', 'unique:products']]);

        $product = Product::create([
            // 'title' => $request->title,
            'title' => $data['title'],
            'description' => $request->description,
            'price' => $request->price,       
            'stocks' => $request->stocks,       
            'stock_alert' => $request->stock_alert,       
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
            // $product_cover_name = $request->file('product_cover')->getClientOriginalName();
            // $product_cover = Storage::disk('public')->put($path . '/product_cover' .'/'. $product_cover_name, $request->file('product_cover'));
            $product_cover = Storage::disk('public')->put($path . '/product_cover', $request->file('product_cover'));
            $product->update(['product_cover' => $product_cover]);
        }

        // upload product preview
        foreach ($request->input('document', []) as $file) {
            $product->addMedia(storage_path('app/public/tmp/uploads/' . $file))->toMediaCollection('document');
        }

        // Reference - to delete 
            //      if ($request->hasFile('product_samples')) {
            // $product_samples_name = $request->file('product_samples')->getClientOriginalName();
            // $request->file('product_samples')->storeAs('products_product_samples', $product->id . '/' . $product_samples_name, 'public');
            // $product->update(['product_samples' => $product_samples_name]);
        // }

        return redirect()->route('products.index')->with('success', 'Product created succesfully');
    }

    // Edit a record
    public function edit(Product $product) 
    {
        $categories = Category::all();
        $brands = Brand::all();

        $mediaItems = $product->getMedia('document'); 
        $record = $product;
        return view('admin.products.update-product', compact(array('categories', 'brands', 'record', 'mediaItems')));
    }

    // Update a record
    public function update(Request $request, Product $product)
    {
        // $product->update($request->all());
        // $product->update($request->except('product_cover'));

        $data = $request->validate(['title' => ['required', 'string', 'unique:products,title,'.$product->id]]);

        $product->update([
            'title' => $data['title'],
            'description' => $request->description,
            'price' => $request->price,       
            'stocks' => $request->stocks,       
            'stock_alert' => $request->stock_alert,       
            'featured' => $request->exists('featured') ? 1 : 0,
            'status' => $request->exists('status') ? 1 : 0,
            'brand_id' => $request->brand,
            'category_id' => $request->category,
        ]);

        // product cover
        $path = '/products'.'/'. $product->id;
        if ($request->hasFile('product_cover')){
            if($product->product_cover){
                Storage::disk('public')->delete($product->product_cover);
            }
            $product_cover = Storage::disk('public')->put($path . '/product_cover', $request->file('product_cover'));
            $product->update(['product_cover' => $product_cover]);
        }

        // delete existing + update product previews
        if($request->input('document'))
        {
            if (count($product->getMedia('document')) > 0) {
                foreach ($product->getMedia('document') as $media) {
                    if (!in_array($media->file_name, $request->input('document', []))) {
                        $media->delete();
                    }
                }
            }

            $media = $product->getMedia('document')->pluck('file_name')->toArray();

            foreach ($request->input('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $product->addMedia(storage_path('app/public/tmp/uploads/' . $file))->toMediaCollection('document');
                }
            }
        }
       


        // note: $prouct->document wasn't working so i replaced it 

        // if (count($product->document) > 0) {
        //     foreach ($product->document as $media) {
        //         if (!in_array($media->file_name, $request->input('document', []))) {
        //             $media->delete();
        //         }
        //     }
        // }
        // $media = $product->document->pluck('file_name')->toArray();
        // foreach ($request->input('document', []) as $file) {
        //     if (count($media) === 0 || !in_array($file, $media)) {
        //         $product->addMedia(storage_path('public/tmp/uploads/' . $file))->toMediaCollection('document');
        //     }
        // }

        // todo: return which product was updated
        return redirect()->route('products.index')->with('success', 'Product '.$product->id.' updated succesfully');
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

    // Store uploads on server
    public function storeMedia(Request $request)
    {
        $path = storage_path('app/public/tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
