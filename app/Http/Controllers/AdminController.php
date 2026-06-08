<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        // $admin = Admin::withoutTrashed()->get();
        $admin = Admin::withoutTrashed()->latest()->paginate(5);

        // dd($admin);
        return response()->view('dashboard.admin.index', ['admins' => $admin]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('dashboard.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|max:100|unique:admins,email',
            'mobile' => 'required|string|min:10|max:15',
            'password' => 'required|string|min:8|max:255',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
            'status' => true,
        ]);

        return response()->json([
            'icon' => $admin ? 'success' : 'error',
            'title' => $admin ? 'Created!' : 'Failed!',
            'text' => $admin
                ? 'Admin created successfully.'
                : 'Failed to create admin.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
        return response()->view('dashboard.admin.edit', ['admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|max:100|unique:admins,email,' . $admin->id,
            'mobile' => 'required|string|min:10|max:15',
            'password' => 'nullable|string|min:8|max:255',
        ]);

        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->mobile = $request->input('mobile');
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }
        $admin_updated = $admin->save();

        return redirect()->route('admins.index')->with([
            'icon' => $admin_updated ? 'success' : 'error',
            'message' => $admin_updated ? 'Admin updated successfully!' : 'Failed to update admin.'
        ], 3000);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = Admin::findorFail($id);
        $deleted = $admin->delete();

        return response()->json([
            'icon' => $deleted ? 'success' : 'error',
            'title' => $deleted ? 'Deleted!' : 'Failed!',
            'text' => $deleted
                ? 'Admin deleted successfully.'
                : 'Failed to delete admin.'
        ]);
    }
}
