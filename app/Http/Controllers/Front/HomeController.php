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
use App\Models\consultations;
use App\Notifications\NewBookingNotification;

class HomeController extends Controller
{
    public function index()
    {
        $specialization = specialization::limit(4)
            ->withoutTrashed()
            ->get();

        $doctors = doctor::limit(3)
            ->with('specialization')
            ->get();

        $lawyers = lawyer::limit(3)
            ->with('specialization')
            ->get();

        $recommendedDoctors = doctor::with('specialization')
            ->where('experience', '>=', 10)
            ->orderByDesc('experience')
            ->take(3)
            ->get();

        $recommendedLawyers = lawyer::with('specialization')
            ->where('experience', '>=', 10)
            ->orderByDesc('experience')
            ->take(3)
            ->get();

        return view('front.index', [

            'specialization' => $specialization,

            'doctor' => $doctors,

            'lawyers' => $lawyers,

            'recommendedDoctors' => $recommendedDoctors,

            'recommendedLawyers' => $recommendedLawyers,

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

    public function store_contact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function doctor_booking($id)
    {
        $doctor = doctor::with('availabilities')->findOrFail($id);

        $availability = $doctor->availabilities->first();

        $times = [];

        if ($availability) {

            $start = \Carbon\Carbon::parse(
                $availability->start_time
            );

            $end = \Carbon\Carbon::parse(
                $availability->end_time
            );

            while ($start <= $end) {

                $times[] = [

                    'value' => $start->format('H:i:s'),

                    'label' => $start->format('h:i A')

                ];

                $start->addHour();
            }
        }

        return view(
            'front.pages.booking_doctor',
            compact(
                'doctor',
                'times'
            )
        );
    }

    public function lawyer_booking($id)
    {
        $lawyer = lawyer::with('availabilities')->findOrFail($id);

        $availability = $lawyer->availabilities->first();

        $times = [];

        if ($availability) {

            $start = \Carbon\Carbon::parse(
                $availability->start_time
            );

            $end = \Carbon\Carbon::parse(
                $availability->end_time
            );

            while ($start <= $end) {

                $times[] = [

                    'value' => $start->format('H:i:s'),

                    'label' => $start->format('h:i A')

                ];

                $start->addHour();
            }
        }

        return view(
            'front.pages.booking_lawyer',
            compact(
                'lawyer',
                'times'
            )
        );
    }

    public function store_doctor_booking(Request $request, $id)
    {
        $request->validate([
            'appointment_day'  => 'required',
            'appointment_time' => 'required',
        ]);

        $doctor = doctor::findOrFail($id);

        $appointmentDate = now()
            ->next($request->appointment_day)
            ->format('Y-m-d');

        $exists = Appointment::where(
            'service_provider_id',
            $id
        )
            ->where(
                'service_type',
                'doctor'
            )
            ->where(
                'appointment_date',
                $appointmentDate
            )
            ->where(
                'appointment_time',
                $request->appointment_time
            )
            ->whereIn(
                'status',
                [
                    'pending',
                    'approved'
                ]
            )
            ->exists();

        if ($exists) {

            return back()->with(
                'error',
                'This appointment is already booked.'
            );
        }

        $appointment = Appointment::create([

            'user_id' => auth()->id(),

            'service_provider_id' => $id,

            'service_type' => 'doctor',

            'appointment_date' => $appointmentDate,

            'appointment_time' => $request->appointment_time,

            'status' => 'pending',

        ]);

        if ($doctor) {

            $doctor->notify(
                new NewBookingNotification(
                    $appointment
                )
            );
        }

        return redirect()
            ->route(
                'myAppiontments'
            )
            ->with(
                'success',
                'Appointment booked successfully!'
            );
    }

    public function store_lawyer_booking(Request $request, $id)
    {
        $request->validate([
            'appointment_day'  => 'required',
            'appointment_time' => 'required',
        ]);

        $lawyer = lawyer::findOrFail($id);

        $appointmentDate = now()
            ->next($request->appointment_day)
            ->format('Y-m-d');

        $exists = Appointment::where(
            'service_provider_id',
            $id
        )
            ->where(
                'service_type',
                'doctor'
            )
            ->where(
                'appointment_date',
                $appointmentDate
            )
            ->where(
                'appointment_time',
                $request->appointment_time
            )
            ->whereIn(
                'status',
                [
                    'pending',
                    'approved'
                ]
            )
            ->exists();

        if ($exists) {

            return back()->with(
                'error',
                'This appointment is already booked.'
            );
        }

        $appointment = Appointment::create([

            'user_id' => auth()->id(),

            'service_provider_id' => $id,

            'service_type' => 'lawyer',

            'appointment_date' => $appointmentDate,

            'appointment_time' => $request->appointment_time,

            'status' => 'pending',

        ]);

        if ($lawyer) {

            $lawyer->notify(
                new NewBookingNotification(
                    $appointment
                )
            );
        }

        return redirect()
            ->route(
                'myAppiontments'
            )
            ->with(
                'success',
                'Appointment booked successfully!'
            );
    }


    public function search(Request $request)
    {
        $search = $request->search;
        $type = $request->type;

        if ($type == 'doctor') {
            $results = doctor::with('specialization')->where('name', 'like', "%{$search}%")
                ->orWhereHas('specialization', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                })->get();
        } else {
            $results = lawyer::with('specialization')->where('name', 'like', "%{$search}%")
                ->orWhereHas('specialization', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                })->get();
        }

        return view('front.pages.search_results', compact('results', 'type'));
    }

    public function consultationRoom($appointmentId)
    {
        $consultation = consultations::with([
            'user',
            'doctor',
            'lawyer',
            'messages'
        ])
            ->where(
                'appointment_id',
                $appointmentId
            )
            ->firstOrFail();

        return view(
            'front.pages.consultation-room',
            compact('consultation')
        );
    }
}
