<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\appointement;
use App\Models\comments;
use App\Models\favourite;
use App\Models\ratings;
use Carbon\Carbon;

class PagesController extends Controller
{
    public function index(Request $request) {
        $currentDate = Carbon::now('Africa/Casablanca')->format('Y-m-d');
        // $currentTime->setTimezone('Africa/Casablanca');

        $spec = $request->input('specialite');

        if(isset($spec)) {
            if($spec !== 'ALL') {
                $doctors = User::with(['appointmentsAsDoctor', 'specialite'])->where('role', 'doctor')->whereHas('specialite', function ($query) use ($request) {
                    $query->where('Specialite', $request->input('specialite'));
                })
                ->paginate(12);
            }
            else {
                return redirect()->route('home');
            }
        } else {
            $doctors = User::where('role', 'doctor')->paginate(12);
        }
        

        // foreach($doctors as $doctor ){
        //     foreach($doctor->appointmentsAsDoctor as $appointement){
        //             dd($appointement->appointment_date);
        //     }
        // }


        $patientId  = Auth::id();
        $userappointements = appointement::with(['patient'])->where('patient_id' , $patientId)->get();


        $favourites = Favourite::with(['doctor.specialite'])
        ->whereHas('doctor', function ($query) {
            $query->where('role', 'doctor');
        })
        ->where('patient_id', Auth::id())
        ->get();

        $favouritenumber = Favourite::with(['doctor.specialite'])
        ->whereHas('doctor', function ($query) {
            $query->where('role', 'doctor');
        })
        ->where('patient_id', Auth::id())
        ->pluck('doctor_id')->toArray();




        
        $specialites = Specialite::get();
        

        return view('patient.PatientPage' , [
            'doctors' => $doctors , 
            'Datezone' => $currentDate,
            'userschedul' => $userappointements,
            'favourite' => $favourites ,
            'specialites' => $specialites,
            'fav' => $favouritenumber
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



    public function DedicatedDoctorPage($doctorname) {

        $doctorId = User::where('name', $doctorname)->value('id');

        $currentDate = Carbon::now('Africa/Casablanca')->format('Y-m-d');

        $currentDatetime = Carbon::now()->setTimezone('Africa/casablanca');



        $doctor = User::with(['appointmentsAsDoctor' , 'specialite'])->where('name' , $doctorname)->get();


        $doctorinfos = User::with(['specialite'])->where('id' , $doctorId)->first();

        $timeSlots = [
            '08:00 AM - 09:00 AM',
            '09:00 AM - 10:00 AM',
            '10:00 AM - 11:00 AM',
            '11:00 AM - 12:00 PM',
            '13:00 PM - 14:00 PM',
            '14:00 PM - 15:00 PM',
            '15:00 PM - 16:00 PM',
            '16:00 PM - 17:00 PM',
        ];



        $comments = comments::with(['doctor'])->where('doctor_id', $doctorId)->orderBy('created_at', 'desc')->limit(4)->get();

        $commentscount =  comments::with(['doctor'])->where('doctor_id' , $doctorId)->count();


        $rating = ratings::where('doctor_id' , $doctorId)->avg('rating');
        $intrating = floor($rating);
        $FINALRATING = min(max($intrating, 0), 5);

        return view ('patient.doctor' , ['doctor' => $doctor,'doctorinfos'=>$doctorinfos,'timeslot' => $timeSlots,'Datezone' => $currentDate , 'comments'=>$comments , 'commentscount'=>$commentscount , 'avgrating' => $FINALRATING , 'doctorId' => $doctorId]);
    }
}
