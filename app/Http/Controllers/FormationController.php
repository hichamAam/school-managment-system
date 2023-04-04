<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use Illuminate\Support\Facades\DB;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formation = DB::table('formations')
        ->select('*')
        ->get();
        return view('admin.formation', ['formations' => $formation ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.formationAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom-formation' => 'required',
            'description' => 'required'
        ]);

        $formation = new Formation();

        $formation->Nom_formation = $request->input('nom-formation');
        $formation->description = $request->input('description');
        $formation->save();

        if($formation->save()){
            $request->session()->flash('success', 'Bien Ajouter.');
            return redirect()->route('formation.add');
        }else{
            $request->session()->flash('error', 'N\'est pas Ajouter.');
            return redirect()->route('formation.add');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $formation = Formation::where('idFormation', $id)->firstOrFail();
        return view('admin.formationMod', ['formation' => $formation]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom-formation' => 'required',
            'description' => 'required'
        ]);

        $to_update = Formation::where('idFormation', $id)->firstOrFail();
        
        $to_update->Nom_formation = $request->input('nom-formation');
        $to_update->description = $request->input('description');
        $to_update->save();

        if($to_update->save()){
            $request->session()->flash('success', 'Bien Modifier.');
            return redirect()->route('formation.edit',['formation' => $to_update]);
        }else{
            $request->session()->flash('error', 'N\'est pas Modifier.');
            return redirect()->route('formation.edit',['formation' => $to_update]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $formation = Formation::FindOrFail($id);
        $formation->Delete();

        return redirect()->route('formation.show')->with('success', 'Student deleted successfully!');
    }
}
