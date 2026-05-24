<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\doctor;
use App\Models\lawyer;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $appointments =
            Appointment::with(
                'user'
            )->get();

        foreach (
            $appointments
            as
            $appointment
        ) {

            if (
                $appointment
                ->service_type
                ==
                'doctor'
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

        return view(
            'dashboard.appointment.index',
            [
                'appointment'
                =>
                $appointments
            ]
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
    public function show(string $id)
    {
        //
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

    // public function changeStatus(Request $request, Appointment $appointment)
    // {
    //     $appointment->status = $request->status;
    //     $isSaved =
    //         $appointment->save();
    //     return response()->json([
    //         'icon' =>
    //         $isSaved
    //             ? 'success'
    //             : 'error',

    //         'text' =>
    //         $isSaved
    //             ? 'Status updated successfully.'
    //             : 'Update failed.'
    //     ]);
    // }

    public function calendar()
    {
        $appointments =
            Appointment::all();

        $events =
            $appointments->map(
                function ($item) {

                    return [

                        'title' =>
                        $item->user->name
                            . ' - '
                            . ucfirst(
                                $item->service_type
                            ),

                        'start' =>
                        $item->appointment_date
                            . 'T'
                            . $item->appointment_time,
                    ];
                }
            );

        return view(
            'dashboard.appointment.calendar',
            compact('events')
        );
    }
}
