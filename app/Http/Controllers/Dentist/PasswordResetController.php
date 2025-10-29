<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PasswordResetController extends Controller
{
    /**
     * Show the forgot password form
     */
    public function showForgotForm()
    {
        return view('dentist.auth.forgot-password');
    }

    /**
     * Send password reset link via email
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'No dentist account found with this email address.']);
        }

        // Create signed URL that expires in 2 hours (increased for testing)
        $resetUrl = URL::temporarySignedRoute(
            'dentist.password.reset', 
            now()->addHours(2), 
            ['email' => $admin->email]
        );

        try {
            // Send reset email
            Mail::send('emails.dentist-password-reset', [
                'admin' => $admin,
                'resetUrl' => $resetUrl
            ], function($message) use ($admin) {
                $message->to($admin->email);
                $message->subject('Password Reset Request - LC Happy Care Dental Clinic');
                $message->from(config('mail.from.address'), config('mail.from.name'));
            });

            return back()->with('success', 'Password reset link has been sent to your email address!');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send email. Please try again later.']);
        }
    }

    /**
     * Show the password reset form
     */
    public function showResetForm(Request $request)
    {
        // Validate signed URL
        if (!$request->hasValidSignature()) {
            return redirect()->route('home.admin-login')
                ->withErrors(['error' => 'Invalid or expired password reset link. Please request a new one.']);
        }

        return view('dentist.auth.reset-password', ['email' => $request->email]);
    }

    /**
     * Process password reset
     */
    public function resetPassword(Request $request)
    {
        // Debug: Log the request details
        Log::info('Password reset attempt', [
            'query_params' => $request->query->all(),
            'has_signature' => $request->query->has('signature'),
            'has_expires' => $request->query->has('expires'),
            'signature_valid' => $request->hasValidSignature()
        ]);

        // Validate signed URL again for security
        if (!$request->hasValidSignature()) {
            Log::warning('Password reset failed signature validation', [
                'email' => $request->email,
                'query_params' => $request->query->all()
            ]);
            
            return redirect()->route('home.admin-login')
                ->withErrors(['error' => 'Invalid or expired reset link. Please try requesting a new password reset.']);
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:12|max:18|confirmed'
        ]);

        $admin = Admin::where('email', $request->email)->first();
        
        if (!$admin) {
            return back()->withErrors(['email' => 'Dentist account not found.']);
        }

        // Update password
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('home.admin-login')
            ->with('success', 'Password has been reset successfully! You can now login with your new password.');
    }
}