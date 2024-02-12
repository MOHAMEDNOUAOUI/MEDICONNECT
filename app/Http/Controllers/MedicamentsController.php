<?php

namespace App\Http\Controllers;

use App\Models\medicaments;
use Illuminate\Http\Request;

class MedicamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $medicaments = medicaments::paginate(5);
        return view('admin.medicaments' , ['medicaments' => $medicaments]);
    }


    public function indexdoctor() {
        $medicaments = medicaments::paginate(5);
        return view ('doctor.medicaments' , ['medicaments' => $medicaments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {



        $validatedData = $request->validate([
            'medicament' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);



        medicaments::create($validatedData);

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
    public function show(medicaments $medicaments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(medicaments $medicaments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $medicamentName = $request->input('medicament');
        $medicamentDesc = $request->input('description');
        $medicamentPrice = $request->input('price');

        

        $id = $request->input('id_medicament');

        $medicaments = medicaments::findOrFail($id);

        $medicaments->medicament = $medicamentName;
        $medicaments->description = $medicamentDesc;
        $medicaments->price = $medicamentPrice;


        $medicaments->save();
       

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
   
            $medicament = medicaments::findOrFail($request->delete);
            $medicament->delete();

            return redirect()->back();
    
    }
}
