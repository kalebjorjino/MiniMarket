<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminProfileUpdateRequest;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show()
    {
        return view('admin.profile');
    }

    public function update(AdminProfileUpdateRequest $request)
    {
        if ($request->password) {
            auth()->guard('admin')->user()->update(['password' => Hash::make($request->password)]);
        }

        auth()->guard('admin')->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Your profile has been updated');
    }
}
