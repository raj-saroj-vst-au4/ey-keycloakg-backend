<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class EnsureSignedUp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = json_decode(Auth::token());
        $tokenusername = $token->preferred_username;
        $user = Cache::remember('user:'.$tokenusername, 20, function () use ($tokenusername) {
            $user = User::where('username', $tokenusername)->first();
            return $user && $user->signupcomplete ? $user : null;
        });

        if ($user && $user->signupcomplete) {
            // User is authenticated and signed up, allow the request to proceed
            return $next($request);
        }
        // User is not signed up, return a 403 Forbidden response
        return response()->json(['error' => 'Forbidden: user not signedup'], 403);
    }
}
