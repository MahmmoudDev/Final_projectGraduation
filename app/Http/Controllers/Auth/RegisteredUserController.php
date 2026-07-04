<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('front.pages.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {


        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'mobile' => ['required', 'string', 'unique:users,mobile'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
            [
                'name.required' => 'الاسم الكامل مطلوب.',

                'email.required' => 'البريد الإلكتروني مطلوب.',
                'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',
                'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',

                'mobile.required' => 'رقم الجوال مطلوب.',
                'mobile.unique' => 'رقم الجوال مستخدم بالفعل.',

                'password.required' => 'كلمة المرور مطلوبة.',
                'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));


        Auth::login($user);

        return redirect()
            ->route('front.index')
            ->with('success', 'تم إنشاء الحساب بنجاح ');
    }
}
