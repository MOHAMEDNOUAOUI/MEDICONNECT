<?php

namespace App\Http\Controllers;

use App\Models\appointement;
use App\Models\Specialite;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointements = $this->appointements();
       return view ('doctor.appointement' , ['appointements' => $appointements]);
    }

    public function appointements () {
        $doctorId = Auth::id();
        return appointement::with('Patient' , 'doctor')->where('doctor_id' , $doctorId)->get();
    }

    public function statsPatient() {
        return appointement::with('Patient')->count();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $doctor_id = $request->input('doctor_id');
        $patientId = Auth::id();
        $time_slot = $request->input('time_slot');
        $currentDate = Carbon::now()->format('Y-m-d');


        appointement::create([
            'doctor_id' => $doctor_id,
            'patient_id' => $patientId,
            'time_slot' => $time_slot,
            'appointement_date' => $currentDate
        ]);


        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(appointement $appointement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(appointement $appointement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, appointement $appointement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(appointement $appointement)
    {
        //
    }





    public function urgent() {


        $Datezone = Carbon::now('Africa/Casablanca')->format('Y-m-d');


        $currentHour = Carbon::now()->timezone('africa/casablanca')->format('H');
        $nextHour = Carbon::now()->timezone('africa/casablanca')->addHour()->format('H');
        
        if($currentHour > 12 ){
            $time = $currentHour . ':00 PM - ' . $nextHour.':00 PM';
        }
        else {
            $time = $currentHour . ':00 AM - ' . $nextHour.':00 AM';
        }

        


        $doctors = User::with(['specialite', 'appointmentsAsDoctor'])
        ->whereHas('specialite', function ($query) {
            $query->where('Specialite', 'General Medicine');
        })
        ->get();


    
        $checker = $appoitements = appointement::where('patient_id' , Auth::id())->where('appointment_date' , $Datezone)->where('status' , 'urgent')->get();


        if(count($checker) == 0) {

            foreach($doctors as $doctor) {

                $appoitements = appointement::where('doctor_id' , $doctor->id)->where('appointment_date' , $Datezone)->get();
    
    
    
                if(count($appoitements) > 0){
    

                    foreach($appoitements as $appoitement){
                        $timeslots = $appoitements->pluck('time_slot')->toArray();
                        if(!in_array($time , $timeslots)){
                            appointement::create([
                                'doctor_id' => $doctor->id,
                                'patient_id' => Auth::id(),
                                'status' => 'urgent',
                                'time_slot' => $time
                            ]);
                            break;
                        }
                    }
                   
    
                }
                else {
                    appointement::create([
                        'doctor_id' => $doctor->id,
                        'patient_id' => Auth::id(),
                        'status' => 'urgent',
                        'time_slot' => $time
                    ]);
                    break;
                }
      
    
            }

            
        }
        else{
            return redirect()->back()->with('message', 'You have already taken an emergency appointment today.');
        }
       

        




        return redirect()->back();

        
    }
}
