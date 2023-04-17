<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Product;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
       
        $activeProducts = Product::where('status', 1)->count();
        $users = User::whereNotNull('email_verified_at')->count();
        $income = Payment::where('status', 'Completed')->sum('total_price');
        $expenses = Expense::all()->sum('total_price');
        $items = Product::whereRaw('stocks <= stock_alert')->get();

        // Latest 5 Order
        $payments = Payment::where('status', '!=' ,'Cancelled')->whereNotNull('product_id')->orderBy('created_at', 'desc')->take(5)->get();
        $latestOrders = [];

        foreach($payments as $order){
           
            array_push($latestOrders, [
                'total' => $order->total_price,
                'trackingnumber' => $order->trackingnumber,
                'status' => $order->status,
                'created_at' => $order->created_at,
            ]);
        }

        return view('admin.dashboard', [
            'expenses' => $expenses,
            'income' => $income,
            'items' => $items,
            'active' => $activeProducts,
            'users' => $users,
            'latest' =>  $latestOrders,
        ]);
    }
}
