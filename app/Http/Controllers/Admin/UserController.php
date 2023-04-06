<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();

        return view('admin.users.index', compact('users'));
    }

    
    public function store(UserCreateRequest $request)
    {
       
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone_number,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User created succesfully');
    }

    // Edit a record
    public function edit($id) 
    {
        $record = User::find($id);
        return response()->json($record);
    }

    
    // Update a record
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);
        $user->first_name = $request->input('e_first_name');
        $user->last_name  = $request->input('e_last_name');
        $user->phone = $request->input('e_phone_number');
        $user->address = $request->input('e_address');
        $user->email = $request->input('e_email');
        if ($request->input('e_password') != NULL) {
             $user->password =  Hash::make($request->e_password);
        }
        $user->save();
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    // Delete a record 
    public function destroy($id)
    {
        $record = User::findOrFail($id);
        $record->delete(); 
        return response()->json([
            'status' => 200
        ]); 
    }
}
