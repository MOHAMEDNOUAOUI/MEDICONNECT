<?php

namespace App\Http\Controllers;

use App\Models\appointement;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        //
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
}
