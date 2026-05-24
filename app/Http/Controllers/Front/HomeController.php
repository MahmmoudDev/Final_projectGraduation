<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\doctor;
use App\Models\lawyer;
use App\Models\specialization;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Contact;
use App\Models\Appointment;
use App\Models\availabilitie;

class HomeController extends Controller
{
    public function index()
    {
        $specialization = specialization::limit(4)->withoutTrashed()->get();
        $doctors = doctor::limit(3)->with('specialization')->get();
        $lawyers = lawyer::limit(3)->with('specialization')->get();
        return view('front.index', [
            'specialization' => $specialization,
            'doctor' => $doctors,
            'lawyers' => $lawyers
        ]);
    }

    public function all_specializations()
    {
        $specialization = specialization::withoutTrashed()->paginate(6);

        return view('front.pages.all_specializations', ['specialization' => $specialization]);
    }

    public function doctors()
    {
        $doctors = doctor::with('specialization')->paginate(6);
        return view('front.pages.doctors', ['doctors' => $doctors]);
    }

    public function lawyers()
    {
        $lawyers = lawyer::with('specialization')->paginate(6);
        return view('front.pages.lawyers', ['lawyers' => $lawyers]);
    }

    public function doctor_profile($id)
    {
        $doctor = doctor::with('specialization', 'availabilities')->findOrFail($id);
        return view('front.pages.doctor_Profile', ['doctor' => $doctor]);
    }

    public function lawyer_profile($id)
    {
        $lawyer = lawyer::findOrFail($id);
        return view('front.pages.lawyer_profile', ['lawyer' => $lawyer]);
    }

    public function booking_doctor($id)
    {
        $doctor = doctor::find($id);
        return view('front.pages.booking_doctor', ['doctor' => $doctor]);
    }

    public function booking_lawyer($id)
    {
        $lawyer = lawyer::find($id);
        return view('front.pages.booking_lawyer', ['lawyer' => $lawyer]);
    }

    public function consultations()
    {
        return view('front.pages.consultation-room');
    }

    public function contacts()
    {
        return view('front.pages.contact');
    }
    public function store_contact(
        Request $request
    ) {
        $request->validate([

            'name' =>
            'required',

            'email' =>
            'required|email',

            'subject' =>
            'required',

            'message' =>
            'required',

        ]);

        Contact::create([

            'name' =>
            $request->name,

            'email' =>
            $request->email,

            'subject' =>
            $request->subject,

            'message' =>
            $request->message,

        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Message sent successfully!'
            );
    }

    public function
    doctor_booking(
        $id
    ) {
        $doctor =
            doctor::with(
                'availabilities',
                'specialization'
            )->findOrFail(
                $id
            );

        return view(
            'front.pages.booking_doctor',
            compact(
                'doctor'
            )
        );
    }



    public function
    store_doctor_booking(
        Request $request,
        $id
    ) {

        $request->validate([

            'availability_id'
            =>
            'required|exists:availabilities,id',
            'appointment_date'
            =>
            'required|date',

        ]);



        $availability =
            availabilitie::findOrFail(
                $request
                    ->availability_id
            );

        $selectedDay =
            strtolower(
                date(
                    'l',
                    strtotime(
                        $request
                            ->appointment_date
                    )
                )
            );

        $dayFrom =
            strtolower(
                $availability
                    ->day_from
            );

        $dayTo =
            strtolower(
                $availability
                    ->day_to
            );

        $allowedDays = [

            'sunday',
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday'

        ];

        $fromIndex =
            array_search(
                $dayFrom,
                $allowedDays
            );

        $toIndex =
            array_search(
                $dayTo,
                $allowedDays
            );

        $selectedIndex =
            array_search(
                $selectedDay,
                $allowedDays
            );

        if (

            $selectedIndex < $fromIndex ||

            $selectedIndex > $toIndex

        ) {

            return back()->with(
                'error',
                'Doctor is not available on this day.'
            );
        }

        $existsAppointment =
            Appointment::where(
                'service_provider_id',
                $id
            )

            ->where(
                'service_type',
                'doctor'
            )

            ->whereDate(
                'appointment_date',
                today()
            )

            ->where(
                'appointment_time',
                $availability->start_time
            )

            ->whereNotIn(
                'status',
                [
                    'cancelled',
                    'rejected'
                ]
            )

            ->exists();

        Appointment::create([

            'user_id' =>
            auth()->id(),

            'service_provider_id' =>
            $id,

            'service_type' =>
            'doctor',

            'appointment_date' =>
            $request->appointment_date,

            'appointment_time' =>
            $availability
                ->start_time,

            'status' =>
            'pending',

        ]);

        return redirect()
            ->route(
                'myAppiontments'
            )
            ->with(
                'success',
                'Appointment booked successfully!'
            );
    }
    public function
    lawyer_booking(
        $id
    ) {
        $lawyer =
            lawyer::with(
                'availabilities',
                'specialization'
            )->findOrFail(
                $id
            );

        return view(
            'front.pages.booking_lawyer',
            compact(
                'lawyer'
            )
        );
    }
    public function
    store_lawyer_booking(
        Request $request,
        $id
    ) {
        $request->validate([

            'availability_id'
            =>
            'required|exists:availabilities,id',

        ]);


        $availability =
            availabilitie::findOrFail(
                $request
                    ->availability_id
            );



        $existsAppointment =
            Appointment::where(
                'service_provider_id',
                $id
            )

            ->where(
                'service_type',
                'lawyer'
            )

            ->whereDate(
                'appointment_date',
                $request->appointment_date
            )

            ->where(
                'appointment_time',
                $availability->start_time
            )

            ->whereNotIn(
                'status',
                [
                    'cancelled',
                    'rejected'
                ]
            )

            ->exists();

        Appointment::create([

            'user_id' =>
            auth()->id(),

            'service_provider_id' =>
            $id,

            'service_type' =>
            'lawyer',

            'appointment_date' =>
            now()
                ->format(
                    'Y-m-d'
                ),

            'appointment_time' =>
            $availability
                ->start_time,

            'status' =>
            'pending',



        ]);


        return redirect()
            ->route(
                'myAppiontments'
            )
            ->with(
                'success',
                'Appointment booked successfully!'
            );
    }
}
