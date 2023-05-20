<?php

namespace App\Http\Controllers\Mobile;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Payment;
use App\Models\OrderContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function getCartItems($id)
    {
        $cartItems = DB::table('products')
            ->join('carts', 'products.id', '=', 'carts.product_id')
            ->where('carts.user_id', $id)
            ->where('inPayment', 0)
            ->get();

        return response()->json(['message' => 'success','data' => $cartItems], 200);
    }

    public function getAllCartItems(Request $request)
    {
        return DB::table('products')
            ->join('carts', 'products.id', '=', 'carts.product_id')
            ->where('carts.user_id', $request->id)
            ->where('inPayment', 0)
            ->get();

        // return response()->json(['message' => 'success','data' => $cartItems], 200);
    }


    public function updateQuantity(Request $request)
    {
        $product_count = DB::table('carts')->where('product_id', $request->product_id)->count();
        if($product_count >= $request->quantity) {
             $cart_item = Cart::find($request->id);
            if ( $cart_item->quantity == 1) {
                $cart_item->delete();
            }else {
                $cart_item->quantity = $request->quantity;
                $cart_item->save();
            }
        }

        return response()->json(['message' => 'success'], 200);
    }

    public function checkout(Request $request)
    {

        $product_ids = str_replace('"', '', json_encode($request->product_id));
        foreach (json_decode($request->product_id) as $product_id) {
            DB::table('carts')
                ->where('inPayment', 0)
                ->where('product_id', $product_id)
                ->update(['inPayment' => 1]);
        }
        
        // hatak nalang by default
        $user = User::find($request->user_id);
        $orderContact = OrderContact::create([
            'first_name' =>$user->first_name,
            'last_name' =>$user->last_name,
            'phone' =>$user->phone_number,
            'address' =>$user->address,
            'email' =>$user->email,
            'courier' =>'GrabExpress',
        ]);

        $tracking = Carbon::now()->format('Y') . random_int(10000, 99999); 

        Payment::create([
            'user_id' => $request->user_id,
            'product_id' => $product_ids,
            'total_price' => $request->total_price,
            'trackingnumber' => $tracking,
            'status' => "Order Placed",
            'payment_method' => 1, // default
            'amount_paid' => $request->total_price,
            'order_contact_id' => $orderContact->id,
        ]);
    } 

    public function removeToCart(Request $request)
    {
        return DB::table('carts')
            ->where('id', $request->id)
            ->delete();
    }
}
