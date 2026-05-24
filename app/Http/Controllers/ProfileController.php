<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit_profile($id)
    {
        $user = Auth()->guard('web')->user();
        return view('front.pages.profile', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update_profile(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([

            'name' => 'required',

            'email' =>
            'required|email|unique:users,email,' . $id,

            'mobile' =>
            'required|unique:users,mobile,' . $id

        ]);
        if ($user->name != $request->name) {
            $user->name = $request->name;
        }

        if ($user->email != $request->email) {
            $user->email = $request->email;
        }

        if ($user->mobile != $request->mobile) {
            $user->mobile = $request->mobile;
        }

        $user->save();


        return Redirect::back()->with(
            'success',
            'Profile updated successfully!'
        );
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function my_appointments()
    {

        $appointments = DB::table('appointments')
            ->where(
                'user_id',
                auth()->id()
            )
            ->get();

        foreach (
            $appointments
            as $appointment
        ) {

            if (
                $appointment
                ->service_type
                == 'doctor'
            ) {

                $doctor =
                    DB::table('doctors')
                    ->find(
                        $appointment
                            ->service_provider_id
                    );

                $appointment
                    ->provider_name =
                    $doctor?->name;
            } elseif (
                $appointment
                ->service_type
                == 'lawyer'
            ) {

                $lawyer =
                    DB::table('lawyers')
                    ->find(
                        $appointment
                            ->service_provider_id
                    );

                $appointment
                    ->provider_name =
                    $lawyer?->name;
            }
        }

        return view(
            'front.pages.my_appiontments',
            compact(
                'appointments'
            )
        );
    }

    public function cancel_appointment($id)
    {
        $appointment = Appointment::where('user_id', auth()->id())->findOrFail($id);
        $appointment
            ->update([
                'status' =>
                'cancelled'
            ]);
        return response()
            ->json([
                'icon' =>
                'success',
                'title' =>
                'Cancelled!',
                'text' =>
                'Appointment cancelled successfully.'
            ]);
    }
}
