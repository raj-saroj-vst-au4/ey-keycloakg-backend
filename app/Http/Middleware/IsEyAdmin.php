<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class IsEyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $token = json_decode(Auth::token());
        // if(isset($token->realm_access) && in_array('eyantra_admin', $token->realm_access->roles)){
        //     $tokenusername = $token->preferred_username;
        //     $user = Cache::remember('user:'.$tokenusername, 20, function () use ($tokenusername) {
        //         $user = User::with('profile')->where('username', $tokenusername)->first();
        //         return $user && $user->profile->is_admin ? $user : null;
        //     });
        //     if($user && $user->profile->is_admin){
        //         return $next($request);
        //     }
        // }
        if(Auth::hasRole('realm-management', 'realm-admin')){
            return $next($request);
        }
        return response()->json(['error' => 'Forbidden: user not admin'], 423);
    }
}
