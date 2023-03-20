<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index() 
    {
        $categories = Category::all()->sortByDesc('created_at');
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate(['name' => ['required', 'string', 'unique:categories']]);

        // To Delete
        // $slug = Str::slug($request->name, '-');
        // $path = '/public/products' .'/'. $slug;
        // Storage::makeDirectory($path);

        $category = Category::create(['name' => $formFields['name']]);
      
        if ($request->hasFile('category_icon')){
            $category_icon = Storage::disk('public')->put('/categories' . '/' . $category->id, $request->file('category_icon'));
            $category->update(['category_icon' => $category_icon]);
        }

        return redirect()->route('categories.index')->with('success', 'Category created succesfully');
    }

    // Edit a record
    public function edit($id) 
    {
        $record = Category::find($id);
        return response()->json($record);
    }

    // Update a record
    public function update(Request $request, $id)
    {
        $record = Category::find($id);
        $record->name = $request->e_name;
        $record->save();
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    // Delete a record 
    public function destroy($id)
    {
        $record = Category::findOrFail($id);
        $record->delete(); 
        return response()->json([
            'status' => 200
        ]); 
    }
}
