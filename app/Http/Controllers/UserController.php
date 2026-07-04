<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::get();
        $user = User::latest()->paginate(5);

        return response()->view('dashboard.user.index', ['users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::findorFail($id);
        $deleted = $user->delete();

        return response()->json([
            'icon' => $deleted ? 'success' : 'error',
            'title' => $deleted ? 'Deleted!' : 'Failed!',
            'text' => $deleted
                ? 'User deleted successfully.'
                : 'Failed to delete admin.'
        ]);
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        $user->status = !$user->status;

        $user->save();

        return back()->with(
            'success',
            $user->status
                ? 'تم تفعيل الحساب بنجاح'
                : 'تم تعطيل الحساب بنجاح'
        );
    }
}
