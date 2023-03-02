<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminsUpdateRequest;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::paginate();

        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        // view
    }

    public function store(AdminCreateRequest $request)
    {
        // Admin::create($request->all());
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admins.index')->with('success', 'User created succesfully');
    }

    // Show a record
    // public function show($id)
    // {
    //     $record = Admin::findOrFail($id);
    //     return view('admin.show', compact('record'));
    // }

    // Edit a record
    public function edit($id) 
    {
        $record = Admin::find($id);
        // return view('admins.edit', compact('record'));
        return response()->json($record);
    }

    // Update a record
    public function update(AdminsUpdateRequest $request, $id)
    {
        $user = Admin::find($id);
        $user->name = $request->input('e_name');
        $user->email = $request->input('e_email');
        if ($request->input('e_password') != NULL) {
             $user->password =  Hash::make($request->e_password);
        }
        $user->save();
        return redirect()->route('admins.index')->with('success', 'User updated successfully');
    }

    // Delete a record 
    public function destroy($id)
    {
        $record = Admin::findOrFail($id);
        $record->delete(); 
        return response()->json([
            'status' => 200
        ]); 
        // return redirect()->route('admins.index');
    }
}
