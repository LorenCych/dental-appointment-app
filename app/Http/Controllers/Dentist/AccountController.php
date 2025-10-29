<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use App\Models\Appointment;

class AccountController extends Controller
{
    public function showLoginForm()
    {
        return view('home.admin-login');
    }

    public function unsecurelogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $admin = Admin::where('username', $credentials['username'])->first();
        if ($admin && $credentials['password'] === $admin->password) {
            // Plain text password check for testing only
            session(['admin_id' => $admin->id]);
            return redirect()->route('dentist.dashboard');
        }
        return back()->withErrors(['username' => 'Invalid credentials'])->withInput();
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        // Ensure either username or email is provided
        $username = $request->input('username');
        $email = $request->input('email');

        if (empty($username) && empty($email)) {
            return back()->withErrors(['username' => 'Please provide either username or email address.'])->withInput();
        }

        // Find admin by username or email
        $admin = null;
        if (!empty($username)) {
            $admin = Admin::where('username', $username)->first();
        } else {
            $admin = Admin::where('email', $email)->first();
        }

        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin_id' => $admin->id]);
            return redirect()->route('dentist.dashboard');
        }
        
        return back()->withErrors(['username' => 'Invalid credentials'])->withInput();
    }

    public function logout(Request $request)
    {
        // Log logout attempt
        $adminId = session('admin_id');
        if ($adminId) {
            Log::info('Admin logout', [
                'admin_id' => $adminId,
                'ip_address' => $request->ip()
            ]);
        }

        // Clear all admin session data
        session()->forget(['admin_id', 'admin_username', 'admin_email', 'admin_login_time', 'admin_login_method']);
        
        // Invalidate session for security
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('home.admin-login')->with('success', 'You have been logged out successfully.');
    }

    public function dashboard()
    {
        $adminId = session('admin_id');
        
        if (!$adminId) {
            return redirect()->route('home.admin-login')->with('error', 'Please log in to access the admin dashboard.');
        }

        $admin = Admin::find($adminId);
        
        if (!$admin) {
            session()->forget('admin_id');
            return redirect()->route('home.admin-login')->with('error', 'Admin account not found. Please log in again.');
        }

        // Get appointments for this admin/dentist
        $appointments = Appointment::where('dentist_id', $admin->id)
            ->orderBy('appointment_sched', 'desc')
            ->get();

        return view('dentist.dashboard', compact('admin', 'appointments'));
    }
}
