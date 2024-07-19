<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LabController extends Controller
{
    public function addLabInaugSlot(Request $request)
    {
        try{
        // Define validation rules
        $validated = $request->validate([
            'slotname' => 'required|string|max:255',
            'schedule_date' => 'required|date',
            'collegeids' => 'required|array'
        ]);

        // Check if validation fails
        if ($validated == true) {
            // Validation passed, store in the database
            $inaugSlot = new Lab();
            $inaugSlot->slotname = $request->input('slotname');
            $inaugSlot->schedule_date = $request->input('schedule_date');
            $inaugSlot->collegeids = json_encode($request->input('collegeids'));
            $inaugSlot->createdat = now();
            $inaugSlot->save();

            // Redirect with success message
            return response()->json([
                'status' => 200,
                'message' => 'Form submitted successfully',
                'data' => $validated,
                'validated' => true,
            ]);
        }


    }catch (ValidationException $e){
        return response()->json([
            'status' => 406,
            'message' => auth()->check(),
            'validated' => false,
            'errors' => $e->errors(),
        ]);
    }
    }
}
