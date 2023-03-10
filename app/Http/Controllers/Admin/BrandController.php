<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
     public function index() 
    {
        $brands = Brand::all()->sortByDesc('created_at');
        return view('admin.brands.index', ['brands' => $brands]);
    }

    public function store(Request $request)
    {
         $brand = Brand::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->hasFile('brand_image')){
            $brand_image = Storage::disk('public')->put('/brands' . '/' . $brand->id, $request->file('brand_image'));
            // $brand->update(['brand_image' => '/samj-ecommerce-web/storage/app/public/' . $brand_image]);
            $brand->update(['brand_image' => $brand_image]);
        }

        return redirect()->route('brands.index')->with('success', 'Brand created succesfully');
    }

    // Edit a record
    public function edit($id) 
    {
        $record = Brand::find($id);
        return response()->json($record);
    }

    // Update a record
    public function update(Request $request, $id)
    {
        $record = Brand::find($id);
        $record->name = $request->e_name;
        $record->description = $request->e_description;

        if ($request->hasFile('e_brand_image')){
            if($record->brand_image){
                Storage::disk('public')->delete($record->brand_image);
            }
            $brand_image = Storage::disk('public')->put('/brands' . '/' . $id, $request->file('e_brand_image'));
            $record->brand_image = $brand_image;
        }
        $record->save();
        return redirect()->route('brands.index')->with('success', 'Brand updated successfully');
    }

    // Delete a record 
    public function destroy($id)
    {
        $record = Brand::findOrFail($id);
         if($record->brand_image){
            Storage::disk('public')->deleteDirectory('/brands' . '/' . $id);
        }
        $record->delete(); 
        return response()->json([
            'status' => 200
        ]); 
    }

}
