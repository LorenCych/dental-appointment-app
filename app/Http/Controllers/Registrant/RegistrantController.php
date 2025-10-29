<?php

namespace App\Http\Controllers\Registrant;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegistrantController extends Controller
{
    public function index(Request $request)
    {
        // Get user_id from query string
        $userId = $request->query('user_id');
        $user = null;
        $appointments = [];
        if ($userId) {
            $user = User::find($userId);
            if ($user) {
                $appointments = Appointment::where('user_id', $user->id)->get();
            }
        }
        return view('registrant.dashboard', compact('user', 'appointments'));
    }

    public function help()
    {
        return view('registrant.help');
    }
}
