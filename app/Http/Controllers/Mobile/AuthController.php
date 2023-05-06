<?php

namespace App\Http\Controllers\Mobile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

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
                return response(['message' => 'error']);
            }
        }
    }

    // Signup 
    public function signup(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric'],
            'address' => ['required', 'string',  'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        event(new Registered($user));

        return response()->json(['message' => 'success'], 201);
    }
}
