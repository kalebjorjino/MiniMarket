<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    public function index() 
    {
        // $expenses = Expense::all()->sortByDesc('created_at');
        // return view('admin.expenses.index', ['expenses' => $expenses]);
        return view('admin.expenses.index');
    }
}
