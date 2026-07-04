<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\doctor;
use App\Models\lawyer;
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

        $hasAccess =
            Admin::where('email', $request->email)->exists() ||
            doctor::where('email', $request->email)->exists() ||
            lawyer::where('email', $request->email)->exists();

        if (Auth::guard('admin')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Welcome Admin');
        }

        if (Auth::guard('doctor')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()
                ->route('doctor.dashboard')
                ->with('success', 'Login successful');
        }


        if (Auth::guard('lawyer')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()
                ->route('lawyer.dashboard')
                ->with('success', 'Login successful');
        }

        if ($hasAccess) {

            return back()->with(
                'error',
                'البريد الإلكتروني أو كلمة المرور غير صحيحة.'
            );
        }

        return back()->with(
            'error',
            'لا يوجد صلاحية لهذا الحساب.'
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
