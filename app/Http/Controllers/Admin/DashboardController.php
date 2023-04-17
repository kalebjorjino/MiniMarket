<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
       
        $activeProducts = Product::where('status', 1)->count();
        $users = User::whereNotNull('email_verified_at')->count();
        $income = Payment::where('status', 'Completed')->sum('total_price');
        $expenses = Expense::all()->sum('total_price');
        $items = Product::whereRaw('stocks <= stock_alert')->get();
       
        return view('admin.dashboard', [
            'expenses' => $expenses,
            'income' => $income,
            'items' => $items,
            'active' => $activeProducts,
            'users' => $users,
        ]);
    }
}
