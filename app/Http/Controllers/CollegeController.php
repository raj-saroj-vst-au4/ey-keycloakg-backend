<?php

namespace App\Http\Controllers;

use App\Models\CollegeModel;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    public function getCountries()
    {
        // Specify the database connection for the College model
        $countries = CollegeModel::on('college_database')
            ->get()
            ->pluck('country')
            ->unique();
        return response()->json(['countries' => $countries]);
    }
    public function getStatesByCountry($country)
    {
        // Specify the database connection for the College model
        $states = CollegeModel::on('college_database')
            ->where('country', $country)
            ->distinct()
            ->pluck('state');

        return response()->json(['states' => $states]);
    }
    public function getCollegesByState($country, $state)
    {
        // Specify the database connection for the College model
        $colleges = CollegeModel::on('college_database')
            ->where('country', $country)
            ->where('state', $state)
            ->get();

        return response()->json(['colleges' => $colleges]);
    }
}
