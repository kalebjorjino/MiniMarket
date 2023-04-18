<?php

namespace App\Http\Controllers\Mobile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    
    // Login
    public function login(Request $request)
    {
        $user = User::firstWhere('email', $request->email);

        if ($user == null) {
            // return "error";
            return response(['message' => $request->all()]);
        } else { 
            if ($user->email == $request->email && Hash::check($request->password, $user->password)) {
                return response(['message' => 'success', 'data' => $user]);
            } else {
                return response(['message' => 'asdad']);
            }
        }
    }

    // Signup 
    public function signup(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|min:11',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $user->save();

        $token = $user->createToken('MyApp')->accessToken;

        return response()->json(['token' => $token], 201);
    }

    // public function login(Request $request)
    // {
    //     $exist = DB::table('users')
    //         ->where('email', $request->email)
    //         ->count();

    //     if ($exist == 0) {
    //         return "error";
    //     } else {
    //         $user = DB::table('users')
    //             ->where('email', $request->email)
    //             ->get();
    //         if ($user[0]->email == $request->email && Hash::check($request->password, $user[0]->password)) {
    //             return response(['message' => 'success', 'data' => $user]);
    //         } else {
    //             return response(['message' => 'error']);
    //         }
    //     }
    // }
}
