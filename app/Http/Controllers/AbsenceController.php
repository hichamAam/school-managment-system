<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Absence;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idSeance)
    {
        $idEtuds = $request->has('etud') && is_array($request->input('etud')) ? $request->input('etud') : [];
    
        foreach ($idEtuds as $idEtud) {
            DB::table('absences')->insert([
                'idEtud' => $idEtud,
                'idSeance' => $idSeance,
                'absent' => true
            ]);
            
        }
        
        return redirect()->back()->with('success', 'IDs have been stored.');
    }
    


    
    
    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seance = DB::table('seances')->where('idSeance', $id)->first();
        
        if($seance == null){
            abort(404);
        }else{
            
            
            $classe = DB::table('classes')
            ->join('formations', 'classes.idFormation', '=', 'formations.idFormation')
            ->join('seances', 'classes.idClasse', '=', 'seances.idClasse')
            ->select('classes.idClasse', 'classes.Nom_classe', 'formations.Nom_formation', 'classes.description')
            ->where('idSeance', $id)
            ->first();

            $absents = DB::table('etuds')
            ->select('etuds.id', 'etuds.prenom', 'etuds.nom')
            ->join('absences', 'etuds.id', '=', 'absences.idEtud')
            ->where('idSeance', $id)
            ->get();

            $etuds = DB::table('etuds')
            ->join('etud_classes', 'etuds.id', '=', 'etud_classes.idEtud')
            ->join('classes', 'etud_classes.idClass', '=', 'classes.idClasse')
            ->select('etuds.id', 'etuds.nom', 'etuds.prenom')
            ->where('idClasse', $classe->idClasse)
            ->get();
            
            
            return view('prof.absence', [
                'classe' => $classe,
                'seance' => $seance,    
                'etuds' => $etuds,
                'absents' => $absents
            ]);

        }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idSeance, $idEtud)
    {
        
        $absent = Absence::where('idSeance', $idSeance)
        ->where('idEtud', $idEtud)
        ->delete();
        return redirect()->back();
    }

}
