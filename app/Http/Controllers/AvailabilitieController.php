<?php

namespace App\Http\Controllers;

use App\Models\availabilitie;
use App\Models\doctor;
use App\Models\lawyer;
use Illuminate\Http\Request;

class AvailabilitieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $availabilitie = availabilitie::latest()->paginate(5);
        return response()->view('dashboard.availabilitie.index', ['availabilitie' => $availabilitie]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $doctors = doctor::all();
        $lawyers = lawyer::all();
        return response()->view('dashboard.availabilitie.create', ['doctors' => $doctors, 'lawyers' => $lawyers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = validator([
            $request->all(),
            'service_provider_id' => 'required|integer',
            'day_from' => 'required|string',
            'day_to' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',

            'is_available' => 'required|boolean',
            'Status' => 'required|in:active,inactive'
        ]);

        if ($validate->fails()) {
            return response()->json(
                ['icon' => 'error', 'text' => $validate->errors()->first()],
            );
        }

        $availabilitie = new availabilitie();
        $availabilitie->service_provider_id = $request->input('service_provider_id');
        $availabilitie->service_type = $request->input('service_type');
        $availabilitie->day_from = $request->input('day_from');
        $availabilitie->day_to = $request->input('day_to');
        $availabilitie->start_time =
            date(
                'H:i:s',
                strtotime(
                    $request->start_time
                )
            );

        $availabilitie->end_time =
            date(
                'H:i:s',
                strtotime(
                    $request->end_time
                )
            );
        $availabilitie->is_available = $request->input('is_available');
        // $availabilitie->Status = $request->input('Status');

        // dd($request->all());
        $isSaved = $availabilitie->save();

        return response()->json(
            [
                'icon' =>
                $isSaved
                    ? 'success'
                    : 'error',

                'title' =>
                $isSaved
                    ? 'Created'
                    : 'Failed',

                'text' =>
                $isSaved
                    ? 'Availability Created Successfully'
                    : 'Create Failed',
            ]
        );
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

        $doctors = doctor::all();
        $lawyers = lawyer::all();
        $availabilitie = availabilitie::find($id);
        return response()->view('dashboard.availabilitie.edit', ['availabilitie' => $availabilitie, 'doctors' => $doctors, 'lawyers' => $lawyers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, availabilitie $availability)
    {

        $validate = validator([
            $request->all(),
            'service_provider_id' => 'required|integer',
            'service_type' => 'required',
            'day_from' => 'required|string',
            'day_to' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'is_available' => 'required|boolean',
        ]);

        if ($validate->fails()) {
            return response()->json(
                ['icon' => 'error', 'text' => $validate->errors()->first()],
            );
        }

        $availability->service_provider_id = $request->service_provider_id;
        $availability->service_type = $request->service_type;
        $availability->day_from = $request->day_from;
        $availability->day_to = $request->day_to;
        $availability->start_time = date('H:i:s', strtotime($request->start_time));
        $availability->end_time = date('H:i:s', strtotime($request->end_time));
        $availability->is_available = $request->is_available;

        $isUpdated =
            $availability->save();

        return response()->json([
            'icon' =>
            $isUpdated
                ? 'success'
                : 'error',

            'title' =>
            $isUpdated
                ? 'Updated'
                : 'Failed',

            'text' =>
            $isUpdated
                ? 'Availability updated successfully'
                : 'Update failed',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $availabilitie = availabilitie::find($id);
        $deleted = $availabilitie->delete();
        return response()->json([
            'icon' => $deleted ? 'success' : 'error',
            'title' => $deleted ? 'Deleted!' : 'Failed!',
            'text' => $deleted ? 'Availability deleted successfully.' : 'Failed to delete availability.'
        ]);
    }
}
