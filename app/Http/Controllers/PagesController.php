<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\appointement;
use Carbon\Carbon;

class PagesController extends Controller
{
    public function index() {
        $currentDate = Carbon::now('Africa/Casablanca')->format('Y-m-d');
        // $currentTime->setTimezone('Africa/Casablanca');
        $doctors = User::with(['appointmentsAsDoctor' , 'specialite'])->where('role' , 'doctor')->paginate(2);
        


        $timeSlots = [
            '8:00 AM - 9:00 AM',
            '9:00 AM - 10:00 AM',
            '10:00 AM - 11:00 AM',
            '11:00 AM - 12:00 PM',
            '1:00 PM - 2:00 PM',
            '2:00 PM - 3:00 PM',
            '3:00 PM - 4:00 PM',
            '4:00 PM - 5:00 PM',
        ];



        // foreach($doctors as $doctor ){
        //     foreach($doctor->appointmentsAsDoctor as $appointement){
        //             dd($appointement->appointment_date);
        //     }
        // }

        
        

        return view('PatientPage' , [
            'doctors' => $doctors , 
            'Datezone' => $currentDate,
            'timeslot' => $timeSlots,        
        ]);
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
