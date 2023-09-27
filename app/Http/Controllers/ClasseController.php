<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Classe;
use App\Models\Formation;
use App\Models\Prof;
use App\Models\Etud;
use App\Models\EtudClasse;
use App\Models\Seance;


class ClasseController extends Controller
{
    


    public function index()
    {
        $classes = Classe::with(['formation', 'professor'])->get();
        return view('admin.classes', ['classes' => $classes ]);
    }

    public function addEtudClass($id){

        if(session()->has('role') && session('role') == "admin"){ 
            
            $classe = Classe::where('idClasse', $id)->with(['formation', 'prof'])->first();

            if($classe == null){
                abort(404);
            }else{
                //$etuds = Etud::select('*')->get();

                $etudClass = DB::table('etud_classes')
                ->join('etuds', 'etuds.id', '=', 'etud_classes.idEtud')
                ->select('etuds.*')
                ->where('etud_classes.idClass', '=', $id)
                ->get();

                $etudClassIds = DB::table('etud_classes')
                ->where('idClass', $id)
                ->pluck('idEtud')
                ->toArray();

                $etuds = Etud::whereNotIn('id', $etudClassIds)->get();

                $seances = Seance::where('Sdate', '>=', date('Y-m-d'))
                  ->orderBy('Sdate')
                  ->orderBy('Stime')
                  ->where('idClasse', '=', $classe->idClasse)
                  ->get();
                  
                $seancesPassed = Seance::where('Sdate', '<', date('Y-m-d'))
                  ->orderBy('Sdate')
                  ->orderBy('Stime')
                  ->where('idClasse', '=', $classe->idClasse)
                  ->get();

                
                
                return view('admin.addEtudToClasse', [
                    'classe' => $classe,
                    'etuds' => $etuds,
                    'etudClass' => $etudClass,
                    'seances' => $seances,
                    'seancesPassed' => $seancesPassed
                    ] );
            }
        }else{
            return redirect()->route('login');
        }
    }

    public function StoreEtudClass(Request $request, $id){

        // Get the IDs of the selected rows
        $idEtuds = $request->input('etud');

        // Debug statement
        //dd($idEtuds);
    
        // Store the IDs in the "etud_classe" table
        foreach ($idEtuds as $idEtud) {
            EtudClasse::create([
                'idEtud' => $idEtud,
                'idClass' => $id
            ]);            
        }
    
        // Redirect to the previous page
        return redirect()->back()->with('success', 'IDs have been stored.');
    }
    

    public function create()
    {
        $profs = DB::table('profs')
        ->select('*')
        ->get();

        $formations = DB::table('formations')
        ->select('*')
        ->get();

        return view('admin.classeAdd', ['profs' => $profs , 'formations' => $formations]);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'Nom_classe' => 'required',
            'idProf' => 'required',
            'idFormation' => 'required',
            'description' => 'required'
        ]);

        $classe = new Classe();

        $classe->Nom_classe = $request->input('Nom_classe');
        $classe->idProf = $request->input('idProf');
        $classe->idFormation = $request->input('idFormation');
        $classe->description = $request->input('description');
        $classe->save();

        if($classe->save()){
            $request->session()->flash('success', 'Bien Ajouter.');
            return redirect()->route('Classe.add');
        }else{
            $request->session()->flash('error', 'N\'est pas Ajouter.');
            return redirect()->route('Classe.add');
        }
    }

    
    public function show($id)
    {
        $seances = DB::table('seances')->where('idClasse', $id)->select('*')->orderby('Sdate', 'DESC')->get();
        $etudClass = DB::table('etud_classes')->select('*')
        ->join('etuds', 'etud_classes.idEtud', '=', 'etuds.id')
        ->where('idClass', $id)->get();
        $classe = Classe::where('idClasse', $id)->first();
        if($classe == null){
            abort(404);
        }else{
            return view('prof.classeShow', [
                'classe' => $classe,
                'etudClass' => $etudClass,
                'seances' => $seances
            ]); 
        }
    }

    
    public function edit($id)
    {
        $classe = DB::table('classes')
        ->select('*')
        ->where('idClasse', '=', $id)
        ->first();
        
        $profs = DB::table('profs')
        ->select('*')
        ->get();
        $profSelected = DB::table('profs')
        ->select('*')
        ->where('id', '=', $classe->idProf)
        ->first();

        $formations = DB::table('formations')
        ->select('*')
        ->get();
        $formationSelected = DB::table('formations')
        ->select('*')
        ->where('idFormation', '=', $classe->idFormation)
        ->first();
        
        return view('admin.classeMod', [
            'classe' => $classe,
            'profs' => $profs ,
            'formations' => $formations,
            'formationSelected' => $formationSelected,
            'profSelected' => $profSelected
        ]);

    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'Nom_classe' => 'required',
            'idProf' => 'required',
            'idFormation' => 'required'
        ]);

        $to_update = Classe::where('idClasse', $id)->firstOrFail();
        
        $to_update->Nom_classe = $request->input('Nom_classe');
        $to_update->idFormation = $request->input('idFormation');
        $to_update->idProf = $request->input('idProf');
        $to_update->description = $request->input('description');
        $to_update->save();

        if($to_update->save()){
            $request->session()->flash('success', 'Bien Modifier.');
            return redirect()->route('Classe.edit', ['Classe' => $to_update ]);
        }else{
            $request->session()->flash('error', 'N\'est pas Modifier.');
            return redirect()->route('Classe.edit', ['Classe' => $to_update ]);
        }
    }

    
    public function deleteEtudClass($idEtud, $idClass){
        
        $to_delete = EtudClasse::where('idClass', $idClass)
        ->where('idEtud', $idEtud)
        ->delete();
        
        return redirect()->back()->with('success', 'IDs have been stored.');
    
        
    }

    public function destroy($id)
    {
        $to_delete = Classe::where('idClasse', $id)->firstOrFail();
        $to_delete->delete();
        return redirect()->route('Classe.index')->with('success', 'Student deleted successfully!');
    }
}
