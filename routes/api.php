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

    // Signup form api routes
    Route::get('/getcountries', [CollegeController::class, 'getCountries']);
    Route::get('/getdepartments', [SignupController::class, 'getDepartments']);
    Route::get('/getdesignations', [SignupController::class, 'getDesignations']);
    Route::get('/getstates/{country}', [CollegeController::class, 'getStatesByCountry']);
    Route::get('/getcolleges/{country}/{state}', [CollegeController::class, 'getCollegesByState']);

    //signup form submit route
    Route::post('/regsubmit', [SignupController::class, 'storeRegistration']);

    //All routes that require user to complete signup
    Route::group(['middleware' => 'EnsureSignedUp'], function () {
        Route::post('/protected', function(Request $request){
            return response()->json(['message' => "Backend fetched successfully"], 200);
        });
    });
});
