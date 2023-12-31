<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show()
    {
        return view('customer.account.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Your profile has been updated');
    }
    
}
