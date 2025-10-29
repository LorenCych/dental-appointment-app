<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class TokenAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->cookie('login_token');
        if (!$token) {
            return redirect()->route('login')->with('error', 'Authentication required.');
        }
        $user = User::where('login_token', $token)->first();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid or expired token. Please log in again.');
        }
        // Make user available to controllers/views
        $request->merge(['user' => $user]);
        // Optionally, set globally for views
        view()->share('user', $user);
        return $next($request);
    }
}
