<?php

namespace App\Http\Controllers\Registrant;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            // Try using Brevo API if available, otherwise fall back to SMTP
            if (env('BREVO_API_KEY')) {
                $this->sendPasswordResetViaBrevoAPI($user, $resetUrl);
            } else {
                // Send reset email
                Mail::send('emails.registrant-password-reset', [
                    'user' => $user,
                    'resetUrl' => $resetUrl
                ], function($message) use ($user) {
                    $message->to($user->email);
                    $message->subject('Password Reset Request - LC Happy Care Dental Clinic');
                    $message->from(config('mail.from.address'), config('mail.from.name'));
                });
            }

            return back()->with('success', 'Password reset link has been sent to your email address! Please check your inbox and spam folder.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Password reset email failed: ' . $e->getMessage());
            
            return back()->withErrors(['email' => 'Unable to send password reset email. Please try again later.']);
        }
    }

    private function sendPasswordResetViaBrevoAPI($user, $resetUrl)
    {
        $apiKey = env('BREVO_API_KEY');
        
        if (!$apiKey) {
            throw new \Exception('Brevo API key not configured');
        }

        $htmlContent = view('emails.registrant-password-reset', [
            'user' => $user,
            'resetUrl' => $resetUrl
        ])->render();

        $data = [
            'sender' => [
                'name' => 'LC Happy Care Dental Clinic',
                'email' => env('MAIL_FROM_ADDRESS', 'noreply@lchappycare.com')
            ],
            'to' => [
                [
                    'email' => $user->email,
                    'name' => $user->first_name . ' ' . $user->last_name
                ]
            ],
            'subject' => 'Password Reset Request - LC Happy Care Dental Clinic',
            'htmlContent' => $htmlContent
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.brevo.com/v3/smtp/email');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/json',
            'api-key: ' . $apiKey
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 201) {
            $error = json_decode($response, true);
            throw new \Exception('Brevo API error: ' . ($error['message'] ?? 'Unknown error'));
        }

        Log::info('Password reset email sent via Brevo API', [
            'email' => $user->email,
            'response' => $response
        ]);
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