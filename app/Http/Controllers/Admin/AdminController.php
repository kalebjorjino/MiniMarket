<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminCreateRequest;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::paginate();

        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        // modal or a new view?
    }

    public function store(AdminCreateRequest $request)
    {
        // Admin::create($request->all());
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

           
        return redirect()->route('admins.index')->with('success', 'User has been created succesfully');
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
        $record = Admin::findOrFail($id);
        return view('admins.edit', compact('record'));
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
