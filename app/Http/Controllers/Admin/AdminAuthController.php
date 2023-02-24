<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function index() {
        if(Auth::guard('admin')->check())
            return redirect('adminDashboard');
        return view('admin.auth.login');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required | email',
            'password'=> 'required'
        ]);
    
        if(auth()->guard('admin')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]))
        {
            // $user = auth()->guard('admin')->user();
            // if($user->is_admin == 1){
            return redirect()->route('adminDashboard')->with('success', 'You are Logged in successfully.');
        } else {
            return back()->with('error', 'Invalid email or password.');
        }
    }

    public function logout() {
        if(Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect()->route('adminLogin');
        }
    }
}
