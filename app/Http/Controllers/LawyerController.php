<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\consultations;
use App\Models\lawyer;
use App\Models\specialization;
use App\Notifications\AppointmentApprovedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LawyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $lawyers = lawyer::with('specialization')->get();
        $lawyers = lawyer::with('specialization')->latest()->paginate(5);

        return response()->view('dashboard.lawyer.index', ['lawyers' => $lawyers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $specializations = specialization::all();
        return response()->view('dashboard.lawyer.create', ['specializations' => $specializations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = validator($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:doctors,email',
            'password' =>
            'required|min:6',
            'mobile' => 'required|string|unique:doctors,mobile',
            'about_lawyers' => 'required',
            'specialization_id' => 'required|numeric|exists:specializations,id',
            'experience' => 'required|string|min:1|max:100',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'status' => 'required|in:active,inactive'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => 'Validation Error',
                'text' =>
                $validate->errors()->first(),
                'password' =>
                bcrypt(
                    $request
                        ->password
                ),
            ]);
        }
        $lawyer = new lawyer();
        $lawyer->name = $request->input('name');
        $lawyer->email =  $request->input('email');
        $lawyer->mobile =  $request->input('mobile');
        $lawyer->password =
            Hash::make(
                $request
                    ->password
            );
        $lawyer->specialization_id =  $request->input('specialization_id');
        $lawyer->experience = $request->input('experience');
        $lawyer->about_lawyers = $request->input('about_lawyers');
        $lawyer->status = $request->input('status') === 'active';
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $name = time() . '.' . $imageFile->extension();
            $imageFile->storeAs('lawyers',  $name, 'public');
            $lawyer->image = $name;
        }

        $isSaved =
            $lawyer->save();
        return response()->json([
            'icon' =>
            $isSaved ? 'success' : 'error',
            'title' => $isSaved ? 'Created!' : 'Failed!',
            'text' =>
            $isSaved  ? 'Lawyer created successfully.' : 'Failed to create lawyer.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(lawyer $lawyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lawyer $lawyer)
    {
        //
        $specializations = specialization::all();
        return response()->view('dashboard.lawyer.edit', ['specializations' => $specializations, 'lawyer' => $lawyer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lawyer $lawyer)
    {
        //

        $validate = validator($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:lawyers,email,' . $lawyer->id,
            'password' =>
            'nullable|string|min:8',
            'about_lawyers' => 'required' . $lawyer->id,
            'mobile' => 'required|string|unique:lawyers,mobile,' . $lawyer->id,
            'specialization_id' => 'required|numeric|exists:specializations,id',
            'experience' => 'required|string|min:1|max:100',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'status' => 'required|in:active,inactive'
        ]);


        $lawyer->name = $request->input('name');
        $lawyer->email =  $request->input('email');
        $lawyer->mobile =  $request->input('mobile');
        $lawyer->about_lawyers =  $request->input('about_lawyers');

        $lawyer->specialization_id =  $request->input('specialization_id');
        $lawyer->experience = $request->input('experience');
        $lawyer->status = $request->input('status') === 'active';
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $name = time() . '.' . $imageFile->extension();
            $imageFile->storeAs('lawyers',  $name, 'public');
            $lawyer->image = $name;
        }
        $isUpdated = $lawyer->save();
        return response()->json([
            'icon' => $isUpdated ? 'success' : 'error',
            'title' => $isUpdated ? 'Updated!' : 'Failed!',
            'text' => $isUpdated ? 'Lawyer updated successfully.' : 'Failed to update lawyer.'
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $lawyer = lawyer::findOrFail($id);
        $deleted = $lawyer->delete();
        return response()->json([
            'icon' => $deleted ? 'success' : 'error',
            'title' => $deleted ? 'Deleted!' : 'Failed!',
            'text' => $deleted ? 'Lawyer deleted successfully.' : 'Failed to delete lawyer.'
        ]);
    }


    public function lawyer_login(
        Request $request
    ) {
        if (
            Auth::guard(
                'lawyer'
            )->attempt([

                'email' =>
                $request->email,

                'password' =>
                $request->password,

            ])
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

    public function dashboard()
    {
        $lawyerId =
            auth()
            ->guard(
                'lawyer'
            )
            ->id();

        $appointments =
            Appointment::with(
                'user'
            )
            ->where(
                'service_type',
                'lawyer'
            )

            ->where(
                'service_provider_id',
                $lawyerId
            )

            ->latest()
            ->get();

        $totalAppointments = Appointment::where('service_provider_id', $lawyerId)
            ->where('service_type', 'lawyer')
            ->count();

        $pendingAppointments = Appointment::where('service_provider_id', $lawyerId)
            ->where('service_type', 'lawyer')
            ->where('status', 'pending')
            ->count();

        $approvedAppointments = Appointment::where('service_provider_id', $lawyerId)
            ->where('service_type', 'lawyer')
            ->where('status', 'approved')
            ->count();

        $cancelledAppointments = Appointment::where('service_provider_id', $lawyerId)
            ->where('service_type', 'lawyer')
            ->where('status', 'cancelled')
            ->count();

        $rejectedAppointments = Appointment::where('service_provider_id', $lawyerId)
            ->where('service_type', 'lawyer')
            ->where('status', 'rejected')
            ->count();

        return view(
            'dashboard.lawyer.dashboard',
            compact(
                'appointments',
                'totalAppointments',
                'pendingAppointments',
                'approvedAppointments',
                'cancelledAppointments',
                'rejectedAppointments'
            )
        );

        return view(
            'dashboard.lawyer.dashboard',
            compact(
                'appointments'
            )
        );
    }

    public function approve_appointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'approved';
        $appointment->save();

        $appointment->user->notify(
            new AppointmentApprovedNotification($appointment)
        );

        $notification = auth()->user()->unreadNotifications
            ->where('data.appointment_id', $id)
            ->first();

        consultations::firstOrCreate([
            'appointment_id' => $appointment->id
        ], [
            'user_id' => $appointment->user_id,

            'service_provider_id' => $appointment->service_provider_id,

            'service_type' => $appointment->service_type,

            'title' => 'Consultation #' . $appointment->id,

            'question' => 'Consultation Started',
        ]);


        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back()->with('success', 'Appointment approved successfully!');
    }

    public function reject_appointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'rejected';
        $appointment->save();

        $appointment->user->notify(
            new AppointmentApprovedNotification($appointment)
        );

        $notification = auth()->user()->unreadNotifications
            ->where('data.appointment_id', $id)
            ->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back()->with('success', 'Appointment rejected successfully!');
    }

    public function edit_myprofile()
    {
        $lawyer = auth('lawyer')->user();
        $specializations = Specialization::where('type', 'lawyer')->get();
        return view('dashboard.lawyer.my_profile', ['lawyer' => $lawyer, 'specializations' => $specializations]);
    }

    public function update_profile(Request $request)
    {

        /** @var \App\Models\lawyer $lawyer */
        $lawyer = auth('lawyer')->user();

        $validate = validator($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:lawyers,email,' . $lawyer->id,
            'mobile' => 'required|string|unique:lawyers,mobile,' . $lawyer->id,
            'specialization_id' => 'required|numeric|exists:specializations,id',
            'experience' => 'required|string|min:1|max:100',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);


        $lawyer->name = $request->input('name');
        $lawyer->email =  $request->input('email');
        $lawyer->mobile =  $request->input('mobile');
        $lawyer->specialization_id =  $request->input('specialization_id');
        $lawyer->experience = $request->input('experience');

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $name = time() . '.' . $imageFile->extension();
            $imageFile->storeAs('lawyers',  $name, 'public');
            $lawyer->image = $name;
        }
        // dd($lawyer);
        $isUpdated = $lawyer->save();
        return response()->json([
            'icon' => $isUpdated ? 'success' : 'error',
            'title' => $isUpdated ? 'Updated!' : 'Failed!',
            'text' => $isUpdated ? 'lawyer updated successfully.' : 'Failed to update lawyer.',
            'name' => $lawyer->name,
            'image' => $lawyer->image
                ? asset('storage/lawyers/' . $lawyer->image)
                : null,
        ]);
    }
}
