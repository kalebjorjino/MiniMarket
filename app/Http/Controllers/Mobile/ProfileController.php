<?php

namespace App\Http\Controllers\Mobile;

use App\Rules\alpha_spaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function editProfile(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => ['required', 'max:255', new alpha_spaces],
            'last_name' => ['required', 'max:255', new alpha_spaces],
            'phone' => ['required', 'numeric', 'digits:11'],
            'address' => ['required', 'string',  'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        DB::table('users')->where('id', $request->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

         return response()->json(['message' => 'success'], 200);
    }

    public function editPassword(Request $request)
    {
        $user = DB::table("users")->where('id', $request->id)->first();
            
        if (!Hash::check($request->old_password, $user->password)) {   
            return response()->json(['error' => 'Your current password does not match with the password you provided. Please try again.'], 422);
        } 
        elseif(Hash::check($request->new_password, $user->password)){
            return response()->json(['error' => 'New Password cannot be the same as your current password.'], 422);
        } 
        else {     
            if($request->new_password){
                DB::table('users')
                    ->where('id', $request->id)
                    ->update(['password' => Hash::make($request->new_password)]);

                return response()->json(['message' => 'success'], 200);
            }
        }
    }

    public function getProfile(Request $request)
    {
        return DB::table('users')->where('id', $request->id)->first();
    }
}
