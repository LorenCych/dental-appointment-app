<?php

namespace App\Http\Controllers\Registrant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Str;

class AccountController extends Controller
{
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
    // POST: /registrant/account/change-info
    public function saveAppointeeInfo(Request $request)
    {
        $userId = $request->input('user_id');
        $user = $userId ? User::find($userId) : Auth::user();
        if (!$user) {
            return back()->withErrors(['error' => 'User not found.']);
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'birthday' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
        ]);

        if ($user instanceof \App\Models\User) {
            $user->first_name = $validated['first_name'];
            $user->middle_name = $validated['middle_name'] ?? null;
            $user->last_name = $validated['last_name'];
            $user->birthday = $validated['birthday'];
            $user->gender = $validated['gender'];
            $user->address = $validated['address'];
            $user->contact_number = $validated['contact_number'];
            $user->age = \Carbon\Carbon::parse($validated['birthday'])->age;
            $user->save();
        } else {
            return back()->withErrors(['error' => 'User model not found or invalid.']);
        }

        return redirect()->route('registrant.account.update-info', ['user_id' => $user->id])
            ->with('success', 'Information updated successfully.');
    }
    // Manage account
    public function manage(Request $request)
    {
        $userId = $request->query('user_id');
        $user = null;
        if ($userId) {
            $user = \App\Models\User::find($userId);
        }
        return view('registrant.account.manage', compact('user'));
    }

    public function updateInfo(Request $request)
    {
        $userId = $request->query('user_id');
        $user = null;
        if ($userId) {
            $user = \App\Models\User::find($userId);
        }
        return view('registrant.account.update-info', compact('user'));
    }

    public function create(Request $request)
    {
        Log::info('=== ACCOUNT CREATION STARTED ===');
        Log::info('Request method: ' . $request->method());
        Log::info('Request data received:', $request->all());

        //validate input
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:18|confirmed',
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'birthday' => 'required|date',
            'contact_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'verification_code' => 'required|string|size:6',
        ]);

        Log::info('Validation passed. Validated data:', $validated);

        // Verify the verification code
        $cacheKey = "signup_verification_code_{$validated['email']}";
        $storedCode = Cache::get($cacheKey);

        if (!$storedCode || $storedCode !== $validated['verification_code']) {
            return back()->withErrors(['verification_code' => 'Invalid or expired verification code. Please request a new one.'])
                ->withInput($request->except('password', 'password_confirmation', 'verification_code'));
        }

        try {
            // Hash password
            $validated['password'] = bcrypt($validated['password']);

            //  Calculate age from birthday
            if (!empty($validated['birthday'])) {
                $validated['age'] = Carbon::parse($validated['birthday'])->age;
            } else {
                $validated['age'] = null;
            }

            Log::info('About to create user with processed data:', $validated);

            // create user
            $user = User::create($validated);

            Log::info('User created successfully! User ID:', ['user_id' => $user->id]);

            // Clear the verification code from cache
            Cache::forget($cacheKey);

            Log::info('Account created and verification code cleared', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            // ✅ Redirect to login page with success message
            return redirect()->route('login')->with('success', 'Account created successfully! Your email has been verified. Please log in to access your account.');

            //start their session -
            //Auth::login($user);
            //return redirect()->route('registrant.dashboard')->with('success', 'Account created successfully!');

            // Insert it back here -m244

            //fetch their appointment
            // $appointments = Appointment::where('user_id', $user->id)->get();
            //Log::info('Rendering dashboard view');

            //use fetched data to render page
            // return view('registrant.dashboard', compact('user', 'appointments'));
        } catch (\Exception $e) {

            Log::error('=== ACCOUNT CREATION FAILED ===');
            Log::error('Error message: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()->withErrors(['error' => 'Failed to create account. Please try again.'])
                ->withInput($request->except('password', 'password_confirmation'));
        }
    }

    public function sendSignupVerificationCode(Request $request)
    {
        $email = $request->input('email');
        
        if (!$email) {
            return response()->json(['error' => 'Email address is required.'], 400);
        }

        // Check if email is already taken
        if (User::where('email', $email)->exists()) {
            return response()->json(['error' => 'This email is already registered. Please use a different email or login to your existing account.'], 409);
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['error' => 'Please enter a valid email address.'], 400);
        }

        // Generate 6-digit verification code
        $verificationCode = sprintf('%06d', mt_rand(100000, 999999));
        
        // Store in cache for 15 minutes (longer for signup)
        $cacheKey = "signup_verification_code_{$email}";
        Cache::put($cacheKey, $verificationCode, 900); // 15 minutes

        try {
            // Try using Brevo API if available, otherwise fall back to SMTP
            if (env('BREVO_API_KEY')) {
                $this->sendEmailViaBrevoAPI($email, $verificationCode, 'signup');
            } elseif (config('mail.mailers.smtp.host') && config('mail.mailers.smtp.username') && config('mail.mailers.smtp.password')) {
                // Send verification email for signup
                Mail::send('emails.signup-verification-code', [
                    'email' => $email,
                    'verificationCode' => $verificationCode
                ], function($message) use ($email) {
                    $message->to($email);
                    $message->subject('Welcome! Verify Your Email - LC Happy Care Dental Clinic');
                    $message->from(config('mail.from.address'), config('mail.from.name'));
                });
            } else {
                // Log mail configuration issue
                Log::warning('Mail not properly configured, verification code not sent', [
                    'email' => $email,
                    'has_brevo_api' => !empty(env('BREVO_API_KEY')),
                    'has_host' => !empty(config('mail.mailers.smtp.host')),
                    'has_username' => !empty(config('mail.mailers.smtp.username')),
                    'has_password' => !empty(config('mail.mailers.smtp.password'))
                ]);
                
                throw new \Exception('No email service configured. Please set up Brevo API key or SMTP settings.');
            }

            Log::info('Signup verification code sent', [
                'email' => $email,
                'code' => $verificationCode // Remove this in production
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Verification code sent to your email address! Please check your inbox and spam folder.'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send signup verification code', [
                'email' => $email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Provide more specific error messages
            $errorMessage = 'Failed to send verification code. ';
            if (str_contains($e->getMessage(), 'Connection refused') || str_contains($e->getMessage(), 'timeout')) {
                $errorMessage .= 'Email service is temporarily unavailable. Please try again in a few minutes.';
            } elseif (str_contains($e->getMessage(), 'authentication') || str_contains($e->getMessage(), 'login')) {
                $errorMessage .= 'Email configuration error. Please contact support.';
            } elseif (str_contains($e->getMessage(), 'invalid') && str_contains($e->getMessage(), 'email')) {
                $errorMessage .= 'Invalid email address format.';
            } else {
                $errorMessage .= 'Please check your email address and try again.';
            }
            
            return response()->json([
                'error' => $errorMessage,
                'debug' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    private function sendEmailViaBrevoAPI($email, $verificationCode, $type = 'signup')
    {
        $apiKey = env('BREVO_API_KEY');
        
        if (!$apiKey) {
            throw new \Exception('Brevo API key not configured');
        }

        $subject = $type === 'signup' ? 
            'Welcome! Verify Your Email - LC Happy Care Dental Clinic' : 
            'Account Verification Code - LC Happy Care Dental Clinic';

        $htmlContent = view('emails.' . ($type === 'signup' ? 'signup-verification-code' : 'verification-code'), [
            'email' => $email,
            'verificationCode' => $verificationCode
        ])->render();

        $data = [
            'sender' => [
                'name' => 'LC Happy Care Dental Clinic',
                'email' => env('MAIL_FROM_ADDRESS', 'noreply@lchappycare.com')
            ],
            'to' => [
                [
                    'email' => $email,
                    'name' => explode('@', $email)[0] // Use email username as name
                ]
            ],
            'subject' => $subject,
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

        Log::info('Email sent via Brevo API', [
            'email' => $email,
            'type' => $type,
            'response' => $response
        ]);
    }

    public function sendVerificationCode(Request $request)
    {
        $userId = $request->input('user_id');
        $user = $userId ? User::find($userId) : null;
        
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        // Generate 6-digit verification code
        $verificationCode = sprintf('%06d', mt_rand(100000, 999999));
        
        // Store in cache for 10 minutes
        $cacheKey = "verification_code_{$user->id}_{$user->email}";
        Cache::put($cacheKey, $verificationCode, 600); // 10 minutes

        try {
            // Send verification email
            Mail::send('emails.verification-code', [
                'user' => $user,
                'verificationCode' => $verificationCode
            ], function($message) use ($user) {
                $message->to($user->email);
                $message->subject('Account Verification Code - LC Happy Care Dental Clinic');
                $message->from(config('mail.from.address'), config('mail.from.name'));
            });

            Log::info('Verification code sent', [
                'user_id' => $user->id,
                'email' => $user->email,
                'code' => $verificationCode // Remove this in production
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Verification code sent to your email address!'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send verification code', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'error' => 'Failed to send verification code. Please try again.'
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $userId = $request->input('user_id');
        $user = $userId ? User::find($userId) : null;
        if (!$user) {
            return back()->withErrors(['error' => 'User not found.']);
        }

        $validated = $request->validate([
            'set_username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'set_email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'set_password' => 'nullable|string|min:12|max:18|confirmed',
            'verification_code' => 'required|string|size:6',
        ]);

        // Verify the verification code
        $cacheKey = "verification_code_{$user->id}_{$user->email}";
        $storedCode = Cache::get($cacheKey);

        if (!$storedCode || $storedCode !== $validated['verification_code']) {
            return back()->withErrors(['verification_code' => 'Invalid or expired verification code. Please request a new one.']);
        }

        // Update user information
        $user->username = $validated['set_username'];
        $user->email = $validated['set_email'];
        if (!empty($validated['set_password'])) {
            $user->password = bcrypt($validated['set_password']);
        }
        $user->save();

        // Clear the verification code from cache
        Cache::forget($cacheKey);

        Log::info('Account updated successfully', [
            'user_id' => $user->id,
            'updated_fields' => array_keys($validated)
        ]);

        return redirect()->route('registrant.account.manage', ['user_id' => $user->id])
            ->with('success', 'Account information updated successfully!');
    }
}
