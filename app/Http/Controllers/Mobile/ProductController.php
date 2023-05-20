<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function getProduct(Request $request)
    {
        return DB::table('category')
            ->join('products', 'products.category_id', '=', 'category.id')
            ->where('products.id', $request->id)
            ->get();
    }

    public function addToCart(Request $request)
    {
        $cart = Cart::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);
        return response()->json(['message' => 'success'], 201);
    }

    public function getProducts()
    {
        $products = ProductResource::collection(Product::where('status', 1)->where('stocks', '<>', '0')->get());
        return response()->json(['message' => 'success','data' => $products], 200);
    }
    
}
