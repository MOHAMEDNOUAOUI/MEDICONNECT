<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use Illuminate\Http\Request;

class SpecialiteController extends Controller
{
    public function getAllSpecialites(){
        $specialite = Specialite::all();
        return $specialite;
    }


    public function index() {
        $specialitesWithCount = Specialite::withCount('users')->paginate(5);
        return view('admin.specialite' , ['specialites' => $specialitesWithCount]);
    }


    public function delete(Request $request) {
            $specialite = Specialite::findOrFail($request->delete);
            $specialite->delete();

            return redirect()->back();
    }

    public function update(Request $request) {
        $specialiteName = $request->input('specialitename');
        $id = $request->input('specialite_id');

        $specialite = Specialite::findOrFail($id);

        $specialite->Specialite = $specialiteName;
        $specialite->save();
       

        return redirect()->back();
    }


    public function create (Request $request) {
        Specialite::create([
            'Specialite' => $request->input('holder')
        ]);

        return redirect()->back();
    }
}
