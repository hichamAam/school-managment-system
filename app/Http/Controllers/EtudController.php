<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Etud;
use App\Models\Classe;
use App\Models\Annonce;

class EtudController extends Controller
{
    
    public function index()
    {
        if(session()->has('role') && session('role') == "etud"){
            $userID = session('userID');
            $id = DB::table('etuds')
            ->where('userID', '=', $userID)
            ->value('id');

            $seances = DB::table('seances')
            ->select('*')
            ->join('classes','seances.idClasse','=','classes.idClasse')
            ->join('profs','classes.idProf','=','profs.id')
            ->join('etud_classes','classes.idClasse','=','etud_classes.idClass')
            ->join('etuds','etud_classes.idEtud','=','etuds.id')
            ->join('formations','classes.idFormation','=','formations.idFormation')
            ->where('etuds.id', '=', $id)
            ->get();

            $classes = Classe::join('etud_classes', 'classes.idClasse', '=', 'etud_classes.idClass')
            ->join('etuds', 'etud_classes.idEtud', '=', 'etuds.id')
            ->where('idProf', $id)->get();
            
            $annonces = Annonce::select('*')->get();

            return view('etud.index',[
                'classes' => $classes,
                'seances' => $seances,
                'annonces' => $annonces
            ]);
        }else{
            return redirect()->route('login');
        }  
    }

    
    public function create()
    {
        //
    }
    
    public function classes()
    {
        if(session()->has('role') && session('role') == "etud"){

            $id = DB::table('etuds')->where('userID', session('userID'))->value('id');

            //dd($id);

            $classes = DB::table('etud_classes')
            ->join('classes', 'etud_classes.idClass', '=', 'classes.idClasse')
            ->join('formations', 'classes.idFormation', '=', 'formations.idFormation')
            ->join('profs', 'classes.idProf', '=', 'profs.id')
            ->where('etud_classes.idEtud', $id)
            ->get();



            return view('Etud.classes', [
                'classes' => $classes
            ]);

        }else{
            return redirect()->route('login');
        }  
    }



    
    public function classeShow($id)
    {
        $classes = DB::table('classes')
        ->join('profs', 'classes.idProf', '=', 'profs.id')
        ->join('formations', 'classes.idFormation', '=', 'formations.idFormation')
        ->where('classes.idClasse', $id)
        ->first();

        $seances = DB::table('seances')
        ->where('idClasse', $id)
        ->orderBy('Sdate', 'desc')
        ->get();

        return view('etud.classeShow', [
            'classe' => $classes,
            'seances' => $seances
        ]);
    }
    
    public function seances()
    {
        $id = DB::table('etuds')->where('userID', session('userID'))->value('id');

        $seances = DB::table('seances')
            ->join('classes', 'seances.idClasse', '=', 'classes.idClasse')
            ->join('etud_classes', 'classes.idClasse', '=', 'etud_classes.idClass')
            ->join('profs', 'classes.idProf', '=', 'profs.id')
            ->where('etud_classes.idEtud', $id)
            ->orderBy('seances.Sdate', 'desc')
            ->get();

        return view('etud.seances',[
            'seances' => $seances
        ]);
    }


    public function cours()
    {
        $id = DB::table('etuds')->where('userID', session('userID'))->value('id');
        $cours = DB::table('courses')
        ->join('classes', 'courses.idClasse', '=', 'classes.idClasse')
        ->join('etud_classes', 'classes.idClasse', '=', 'etud_classes.idClass')
        ->join('profs', 'courses.idProf', '=', 'profs.id')
        ->where('etud_classes.idEtud', $id)
        ->get();

        return view('etud.cours', [
            'cours' => $cours
        ]);
    }

    public function profil()
    {
        if(session()->has('role') && session('role') == "etud"){
            $etud = DB::table('etuds')
            ->join('users', 'etuds.userID', '=', 'users.id')
            ->where('etuds.userID', session('userID'))
            ->first();

            return view('etud.profil', [
                'etud' => $etud
            ]);
        }else{
            return  redirect('login');
        }
    }
    public function store(Request $request)
    {
        //
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
    public function edit()
    { 
        if(session()->has('role') && session('role') == "etud"){
            $etud = DB::table('etuds')
            ->join('users', 'etuds.userID', '=', 'users.id')
            ->where('etuds.userID', session('userID'))
            ->first();

            return view('etud.profilMod', [
                'etud' => $etud
            ]);
        }else{
            return  redirect('login');
        }
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
        $item = Etud::findOrFail($id);
        $item->prenom = $request->input('prenom');
        $item->nom = $request->input('nom');
        $item->bdate = $request->input('bdate');
        $item->niveau = $request->input('niveau');
        $item->adresse = $request->input('adresse');
        $item->tel = $request->input('notell');
        $item->updated_at = now();
        $item->save();

        if($item->save()){
            $request->session()->flash('success', 'Update successful.');
            return redirect()->route('etuds.etudsMod',$id);//->with('success', 'Item updated successfully');
        }else{
            $request->session()->flash('error', 'Update failed.');
            return redirect()->route('etuds.etudsMod',$id);//->with('success', 'Item updated successfully');
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
        $etud = Etud::findOrFail($id);
        $etud->delete();
    
        return redirect()->route('admin.etuds.index');
    }
}
