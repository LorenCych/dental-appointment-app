<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:12|max:18',
        ]);

        Log::info('Login attempt with credentials:', [
            'username' => $credentials['username'],
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Log::info('Login successful:', [
                'user_id' => $user->id,
            ]);
            // Redirect to dashboard with user ID in query string
            return redirect()->route('registrant.dashboard', ['user_id' => $user->id]);
        }

        Log::warning('Login failed for username: ' . $credentials['username']);
        return back()->withErrors(['error' => 'Invalid credentials. Please try again.']);
    }
}
