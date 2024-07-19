<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    function getEvents(){
        $events = Workshop::with(['wscreator','wsfalic'])->where('wsstart', '>=', Carbon::now())->get();
        return response()->json($events);
    }
    function addWorkshop(Request $request){
        try {
            $validated = $request->validate([
                'wsname' => 'required|string|min:3|max:255',
                'wsdesc' => 'required|string|min:3|max:255',
                'wsfalic' => 'required',
                'wsimgurl' => 'required|string|min:7|max:255',
                'wsstart' => 'required|date',
                'wsend' => 'required|date',
                'wscreator_email' => 'required'
            ]);
            $wscreator = User::where('email', $validated['wscreator_email'])->first();
            $wsstart = Carbon::parse($validated['wsstart'])->format('Y-m-d H:i:s');
            $wsend = Carbon::parse($validated['wsend'])->format('Y-m-d H:i:s');
            if($validated && $wscreator){
                $workshop = new Workshop();
                $workshop->wsname = $request->wsname;
                $workshop->wsdesc = $request->wsdesc;
                $workshop->wsfalic = $request->wsfalic;
                $workshop->wsimgurl = $request->wsimgurl;
                $workshop->wsclg = $request->wsclg;
                $workshop->wsstart = $wsstart;
                $workshop->wsend = $wsend;
                $workshop->wscreator = $wscreator->id;
                $workshop->save();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Workshop Added Successfully'
                    ]);
            }else{
                    return response()->json([
                            'status' => 'error',
                            'message' => 'Workshop Not Added'
                            ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
                ]);
                }

    }
}






