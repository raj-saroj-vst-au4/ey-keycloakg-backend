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
        ->where('IS_eLSI', 1)
        ->orderby("college_name")->paginate(10);

        return response()->json(['colleges' => $colleges]);
    }
}
