<?php

namespace App\Http\Controllers\Admin;


use App\Models\Expense;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    public function index() 
    {
        $expenses = Expense::all()->sortByDesc('created_at');
        // return view('admin.expenses.index', ['expenses' => $expenses]);
        
        $categories = Category::all();
        $products = Product::all();
        return view('admin.expenses.index', ['products' => $products, 'categories' => $categories, 'expenses' => $expenses]);
    }

    // Return a product record 
    public function getProduct(Request $request)
    {
         $id = $request['search'] ?? "";
         if ($id != ""){
             $query = Product::find($id);
         }
        return response()->json($query);
    }

    // Store a record
    public function store(Request $request)
    {
        Expense::create($request->all()); 
        Product::where('id', $request->product_id)->increment('stocks', $request->quantity);
        return redirect()->route('expenses.index')->with('success', 'Expense created succesfully');
    }

    // Edit a record
    public function edit($id) 
    {
        $record = Expense::find($id);
        return response()->json($record);
    }

    // Update a record
    public function update(Request $request, Expense $expense)
    {
        // $expense->update($request->all()); 
        // dd($request);

        if ( $expense->quantity >= $request->e_quantity) {
            $qty = $expense->quantity - $request->e_quantity;
            // decrement stock
             DB::table('products')->update(['stocks' => DB::raw("GREATEST(stocks - $qty , 0)")]);

        } else {
            $qty = $request->e_quantity - $expense->quantity;
            // increment stock
            Product::where('id', $expense->product_id)->increment('stocks', $qty);
        }

        $expense->expense_date = $request->e_expense_date;
        $expense->quantity = $request->e_quantity;
        $expense->total_price = $request->e_total_price;
        $expense->supplier = $request->e_supplier;
        $expense->save();

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully');
    }

    // Delete a record 
    public function destroy($id)
    {
        $record = Expense::find($id);

        // decrement stock up to 0
        DB::table('products')->update(['stocks' => DB::raw("GREATEST(stocks - $record->quantity , 0)")]);

        $record->delete(); 
        return response()->json([
            'status' => 200
        ]); 
    }
}
