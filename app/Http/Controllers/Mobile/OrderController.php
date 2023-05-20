<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function getOrders(Request $request)
    {
        $data = DB::table('payments')->where('user_id', $request->id)->where('product_id', '!=', NULL)->get();
        return $data;
    }

    public function cancelOrder(Request $request)
    {
        DB::table('payments')
            ->where('id', $request->id)
            ->delete();
    }
}
