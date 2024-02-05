<?php

namespace App\Http\Controllers;

use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function getDepartments()
    {
        $departments = DepartmentModel::all();
        return response()->json($departments);
    }
    public function getDesignations()
    {
        $designations = DesignationModel::all();
        return response()->json($designations);
    }
}
