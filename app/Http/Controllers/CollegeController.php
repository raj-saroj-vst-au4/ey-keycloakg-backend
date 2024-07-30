<?php

namespace App\Http\Controllers;

use App\Models\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    public function getCountries()
    {
        // Specify the database connection for the College model
        $countries = College::on('college_database')
            ->get()
            ->pluck('country')
            ->unique();
        return response()->json(['countries' => $countries]);
    }
    public function getStatesByCountry($country)
    {
        // Specify the database connection for the College model
        $states = College::on('college_database')
            ->where('country', $country)
            ->distinct()
            ->pluck('state');

        return response()->json(['states' => $states]);
    }
    public function getCollegesByState($country, $state)
    {
        // Specify the database connection for the College model
        $colleges = College::on('college_database')
            ->where('country', $country)
            ->where('state', $state)
            ->get();

        return response()->json(['colleges' => $colleges]);
    }

    public function getElsiColleges(){
        $colleges = College::on('college_database')
        ->orderby("college_name")->get();
        return response()->json(['colleges' => $colleges]);
    }

    public function getCollegeData($clgcode){
        $collegeData = College::on('college_database')->where('clg_code', $clgcode)->get();
        return response()->json(['data' => $collegeData]);
    }

    //function to update college data on database
    public function putCollegeData(Request $request, $id, $field){
        $college = College::on('college_database')->find($id);
        $updateableFields = ['IS_eLSI', 'inauguration_date', 'IS_eFSI', 'eYIC_allowed', 'college_name', 'country', 'state', 'district', 'city', 'pincode', 'address','website', 'Remarks', 'labrank', 'grade', 'reg_data', 'pay_proof', 'intent_letter'];
        if(in_array($field, $updateableFields)){
            $college->$field = $request->input($field);
            $college->save();
            return response()->json(['college' => $college], 200);
        }
        else{
            return response()->json(['message' => 'Updation Error'], 400);
        }
    }
}
