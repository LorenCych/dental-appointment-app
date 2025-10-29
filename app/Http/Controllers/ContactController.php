<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        try {
            // Log the contact form submission
            Log::info('Contact form submitted', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'message_length' => strlen($validated['message']),
                'timestamp' => now()
            ]);

            // Check if mail is configured before attempting to send
            $mailConfigured = config('mail.default') && config('mail.default') !== 'log';
            
            if ($mailConfigured) {
                try {
                    Mail::to('lorencecych@gmail.com')->send(new ContactFormMail($validated));
                    
                    Log::info('Contact form email sent successfully', ['email' => $validated['email']]);
                    
                } catch (\Exception $mailException) {
                    // If email fails, log the error but don't fail the entire process
                    Log::warning('Contact form email failed to send', [
                        'error' => $mailException->getMessage(),
                        'email' => $validated['email'],
                        'name' => $validated['name']
                    ]);
                }
            } else {
                // Mail not configured - log detailed message for admin review
                Log::info('Contact form received (email not configured)', [
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'message' => $validated['message'],
                    'timestamp' => now()->format('Y-m-d H:i:s'),
                    'note' => 'Configure mail settings to receive these messages via email'
                ]);
            }

            return redirect()->back()->with('success', 'Thank you for your message! We have received your inquiry and will get back to you soon.');

        } catch (\Exception $e) {
            Log::error('Contact form submission failed', [
                'error' => $e->getMessage(),
                'email' => $validated['email'],
                'trace' => $e->getTraceAsString()
            ]);

            // For development, show more specific error information
            $errorMessage = 'Sorry, there was an error processing your message. ';
            
            if (app()->environment('local')) {
                $errorMessage .= 'Error details: ' . $e->getMessage();
            } else {
                $errorMessage .= 'Please try again or contact us directly at lorencecych@gmail.com or 09451996006.';
            }

            return redirect()->back()
                ->withErrors(['error' => $errorMessage])
                ->withInput();
        }
    }
}