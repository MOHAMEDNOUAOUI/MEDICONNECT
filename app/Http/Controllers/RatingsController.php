<?php

namespace App\Http\Controllers;

use App\Models\ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
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
        $data = $request->validate([
            'doctor_id' => 'required',
            'rating' => 'required|numeric|min:0|max:5'
        ]);


        $data['patient_id'] = Auth::id();

        $this->destroy(new ratings());
        ratings::create($data);

        return redirect()->back()->with('message' , 'congrats');


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
    public function show(ratings $ratings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ratings $ratings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ratings $ratings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ratings $ratings)
    {
        $userId = Auth::id();

        $ratings::where('patient_id' , $userId)->delete();
    }
}
