<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SignupController extends Controller
{
    public function getDepartments()
    {
        $departments = Department::all();
        return response()->json($departments);
    }
    public function getDesignations()
    {
        $designations = Designation::all();
        return response()->json($designations);
    }
    public function getRole()
    {
        $user = Auth::user()->profile;
        return response()->json($user);
    }

    public function storeRegistration(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'required|string|min:3|max:255',
                'country' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'college' => 'required|numeric',
                'department' => 'required|numeric',
                'designation' => 'required|numeric',
                'address' => 'required|string|min:10|max:255',
                'pin' => 'required|numeric|digits_between:4,10',
            ]);

            if($validated == true){
                //code to save data in database goes here.
                $user = new User();
                $profile = new Profile();

                $user->name = $request->name;
                $user->email = $request->email;
                $user->kcuid = $request->kcuid;
                $user->username = $request->username;
                $user->signupcomplete = true;

                $user->save();

                $profile->email= $request->email;
                $profile->college_id = $request->college;
                $profile->department_id = $request->department;
                $profile->designation_id = $request->designation;
                $profile->address = $request->address;
                $profile->pincode = $request->pin;
                $profile->user_id= $user->id;

                $profile->save();

            return response()->json([
                'status' => 200,
                'message' => 'Form submitted successfully',
                'data' => $validated,
                'validated' => true,
            ]);
            }
        } catch (ValidationException $e) {
            // Validation failed
            return response()->json([
                'status' => 406,
                'message' => auth()->check(),
                'validated' => false,
                'errors' => $e->errors(),
            ]);
        }
    }
}
