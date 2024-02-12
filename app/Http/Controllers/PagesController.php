<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\appointement;

class PagesController extends Controller
{
    public function index() {
        $doctors = User::where('role' , 'doctor')->get();
        return view('PatientPage');
    }

    public function dashboard(Request $request) : View
    {

        $patients = user::where('role' , 'patient')->count();
        $doctors = user::where('role' , 'doctor')->count();
        
      return view ('admin.dashboard' , ['user' => $request->user(),
        'specialitestats' => Specialite::count(),
        'patients' => $patients,
        'doctors' => $doctors
    ]);
    }

    public function DoctorPage() {
        $appointementcontroller = new AppointementController();


        $doctorId = Auth::id();
        $patients = User::whereHas('appointmentsAsPatient', function ($query) use ($doctorId) {
            $query->where('doctor_id', $doctorId);
        })->where('role', 'patient')->count();

        $appointements = appointement::with('Patient' , 'doctor')->where('doctor_id' , $doctorId)->count();

        return view('doctor.doctorpage' , ['appointements' => $appointements , 'patients' => $patients]);
    }
}
