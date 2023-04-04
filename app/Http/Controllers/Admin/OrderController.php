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
                "payment_type" => $payment->payment_type,
                "payment_method" => $payment->payment_method,
                "payment_image_url" => $payment->payment_image_url,
                "total_price" => $payment->total_price,
                "trackingnumber" => $payment->trackingnumber,
                "amount_paid" => $payment->amount_paid,
                // "status" => $payment->status,
                "created_at" => $payment->created_at,
                'user' => $payment->user->first_name . ' ' . $payment->user->last_name,
                'cart' => $carts
            ];

            array_push($payments, $data);
        }

        return view('admin.orders.index', [
            'payments' => json_encode($payments)
        ]);
    }
}
