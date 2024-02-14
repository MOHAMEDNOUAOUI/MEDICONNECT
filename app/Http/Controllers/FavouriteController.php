<?php

namespace App\Http\Controllers;

use App\Models\favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $exist = favourite::where('doctor_id' , $request->input('doctorid'))->where('patient_id' , Auth::id())->get();
        

        if(count($exist) > 0) {
            favourite::where('doctor_id' , $request->input('doctorid'))->where('patient_id' , Auth::id())->delete();
        }
        else{
            favourite::create([
                'doctor_id' => $request->input('doctorid'),
                'patient_id' => Auth::id()
            ]);
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(favourite $favourite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(favourite $favourite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, favourite $favourite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(favourite $favourite)
    {
        //
    }
}
