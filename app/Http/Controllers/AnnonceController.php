<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Annonce;

class AnnonceController extends Controller
{
    
    public function index()
    {
        $annonces = DB::table('annonces')
        ->Select('*')
        ->get();
        return view('admin.annonces', ['annonces' => $annonces]);
    }

    
    public function create()
    {
        return view('admin.annonceAdd');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'Sujet' => 'required'
        ]);
        $id = session('userID');
        $idAdmin = $annonces = DB::table('admins')
        ->Select('id')
        ->where('userID', '=', $id)
        ->first();

        $annonce = new Annonce();
        $annonce->titre = $request->input('titre');
        $annonce->sujet = $request->input('Sujet');
        $annonce->idAdmin = $idAdmin->id; 
        $annonce->save();

        if($annonce->save()){
            $request->session()->flash('success', 'Bien Ajouter.');
            return redirect()->route('annonce.add');
        }else{
            $request->session()->flash('error', 'N\'est pas Ajouter.');
            return redirect()->route('annonce.add');
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
        $annonce = Annonce::where('idAnnonce', $id)->firstOrFail();
        return view('admin.annonceMod', ['annonce' => $annonce ]);
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
            'titre' => 'required',
            'Sujet' => 'required'
        ]);
        

        //$annonce = Annonce::where('idAnnonce', $id)->findOrFail();
        $annonce = Annonce::findOrFail($id);


        $annonce->titre = $request->input('titre');
        $annonce->sujet = $request->input('Sujet');

        $annonce->save();

        if($annonce->save()){
            $request->session()->flash('success', 'Bien Modifier.');
            return redirect()->route('annonce.edit', ['annonce' => $annonce]);
        }else{
            $request->session()->flash('error', 'N\'est pas Modifier.');
            return redirect()->route('annonce.edit', ['annonce' => $annonce]);
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
        $to_delete = Annonce::where('idAnnonce', $id)->firstOrFail();
        $to_delete->delete();
        return redirect()->route('annonce.index')->with('success', 'Student deleted successfully!');
    }
}
