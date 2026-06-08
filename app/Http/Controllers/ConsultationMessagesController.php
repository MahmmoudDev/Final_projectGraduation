<?php

namespace App\Http\Controllers;

use App\Models\consultation_messages;
use App\Models\consultations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationMessagesController extends Controller
{
    //

    public function storeUser(Request $request)
    {
        consultation_messages::create([

            'consultation_id' => $request->consultation_id,

            'sender_id' => auth()->id(),

            'sender_type' => 'user',

            'message' => $request->message,

        ]);

        return response()->json([
            'success' => true,
            'message' => $request->message,
            'sender_type' => 'user'
        ]);
    }


    public function storeProvider(Request $request)
    {
        if (Auth::guard('doctor')->check()) {

            $senderType = 'doctor';
            $senderId = Auth::guard('doctor')->id();
        } else {

            $senderType = 'lawyer';
            $senderId = Auth::guard('lawyer')->id();
        }

        consultation_messages::create([

            'consultation_id' => $request->consultation_id,

            'sender_id' => $senderId,

            'sender_type' => $senderType,

            'message' => $request->message,

        ]);

        $consultation = consultations::findOrFail(
            $request->consultation_id
        );

        $consultation->status = 'answered';

        $consultation->save();

        return response()->json([
            'success' => true,
            'message' => $request->message,
            'sender_type' => $senderType
        ]);
    }

    public function getMessages($id)
    {

        // dd($id);

        return consultation_messages::where(
            'consultation_id',
            $id
        )->orderBy('created_at', 'asc')->get();
    }
}
