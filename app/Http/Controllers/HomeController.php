<?php

namespace App\Http\Controllers;

use App\Rules\alpha_spaces;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


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
        return view('customer.profile', ['user' => $user]);
    }

    public function editProfile(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'max:255', new alpha_spaces],
            'last_name' => ['required', 'max:255', new alpha_spaces],
            'phone' => ['required', 'numeric', 'digits:11'],
            'address' => ['required', 'string',  'max:255'],
        ]);

        DB::table('users')->where('email', $request->email)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect('/account/profile')->with('success', "Your profile has been successfully updated!");
    }

    public function changePassword()
    {
        return view('customer.changePassword');
    }

    public function updateChangePassword(Request $request){

         $request->validate([
            'current_password' => 'required',
         ]);
     
        $user = DB::table('users')
            ->where('id', $request->id)
            ->get();

        if (!(Hash::check($request->current_password, $user[0]->password))) {   
            return redirect('/changePassword')->with('error', "Your current password does not matches with the password you provided. Please try again.");

        } 
        elseif(strcmp($request->current_password, $request->new_password) == 0){
            return redirect('/changePassword')->with("error","New Password cannot be same as your current password. Please choose a different password.");
        } 
        else {
            $request->validate([
            'new_password' => ['required', Password::min(8)
            ->mixedCase()
            ->numbers()
            ->symbols(), 'confirmed']
         ]);
        }
 
        DB::table('users')
        ->where('id', $request->id)
        ->update([
            'password' => Hash::make($request->new_password)
        ]);
        
        return redirect('/changePassword')->with('success', 'Your password has been changed successfully!');
    
    }
}