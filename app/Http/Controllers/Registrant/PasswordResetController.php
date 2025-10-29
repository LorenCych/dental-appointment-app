<?php

namespace App\Http\Controllers\Registrant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    /**
     * Show the forgot password form
     */
    public function showForgotForm()
    {
        return view('registrant.auth.forgot-password');
    }

    /**
     * Send password reset link via email
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No patient account found with this email address.']);
        }

        // Create signed URL that expires in 24 hours for patients (longer than admin)
        $resetUrl = URL::temporarySignedRoute(
            'registrant.password.reset', 
            now()->addHours(24), 
            ['email' => $user->email]
        );

        try {
            // Send reset email
            Mail::send('emails.registrant-password-reset', [
                'user' => $user,
                'resetUrl' => $resetUrl
            ], function($message) use ($user) {
                $message->to($user->email);
                $message->subject('Password Reset Request - LC Happy Care Dental Clinic');
                $message->from(config('mail.from.address'), config('mail.from.name'));
            });

            return back()->with('success', 'Password reset link has been sent to your email address! Please check your inbox and spam folder.');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send email. Please try again later or contact our clinic.']);
        }
    }

    /**
     * Show the password reset form
     */
    public function showResetForm(Request $request)
    {
        // Validate signed URL
        if (!$request->hasValidSignature()) {
            return redirect()->route('login')
                ->withErrors(['error' => 'Invalid or expired password reset link. Please request a new one.']);
        }

        return view('registrant.auth.reset-password', ['email' => $request->email]);
    }

    /**
     * Process password reset
     */
    public function resetPassword(Request $request)
    {
        // Validate signed URL again for security
        if (!$request->hasValidSignature()) {
            return redirect()->route('login')
                ->withErrors(['error' => 'Invalid or expired reset link.']);
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Patient account not found.']);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')
            ->with('success', 'Password has been reset successfully! You can now login with your new password.');
    }
}