<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $contact = Contact::all();
        return response()->view('dashboard.contact.index', ['contact' => $contact]);
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
    public function destroy($id)
    {
        //
        $contact = Contact::findorFail($id);
        $deleted_contact = $contact->delete();

        return response()->json([
            'icon' => $deleted_contact ? 'success' : 'error',
            'title' => $deleted_contact ? 'Deleted!' : 'Failed!',
            'text' => $deleted_contact
                ? 'Cotact deleted successfully.'
                : 'Failed to delete Contact.'
        ]);
    }

    public function markAsRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact
            ->update([
                'status' =>
                'read'

            ]);

        return response()
            ->json([
                'icon' =>
                'success',

                'text' =>
                'Marked as read'

            ]);
    }
}
