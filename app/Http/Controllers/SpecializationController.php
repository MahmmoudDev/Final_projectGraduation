<?php

namespace App\Http\Controllers;

use App\Models\doctor;
use App\Models\lawyer;
use App\Models\specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $spe = specialization::withoutTrashed()->paginate(5);
        return response()->view('dashboard.specialization.index', ['specializations' => $spe]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('dashboard.specialization.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = validator($request->all(), [
            'name' => 'required|string|min:3|max:50|unique:specializations,name',
            'image' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => 'Validation Error',
                'text' =>
                $validate->errors()->first()
            ]);
        }

        $specialization = new specialization();
        $specialization->name = $request->input('name');
        $specialization->type = $request->input('type');
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $name = time() . '.' . $imageFile->extension();
            $imageFile->storeAs('specialization',  $name, 'public');
            $specialization->image = $name;
        }

        $isSaved =
            $specialization->save();
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
    public function show(specialization $specialization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(specialization $specialization)
    {
        //
        return response()->view('dashboard.specialization.edit', ['specialization' => $specialization]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, specialization $specialization)
    {
        $validate = validator($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);


        $specialization->name = $request->input('name');
        $specialization->type =  $request->input('type');

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $name = time() . '.' . $imageFile->extension();
            $imageFile->storeAs('specialization',  $name, 'public');
            $specialization->image = $name;
        }
        $isUpdated = $specialization->save();
        return response()->json([
            'icon' => $isUpdated ? 'success' : 'error',
            'title' => $isUpdated ? 'Updated!' : 'Failed!',
            'text' => $isUpdated ? 'specialization updated successfully.' : 'Failed to update doctor.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)

    {
        //

        $specialization = specialization::findorFail($id);
        $deleted_spe = $specialization->delete();

        return response()->json([
            'icon' => $deleted_spe ? 'success' : 'error',
            'title' => $deleted_spe ? 'Deleted!' : 'Failed!',
            'text' => $deleted_spe
                ? 'Specialization deleted successfully.'
                : 'Failed to delete specialization.'
        ]);
    }


    public function getSpecialization(Request $request)
    {
        $type = $request->query('type');
        $specializations = specialization::where('type', $type)->get();
        return response()->json($specializations);
    }

    public function getProviders(Request $request)
    {
        if ($request->type == 'doctor') {

            return doctor::with('specialization')
                ->get();
        }

        if ($request->type == 'lawyer') {

            return lawyer::with('specialization')
                ->get();
        }
    }
}
