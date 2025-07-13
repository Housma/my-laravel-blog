<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminManagementController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.admins.index')->with('status', 'Admin created!');
    }

    public function edit(Admin $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:admins,email,{$admin->id}",
            'role' => 'required|in:admin,user',
        ]);

        $admin->update($request->only('name', 'email', 'role'));

        return redirect()->route('admin.admins.index')->with('status', 'Admin updated!');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.admins.index')->with('status', 'Admin deleted!');
    }
 
}
