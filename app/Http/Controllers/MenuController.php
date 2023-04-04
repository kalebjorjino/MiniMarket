<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index() {
        $products = Product::where('status', true)->get();
        $datas = [];

        foreach($products as $product){
            $data = [
                'product' => $product,
                // 'colors' => $product->category,
                // 'colors' => $product->colors,
                // 'sizes' => $product->sizes,
                // 'papers' => $product->papers,
                // 'directory' => $product->category->folder_cat
            ];

            array_push($datas, $data);
        }


        return view('customer.menu.index', [
            'products' => json_encode($datas),
        ]);
    }

    public function show($slug)
    {
        // $product = Product::find($sid);

        $product = Product::where('slug', $slug)->first();
    
        $data = [
            'product' => $product,
            // 'colors' => $product->colors,
            // 'sizes' => $product->sizes,
            // 'papers' => $product->papers,
            'category' => $product->category->name,
        ];


        return view('customer.menu.product-show', [
            'product' => json_encode($data),
        ]);
    }
}
