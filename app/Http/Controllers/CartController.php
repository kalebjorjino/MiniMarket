<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserOrderRequest;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use Omnipay\Omnipay;
// use App\Models\Paypal;
// use Omnipay\Omnipay;


use App\Models\Payment;
use Illuminate\Support\Str;
use App\Models\OrderContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class CartController extends Controller
{
    // private $gateway;

    public function __construct(){
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_SANDBOX_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_SANDBOX_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }
    
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
                    // 'price' => json_decode($data->product->price),
                    'price' => $data->product->price,
                    'product_cover' => $data->product->product_cover,
                    'slug' => $data->product->slug,
                    'stocks' => $data->product->stocks,
                    
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

        // will update quantity ng bawat cart item 
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

    // place order (original)
    public function requestOrder(Request $request){
        $data = $request->all();

        // retrieves all cart item ni customer
        $carts = Cart::where('user_id', $data['id'])->where('inPayment', false)->get();

        $carts_id = [];

        $tracking = strtoupper(Str::random(9)); //temp

        // will update these cart items into inPayment meaning nacheckout na sila 
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
        // else{
        //     // pang mobile customers maybe?
        //     $payment = Payment::create([
        //         'user_id' => $data['id'],
        //         'product_id' => json_encode($carts_id),
        //         'total_price' => $data['total'],
        //         // 'deadline' =>  now(),
        //         'trackingnumber' => $tracking,
        //         'status' => 'In Process',
        //         'amount_paid' => $data['total'],
        //         'payment_method' => 'COD',
        //     ]);

        // }

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

    
    // hinanap yung specific order no. na chineckout
    // $payment = Payments::where('trackingnumber', $tracking)->first();

    // 
    // $carts = Cart::find( json_decode($payment->product_id) );
    // $paypal = Paypal::find(1)->available;

    // return view('features.Customer.shop.checkout', [
    //     'carts' => $carts,
    //     'tracking' => $tracking,
    //     'paypal' => $paypal,
    //     'amount' => $payment->amount_paid,
    //     'type' => 'order'
    // ]);


    // display cart 
    // $datas = Cart::where('user_id', Auth::user()->id)->where('inPayment', false)->get();
    // $carts = [];

    // foreach($datas as $data){
    //     $data = [
    //         'cart' => $data,
    //         'product' => [
    //             'id' => $data->product->id,
    //             'title' => $data->product->title,
    //             'price' => $data->product->price,
    //             'product_cover' => $data->product->product_cover,
    //         ],
    //     ];

    //     array_push($carts, $data);
    // }

    // return view('customer.cart.checkout', [
    //     'cart_items' => json_encode($carts),
    // ]);

    // checkout page / info 
    public function checkout() {
        $user = User::find(Auth::user()->id);
        $carts = Cart::where('user_id', Auth::user()->id)->where('inPayment', false)->get();
        return view('customer.cart.checkout', [
            'carts' => $carts,
            'user' => $user,
        ]);
    
    }

    // save order contact
    public function placeOrder(UserOrderRequest $request){
        $data = $request->all();

        // retrieves all cart item ni customer
        // $carts = Cart::where('user_id', $data['id'])->where('inPayment', false)->get();

        // $carts_id = [];

        $tracking = Carbon::now()->format('Y') . random_int(10000, 99999); 

        // will update these cart items into inPayment meaning nacheckout na sila 
        // foreach($carts as $cart){
        //     array_push($carts_id, $cart->id);
        //     $cart->inPayment = true;
        //     $cart->save();
        // }

         $orderContact = OrderContact::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone_number'],
            'address' => $data['address'],
            'email' => $data['email'],
            'courier' => $data['courier'],
        ]);

        
        // if((int)$data['id'] > 0){
            $payment = Payment::create([
                'user_id' => $data['user_id'],
                'order_contact_id' => $orderContact->id,
                // 'product_id' => json_encode($carts_id),
                'total_price' => $data['total'],
                'trackingnumber' => $tracking,
            ]);
        // }
        // else{
        //     // pang mobile customers maybe?
        //     $payment = Payment::create([
        //         'user_id' => $data['id'],
        //         'product_id' => json_encode($carts_id),
        //         'total_price' => $data['total'],
        //         // 'deadline' =>  now(),
        //         'trackingnumber' => $tracking,
        //         'status' => 'In Process',
        //         'amount_paid' => $data['total'],
        //         'payment_method' => 'COD',
        //     ]);

        // }

        // return response()->json([
        //     'status' => 200,
        //     'hasError' => false,
        // ]);

         return redirect('/cart/checkout/payment/'.$payment->trackingnumber);
    }

    // Show payment page
    public function payment(Request $request, $tracking){
        // $request->session()->put('trackingnumber', $request->trackingnumber);
        // dd($tracking);

        $info = Payment::where('trackingnumber',$tracking)->first();
        $carts = Cart::where('user_id', Auth::user()->id)->where('inPayment', false)->get();
        return view('customer.cart.payment', [
            'carts' => $carts,
            'info' => $info,
        ]);
    }



    // Paypal payment redirect
     public function payOrder(Request $request){
        // $data = $request->all();
        $request->session()->put('trackingnumber', $request->trackingnumber);
        // $request->session()->put('type', $request->order);
        // $request->session()->put('payment_type', $data["payment-type"]);
        
        $amount = 0;
        $payment = Payment::where('trackingnumber', $request->trackingnumber)->first();
        $amount =  $payment->total_price;
     

        try{
            $response = $this->gateway->purchase(array(
                'amount' => $amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error'),
            ))->send();
            
            if($response->isRedirect()){
                $response->redirect();
            }
            else{
                return $response->getMessage();
            }
        } catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    // Update payment record
    public function orderPaypal($payment, $paymentID, $userID, $amount_paid){
        // $tracking = strtoupper(Str::random(10)); //temp


        $carts = Cart::where('user_id', $userID)->where('inPayment', false)->get();

        $carts_id = [];
        foreach($carts as $cart){
            array_push($carts_id, $cart->id);
            $cart->inPayment = true;
            $cart->save();
        }

        $payment->product_id = json_encode($carts_id);

        $payment->trackingnumberP = $paymentID;
        $payment->amount_paid = $amount_paid;
        // $payment->payment_type = $payment_type;
        $payment->payment_method = '1';
        $payment->status = "Order Placed";
        // $payment->payment_image_url = $paymentID;
        $payment->save();

    }


    // Paypal payment success
    public function success(Request $request){
        // $type = $request->session()->pull('type');
        // $payment_type = $request->session()->pull('payment_type');
        $tracking = $request->session()->pull('trackingnumber');
        
        $data = Payment::where('trackingnumber', $tracking)->first();
   

        if($data){
            if($request->input('paymentId') && $request->input('PayerID')){

                $transaction = $this->gateway->completePurchase(array(
                    'payer_id' => $request->input('PayerID'),
                    'transactionReference' => $request->input('paymentId'),
                ));
    
                $response = $transaction->send();
    
                if($response->isSuccessful()){
                    $arr = $response->getData();
                    
                    $paymentID = $response->getTransactionReference();
                    $amount_paid = $arr['transactions'][0]['amount']['total'];
                    // $payID = $arr['id'];
                    
                    $userID = Auth::user()->id;
          
                    $this->orderPaypal($data, $paymentID, $userID, $amount_paid);

                    return redirect('cart/checkout/order-success/'.$tracking);
           
                    // return "Payment success";
                }
                return "ERROR! Transaction Failed. Error in paypal transaction please try again later.";
            }
        }
        return "ERROR! Transaction Failed. Invalid Tracking Number. Please contact us if error persist!";
    }

    public function error(Request $request)
    {
        
        // $type = $request->session()->pull('type');
        // $payment_type = $request->session()->pull('payment_type');

        $tracking = $request->session()->pull('trackingnumber');
        
        $info = null;

        $info = Payment::where('trackingnumber', $tracking)->first();
        $carts = Cart::where('user_id', Auth::user()->id)->where('inPayment', false)->get();
        return view('customer.cart.payment', [
            'carts' => $carts,
            'info' => $info,
        ]);   
    }


    // Order success
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
