<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\consultations;
use App\Models\doctor;
use App\Models\specialization;
use App\Notifications\AppointmentApprovedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $doctors = doctor::with('specialization')->latest()->paginate(5);
        return response()->view('dashboard.doctor.index', ['doctors' => $doctors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $specializations = specialization::all();
        return response()->view('dashboard.doctor.create', ['specializations' => $specializations]);
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
            'about_doctor' => 'required',
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
        $doctor = new doctor();
        $doctor->name = $request->input('name');
        $doctor->email =  $request->input('email');
        $doctor->mobile =  $request->input('mobile');
        $doctor->password =
            Hash::make(
                $request
                    ->password
            );
        $doctor->specialization_id =  $request->input('specialization_id');
        $doctor->experience = $request->input('experience');
        $doctor->about_doctor = $request->input('about_doctor');
        $doctor->status = $request->input('status') === 'active';
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $name = time() . '.' . $imageFile->extension();
            $imageFile->storeAs('doctors',  $name, 'public');
            $doctor->image = $name;
        }

        $isSaved =
            $doctor->save();
        return response()->json([
            'icon' =>
            $isSaved ? 'success' : 'error',
            'title' => $isSaved ? 'Created!' : 'Failed!',
            'text' =>
            $isSaved  ? 'Doctor created successfully.' : 'Failed to create doctor.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(doctor $doctor)
    {
        //
        $specializations = specialization::all();
        return response()->view('dashboard.doctor.edit', ['doctor' => $doctor, 'specializations' => $specializations]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, doctor $doctor)
    {
        //
        $validate = validator($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'mobile' => 'required|string|unique:doctors,mobile,' . $doctor->id,
            'about_doctor' => 'required' . $doctor->id,
            'specialization_id' => 'required|numeric|exists:specializations,id',
            'experience' => 'required|string|min:1|max:100',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'status' => 'required|in:active,inactive'
        ]);


        $doctor->name = $request->input('name');
        $doctor->email =  $request->input('email');
        $doctor->mobile =  $request->input('mobile');
        $doctor->about_doctor = $request->input('about_doctor');
        $doctor->specialization_id =  $request->input('specialization_id');
        $doctor->experience = $request->input('experience');
        $doctor->status = $request->input('status') === 'active';
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $name = time() . '.' . $imageFile->extension();
            $imageFile->storeAs('doctors',  $name, 'public');
            $doctor->image = $name;
        }
        $isUpdated = $doctor->save();
        return response()->json([
            'icon' => $isUpdated ? 'success' : 'error',
            'title' => $isUpdated ? 'Updated!' : 'Failed!',
            'text' => $isUpdated ? 'Doctor updated successfully.' : 'Failed to update doctor.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $doctor = doctor::findOrFail($id);
        $deleted = $doctor->delete();
        return response()->json([
            'icon' => $deleted ? 'success' : 'error',
            'title' => $deleted ? 'Deleted!' : 'Failed!',
            'text' => $deleted ? 'Product deleted successfully.' : 'Failed to delete product.'
        ]);
    }

    public function doctor_login(
        Request $request
    ) {
        if (
            Auth::guard(
                'doctor'
            )->attempt([

                'email' =>
                $request->email,

                'password' =>
                $request->password,

            ])
        ) {

            return redirect()
                ->route(
                    'doctor.dashboard'
                );
        }

        return back()->with(
            'error',
            'Invalid credentials'
        );
    }

    public function dashboard()
    {
        $doctorId =
            auth()
            ->guard(
                'doctor'
            )
            ->id();

        $appointments =
            Appointment::with(
                'user'
            )
            ->where(
                'service_type',
                'doctor'
            )

            ->where(
                'service_provider_id',
                $doctorId
            )

            ->latest()
            ->paginate(5);

        return view(
            'dashboard.doctor.dashboard',
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
        $doctor = auth('doctor')->user();
        $specializations = Specialization::where('type', 'doctor')->get();
        return view('dashboard.doctor.my_profile', ['doctor' => $doctor, 'specializations' => $specializations]);
    }

    public function update_profile(Request $request)
    {
        /** @var \App\Models\doctor $doctor */
        $doctor = auth('doctor')->user();

        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'mobile' => 'required|string|unique:doctors,mobile,' . $doctor->id,
            'specialization_id' => 'required|numeric|exists:specializations,id',
            'experience' => 'required|string|min:1|max:100',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);


        $doctor->name = $request->input('name');
        $doctor->email =  $request->input('email');
        $doctor->mobile =  $request->input('mobile');
        $doctor->specialization_id =  $request->input('specialization_id');
        $doctor->experience = $request->input('experience');

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $name = time() . '.' . $imageFile->extension();
            $imageFile->storeAs('doctors',  $name, 'public');
            $doctor->image = $name;
        }
        // dd($doctor);

        // dd($request->all());
        $isUpdated = $doctor->save();
        return response()->json([
            'icon' => $isUpdated ? 'success' : 'error',
            'title' => $isUpdated ? 'Updated!' : 'Failed!',
            'text' => $isUpdated ? 'Doctor updated successfully.' : 'Failed to update doctor.',
            'name' => $doctor->name,
            'image' => $doctor->image
                ? asset('storage/doctors/' . $doctor->image)
                : null,
        ]);
    }
}
