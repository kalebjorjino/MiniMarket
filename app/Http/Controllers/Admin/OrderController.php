<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class OrderController extends Controller
{
    // public function index() 
    // {
    //     // $orders = Order::all()->sortByDesc('created_at');
    //     // return view('admin.categories.index', ['orders' => $orders]);
    //     return view('admin.orders.index');
    // }

    public function index()
    {
        $datas = Payment::where('product_id', '!=', null)->orderBy('created_at', 'desc')->get();

        $payments = [];

        foreach($datas as $payment){

            $cart_id = json_decode($payment->product_id);
            $cart_items = Cart::find($cart_id);

            $carts = [];

            foreach($cart_items as $cart){

                // $canvas_item = $cart->canvas;
                // $canvas = [];

                // if(count($canvas_item) > 0){
                //     foreach($canvas_item as $canva){
                //         array_push($canvas, [
                //             'height' => $canva->height,
                //             'width' => $canva->width,
                //             'image' => $canva->image,
                //         ]);
                //     }
                // }
                // else $canvas = null;

                $product = [
                    'title' => $cart->product->title,
                    // 'directory' => $this->getFolder($cart->product->category_id) . '/' . $cart->product->folder . '/',
                    'category_id' => $cart->product->category_id,
                    // 'preview_image' => $cart->product->preview_image,
                    'price' => $cart->product->price,
                ];

                array_push($carts, [
                    'id' => $cart->id,
                    'quantity' => $cart->quantity,
                    'product' => $product,

                    // 'notes' => $cart->notes,
                    // 'size' => $cart->size,
                    // 'color' => $cart->color,
                    // 'paper' => $cart->paper,
                    // 'print_color' => $cart->print_color,
                    // 'upload_design' => $cart->upload_design,
                    // 'canvas' => $canvas,
                ]);
            }
                     
            $data = [
                'id' => $payment->id,
                // "payment_type" => $payment->payment_type,
                "payment_method" => $payment->payment_method,
                // "payment_image_url" => $payment->payment_image_url,
                "total_price" => $payment->total_price,
                "trackingnumber" => $payment->trackingnumber,
                "amount_paid" => $payment->amount_paid,
                "status" => $payment->status,
                "created_at" => $payment->created_at,
                "updated_at" => $payment->updated_at,
                'user' => $payment->user->first_name . ' ' . $payment->user->last_name,
                'cart' => $carts
            ];

            array_push($payments, $data);
        }

        return view('admin.orders.index', [
            'payments' => json_encode($payments)
        ]);
    }

    public function updateStatus(Request $request, Payment $payment){

        $counts =[
           "Pending" => -1,
            "Order Placed"=> 0,
            "Processing" => 1,
            "Completed" => 2,
            "Cancelled" =>2,
        ];

        if( $counts[$request->status] <= $counts[$payment->status]){

            return response()->json([
                'hasError' => true,
            ]);
        }

        $payment->status = $request->status;
    
        $payment->save();

        return response()->json([
            'status' => 200,
            'hasError' => false,
        ]);
    }

    public function show($tracking){

        $payment = Payment::where('trackingnumber', $tracking)->first();

        $cart_id = json_decode($payment->product_id);
        $cart_items = Cart::find($cart_id);

        $carts = [];

        foreach($cart_items as $cart){

          
            $product = [
                'title' => $cart->product->title,
                'category_id' => $cart->product->category_id,
                'product_cover' => $cart->product->product_cover,
                'price' => $cart->product->price,
               
            ];

            array_push($carts, [
                'id' => $cart->id,
               
                'quantity' => $cart->quantity,
               
               
                'product' => $product,
            ]);
        }
                    
        $data = [
            'id' => $payment->id,
           
            "payment_method" => $payment->payment_method,
         
            "total_price" => $payment->total_price,
            "amount_paid" => $payment->amount_paid,
            "user_id" => $payment->user_id,
            "trackingnumber" => $payment->trackingnumber,
            "trackingnumberP" => $payment->trackingnumberP,
            "status" => $payment->status,
            "created_at" => $payment->created_at,
     
            'user' => [
                'name' =>  $payment->user->first_name . ' ' . $payment->user->last_name,
                'email' =>  $payment->user->email,
                'phone' => $payment->user->phone,
            ],
            'cart' => $carts
        ];

        return view('admin.orders.show', [
            'payment' => json_encode($data),
            'tracking' => $tracking,
        ]);
    }
}
