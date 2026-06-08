<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\doctor;
use App\Models\lawyer;
use App\Models\specialization;
use App\Models\User;
use Illuminate\Http\Request;


class dashboard extends Controller
{
    //
    public function home()
    {
        $adminsCount = Admin::count();
        $doctorCount = doctor::count();
        $lawyerCount = lawyer::count();
        $appointmetCount = Appointment::count();
        $specializationCount = specialization::count();

        $appointments = Appointment::with('user')->latest()->paginate(5);
        foreach ($appointments as $appointment) {
            if (
                $appointment->service_type == 'doctor'
            ) {
                $appointment
                    ->provider_name =
                    doctor::find(
                        $appointment
                            ->service_provider_id
                    )?->name;
            } else {
                $appointment
                    ->provider_name =
                    lawyer::find(
                        $appointment
                            ->service_provider_id
                    )?->name;
            }
        }

        $contact = Contact::all();

        return response()->view('home', [
            'count' => $adminsCount,
            'doctor_count' => $doctorCount,
            'lawyerCount' => $lawyerCount,
            'specializationCount' => $specializationCount,
            'appointmetCount' => $appointmetCount,
            'appointment' => $appointments, // 👈 يمرر الآن ككائن Pagination مجهز
            'contact' => $contact
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $search = strtolower(trim($request->search));

        $results = collect();

        if ($search == 'doctor') {

            $results = doctor::all()->map(function ($item) {

                $item->type = 'Doctor';

                return $item;
            });

            return view(
                'dashboard.search.search',
                compact('results')
            );
        }

        if ($search == 'lawyer') {

            $results = lawyer::all()->map(function ($item) {

                $item->type = 'Lawyer';

                return $item;
            });

            return view(
                'dashboard.search.search',
                compact('results')
            );
        }

        if ($search == 'user') {

            $results = User::all()->map(function ($item) {

                $item->type = 'User';

                return $item;
            });

            return view(
                'dashboard.search.search',
                compact('results')
            );
        }
    }
}
