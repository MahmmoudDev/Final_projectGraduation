<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('dashboard.auth.login');
    }

    public function dashboard_login(Request $request)
    {
        $credentials = [

            'email'    => $request->email,
            'password' => $request->password,

        ];

        // Admin
        if (Auth::guard('admin')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()
                ->route('admin.dashboard')
                ->with(
                    'success',
                    'Welcome Admin'
                );
        }

        // Doctor
        if (Auth::guard('doctor')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()
                ->route('doctor.dashboard')
                ->with(
                    'success',
                    'Login successful'
                );
        }

        // Lawyer
        if (Auth::guard('lawyer')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()
                ->route('lawyer.dashboard')
                ->with(
                    'success',
                    'Login successful'
                );
        }

        return back()->with(
            'error',
            'Invalid credentials'
        );
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        Auth::guard('doctor')->logout();
        Auth::guard('lawyer')->logout();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('dashboard.login');
    }
}
