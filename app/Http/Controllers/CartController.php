<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
// use App\Models\Paypal;
// use Omnipay\Omnipay;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;



class CartController extends Controller
{
    
    public function validation($data, $validate){
        
        $validated = Validator::make($data, $validate);

        return $validated;
    }
    
    // add to cart
    public function addToCart(Request $request)
    {
        $data = $request->all();

        $validate = [
            'quantity' => ['required', 'numeric'],
        ];

        $validated = $this->validation($data, $validate);

        if($validated->fails()){
            return response()->json([
                'status' => 200,
                'hasError' => true,
            ]);
        }

        $id = $request->uid;

        $cart = Cart::create([
            'user_id' => $id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

       
        $cart->save();

        return response()->json([
            'status' => 200,
            'hasError' => false,
        ]);
    }   

    // load cart page
    public function cartPage()
    {
        $datas = Cart::where('user_id', Auth::user()->id)->where('inPayment', false)->get();
        $carts = [];

        foreach($datas as $data){
            $data = [
                'cart' => $data,
                'product' => [
                    'id' => $data->product->id,
                    // 'directory' => $this->getFolder($data->product->category_id) . '/' . $data->product->folder . '/',
                    'title' => $data->product->title,
                    // 'preview' => json_decode($data->product->preview_image)[0],
                    'price' => json_decode($data->product->price),
                    'product_cover' => $data->product->product_cover,
                    'slug' => $data->product->slug,
                    
                    // 'print_price' => $data->product->print_price,
                ],
                // 'canvas' => $data->canvas,
            ];

            array_push($carts, $data);
        }

        return view('customer.cart.cart', [
            'cart_items' => json_encode($carts),
        ]);
    }

    // cart item delete
    public function delete(Request $request){
        $data = $request->all();

        $cart = Cart::find($data['id']);

        $cart->delete();

        return response()->json([
            'status' => 200,
            'hasError' => false,
        ]);
    }

    // cart quantity update
    public function update(Request $request){
        $data = $request->all();

        foreach($data['carts'] as $item){
            $cart = Cart::find($item['id']);

            if($item['qty'] <= 0) $cart->delete();
            else{
                $cart->quantity = $item['qty'];
                $cart->save();
            }
        }

        return response()->json([
            'status' => 200,
            'hasError' => false,
        ]);

    }

    // place order 
    public function requestOrder(Request $request){
        $data = $request->all();

        $carts = Cart::where('user_id', $data['id'])->where('inPayment', false)->get();

        $carts_id = [];

        $tracking = strtoupper(Str::random(9)); //temp
        
        foreach($carts as $cart){
            array_push($carts_id, $cart->id);
            $cart->inPayment = true;
            $cart->save();
        }
        
        if((int)$data['id'] > 0){
            Payment::create([
                'user_id' => $data['id'],
                'product_id' => json_encode($carts_id),
                'total_price' => $data['total'],
                // 'deadline' => Carbon::parse($data['date'])->format('Y-m-d'),
                'trackingnumber' => $tracking,
            ]);
        }
        else{
            // pang mobile customers maybe?
            $payment = Payment::create([
                'user_id' => $data['id'],
                'product_id' => json_encode($carts_id),
                'total_price' => $data['total'],
                // 'deadline' =>  now(),
                'trackingnumber' => $tracking,
                'status' => 'In Process',
                'amount_paid' => $data['total'],
                'payment_method' => 'COD',
            ]);

        }

        return response()->json([
            'status' => 200,
            'hasError' => false,
            'tracking' => $tracking
        ]);

    }


    // public function checkout($tracking)
    // {

    //     $payment = Payment::where('trackingnumber', $tracking)->first();

    //     $payment->trackingnumberP = strtoupper(Str::random(9));
    //     $payment->save();
    //     $cart_id = json_decode($payment->product_id);
    //     $carts = Cart::find($cart_id);

    //     return view('features.Admin.pos-success', [
    //         'payment' => $payment,
    //         'carts' => $carts,
    //         'id' => '-'.Auth::guard('web')->user()->id,
    //     ]);
    // }


    // order success
    public function orderSuccess($tracking)
    {
        $payment = Payment::where('trackingnumber', $tracking)->first();

        $cart_id = json_decode($payment->product_id);
        $carts = Cart::find($cart_id);

        return view('customer.cart.order-success', [
            'payment' => $payment,
            'carts' => $carts,
        ]);
    }


}
