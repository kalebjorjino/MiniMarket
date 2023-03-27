<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function logout() {
        if(Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            return redirect()->route('login');
        }
    }    

    // dashboard
    public function dashboard()
    {
     
        $id = Auth::user()->id; 
        $user = DB::table('users') 
            ->where('id', $id)
            ->first();
        // $orders = DB::table('carts')->where(['user_id' => $id, 'inPayment' => 1])
        // ->count();
        
            return view('customer.dashboard', ['user' => $user]
       );
    }

    // My Profile
    public function profile()
    {
        $user = DB::table('users') 
            ->where('id', Auth::user()->id)
            ->first();
        return view('customer..profile', ['user' => $user]);
    }
}