<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function create()
    {
        $admin = Admin::find(session('admin_id'));
        if ($admin) {

             if ($admin->role_level != 1) {
                 return redirect()->route('dentist.dashboard')
                     ->with('error', 'You do not have permission to create admin accounts. Role level: ' . $admin->role_level);
             }
        } else {
            // If no admin is found, redirect to login or dashboard
            return redirect()->route('dentist.login')
                ->with('error', 'Please log in to access this page.');
        }

        return view('dentist.account.create', compact('admin'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:admins',
            'email' => 'required|email|unique:admins',
            'role_level' => 'required|in:1,2,3',
            'password' => 'required|string|min:12|max:18|confirmed',
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'contact_number' => 'required|string|max:15',
        ]);

        Admin::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'role_level' => $validated['role_level'],
            'password' => Hash::make($validated['password']),
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'contact_number' => $validated['contact_number'],
        ]);

        return redirect()->route('dentist.admin.create')
            ->with('success', 'Admin account created successfully.');
    }

    public function manage()
    {
        $admin = Admin::find(session('admin_id'));
        if (!$admin) {
            return redirect()->route('home.admin-login')
                ->with('error', 'Please log in to access this page.');
        }

        return view('dentist.account.manage', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Admin::find(session('admin_id'));
        if (!$admin) {
            return redirect()->route('home.admin-login')
                ->with('error', 'Please log in to access this page.');
        }

        $validationRules = [
            'username' => 'required|string|max:255|unique:admins,username,' . $admin->id,
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'contact_number' => 'required|string|max:15',
        ];

        // Only validate password if it's provided
        if ($request->filled('password')) {
            $validationRules['password'] = 'string|min:12|max:18|confirmed';
        }

        $validated = $request->validate($validationRules);

        // Update admin fields
        $admin->username = $validated['username'];
        $admin->email = $validated['email'];
        $admin->first_name = $validated['first_name'];
        $admin->middle_name = $validated['middle_name'];
        $admin->last_name = $validated['last_name'];
        $admin->contact_number = $validated['contact_number'];

        // Only update password if provided
        if ($request->filled('password')) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return redirect()->route('dentist.account.manage')
            ->with('success', 'Account updated successfully.');
    }
}
