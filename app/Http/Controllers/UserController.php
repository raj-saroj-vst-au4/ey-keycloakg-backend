<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getElsiUsers(Request $request)
    {
        $users = User::with('profile')->get();
        return response()->json(['users' => $users]);
    }

    public function getUserData(Request $request, $userid){
        $userdata = User::with('profile')->where('kcuid', $userid)->first();
        $collegeid = $userdata->profile->college_id;
        $collegedata = College::on('college_database')->where('id', $collegeid)->first();
    // Check if user data is found
    if (!$userdata) {
        return response()->json(['error' => 'User not found'], 404);
    }
    // Return the user data as JSON
    return response()->json(['data' => ['user' => $userdata, 'college'=> $collegedata]]);
    }


    public function changeUserRole(Request $request){
        $userdata = User::with('profile')->where('kcuid', $request->input('kcuid'))->first();
        // Check if user data is found
        if (!$userdata) {
            return response()->json(['error' => 'User not found'], 404);
        }
        // Change column curr_user from table profile
        $userdata->profile->curr_user = $request->input('new_role');
        $userdata->profile->save();
        // Return the user data as JSON
        return response()->json(['data' => ['user' => $userdata]]);
    }
}
