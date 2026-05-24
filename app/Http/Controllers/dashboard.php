<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\doctor;
use App\Models\lawyer;
use App\Models\specialization;
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
        $appointments =
            Appointment::with('user')->get();
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
            'appointment' => $appointments,
            'contact' => $contact
        ]);
    }
}
