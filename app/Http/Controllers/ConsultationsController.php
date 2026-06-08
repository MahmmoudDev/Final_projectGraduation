<?php

namespace App\Http\Controllers;

use App\Models\consultations;
use Illuminate\Http\Request;

class ConsultationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth('doctor')->check()) {

            $consultations = consultations::with([
                'user',
                'doctor',
                'lawyer'
            ])
                ->where(
                    'service_provider_id',
                    auth('doctor')->id()
                )
                ->where(
                    'service_type',
                    'doctor'
                )
                ->latest()
                ->get();
        } elseif (auth('lawyer')->check()) {

            $consultations = consultations::with([
                'user',
                'doctor',
                'lawyer'
            ])
                ->where(
                    'service_provider_id',
                    auth('lawyer')->id()
                )
                ->where(
                    'service_type',
                    'lawyer'
                )
                ->latest()
                ->get();
        } else {

            abort(403);
        }

        return view(
            'dashboard.Consultation.index',
            compact('consultations')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $consultation = consultations::with([
            'user',
            'doctor',
            'lawyer',
            'messages'
        ])->findOrFail($id);

        return view(
            'dashboard.consultation.show',
            compact('consultation')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
