<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view(
            'dashboard.auth.login'
        );
    }

    public function dashboard_login(
        Request $request
    ) {

        $credentials = [

            'email' =>
            $request->email,

            'password' =>
            $request->password,

        ];

        // Admin
        if (
            Auth::guard(
                'admin'
            )->attempt(
                $credentials
            )
        ) {

            return redirect()
                ->route(
                    'admin.dashboard'
                );
        }

        // Doctor
        $doctor =
            \App\Models\doctor::where(
                'email',
                $request->email
            )->first();

        if (
            $doctor &&
            $doctor->password &&
            Auth::guard(
                'doctor'
            )->attempt(
                $credentials
            )
        ) {

            return redirect()
                ->route(
                    'doctor.dashboard'
                );
        }

        // Lawyer
        $lawyer =
            \App\Models\lawyer::where(
                'email',
                $request->email
            )->first();

        if (
            $lawyer &&
            $lawyer->password &&
            Auth::guard(
                'lawyer'
            )->attempt(
                $credentials
            )
        ) {

            return redirect()
                ->route(
                    'lawyer.dashboard'
                );
        }

        return back()->with(
            'error',
            'Invalid credentials'
        );
    }

    public function logout()
    {
        Auth::guard(
            'doctor'
        )->logout();

        Auth::guard(
            'lawyer'
        )->logout();

        Auth::guard(
            'admin'
        )->logout();

        Auth::logout();

        request()
            ->session()
            ->invalidate();

        request()
            ->session()
            ->regenerateToken();

        return redirect()
            ->route(
                'dashboard.login'
            );
    }
}
