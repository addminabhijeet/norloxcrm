<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use App\Models\Payment;
use App\Models\Training;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'junior':
                $resumes = Resume::where('status', 'pending_review')
                                ->get();
                return view('dashboard.junior', compact('resumes'));

            case 'senior':
                $resumes = Resume::where('status', 'forwarded_to_senior')
                                ->get();
                return view('dashboard.senior', compact('resumes'));

            case 'customer':
                $payments = Payment::where('customer_id', $user->id)
                  
                    ->get();
                return view('dashboard.customer', compact('payments'));



            case 'accountant':
                $payments = Payment::with(['customer', 'resume'])->get();
                return view('dashboard.accountant', compact('payments'));

            case 'trainer':
                $trainings = Training::where('trainer_id', $user->id)
                    ->with(['customer', 'resume'])
                    ->get();
                return view('dashboard.trainer', compact('trainings'));

            case 'admin':
                $users = User::all(); 
                return view('dashboard.admin', compact('users'));

            default:
                abort(403, 'Unauthorized action.');
        }
    }
}
