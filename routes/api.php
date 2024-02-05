<?php

use App\Http\Controllers\CollegeController;
use App\Http\Controllers\SignupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/token', function(Request $request){
    return response()->json(['message' => "Token"], 200);
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/protected', function(Request $request){
        return response()->json(['message' => "Backend fetched successfully"], 200);
    });
    // Signup form api routes
    Route::get('/getcountries', [CollegeController::class, 'getCountries']);
    Route::get('/getdepartments', [SignupController::class, 'getDepartments']);
    Route::get('/getdesignations', [SignupController::class, 'getDesignations']);
    Route::get('/getstates/{country}', [CollegeController::class, 'getStatesByCountry']);
    Route::get('/getcolleges/{country}/{state}', [CollegeController::class, 'getCollegesByState']);
});
