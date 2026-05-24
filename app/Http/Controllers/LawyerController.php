<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\lawyer;
use App\Models\specialization;
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
        $lawyers = lawyer::with('specialization')->get();
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
        //

        $validate = validator($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:lawyers,email',
            'password' =>
            'required|string|min:8',
            'mobile' => 'required|string|unique:lawyers,mobile',
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
                $validate->errors()->first()
            ]);
        }
        $lawyer = new lawyer();
        $lawyer->name = $request->input('name');
        $lawyer->email =  $request->input('email');
        $lawyer->password =
            Hash::make(
                $request->password
            );
        $lawyer->mobile =  $request->input('mobile');
        $lawyer->specialization_id =  $request->input('specialization_id');
        $lawyer->experience = $request->input('experience');
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
            'mobile' => 'required|string|unique:lawyers,mobile,' . $lawyer->id,
            'specialization_id' => 'required|numeric|exists:specializations,id',
            'experience' => 'required|string|min:1|max:100',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'status' => 'required|in:active,inactive'
        ]);


        $lawyer->name = $request->input('name');
        $lawyer->email =  $request->input('email');
        $lawyer->mobile =  $request->input('mobile');
        if (
            $request->filled(
                'password'
            )
        ) {

            $lawyer->password =
                Hash::make(
                    $request->password
                );
        }
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

        return view(
            'dashboard.lawyer.dashboard',
            compact(
                'appointments'
            )
        );
    }
}
