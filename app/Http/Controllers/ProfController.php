<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prof;
use App\Models\Classe;
use App\Models\User;
use App\Models\Annonce;

class ProfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->has('role') && session('role') == "prof"){

            $userID = session('userID');
            $id = DB::table('profs')
            ->where('userID', '=', $userID)
            ->value('id');

            $seances = DB::table('seances')
            ->select('*')
            ->join('classes','seances.idClasse','=','classes.idClasse')
            ->join('profs','classes.idProf','=','profs.id')
            ->join('formations','classes.idFormation','=','formations.idFormation')
            ->where('classes.idProf', '=', $id)
            ->get();

            $classes = Classe::where('idProf', $id)->get();
            $annonces = Annonce::select('*')->get();

            return view('prof.index',[
                'classes' => $classes,
                'seances' => $seances,
                'annonces' => $annonces
            ]);
        }else{
            return redirect()->route('login');
        }  
    }

    public function profil(){
        if(session()->has('role') && session('role') == "prof"){
            $prof = DB::table('profs')
            ->join('users', 'profs.userID', '=', 'users.id')
            ->where('userID', session('userID'))
            ->first();

            return view('prof.profil', ['prof' => $prof]);
        }else{
            return redirect('login');
        }
    }

    public function classes(){
        if(session()->has('role') && session('role') == "prof"){
            $userID = session('userID');
            $id = DB::table('profs')
            ->where('userID', '=', $userID)
            ->value('id');

            $classes = DB::table('classes')
            ->join('formations', 'classes.idFormation', '=', 'formations.idFormation')
            ->where('classes.idProf', '=', $id)
            ->select('*')
            ->get();
        

            $prof = Prof::select('*')
            ->where('profs.id', '=', $id)
            ->first();

            /*$classes = DB::table('classes')
            ->join('formations', 'classes.idFormation', '=', 'formations.idFormation')
            ->where('idProf', '=', $prof->id)
            ->select('*')
            ->get();*/        

            return view('prof.classes', [
                'prof' => $prof,
                'classes' => $classes
            ]);
        }else{
            return redirect()->route('login');
        }  
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
        $prof = DB::table('profs')
            ->join('users', 'profs.userID', '=', 'users.id')
            ->where('profs.userID', session('userID'))
            ->select('profs.*', 'users.email')
            ->first();
        
        return view('prof.profilMod',['prof' => $prof]);
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
        $item = Prof::findOrFail($id);
        $item->prenom = $request->input('prenom');
        $item->nom = $request->input('nom');
        $item->tel = $request->input('notell');
        $item->updated_at = now();
        $item->save();

        if($item->save()){
            $request->session()->flash('success', 'Update successful.');
            return redirect()->route('admin.profMod',$id);//->with('success', 'Item updated successfully');
        }else{
            $request->session()->flash('error', 'Update failed.');
            return redirect()->route('admin.profMod',$id);//->with('success', 'Item updated successfully');
        }
    }

    public function profilUpdate(Request $request, $id)
    {    
        $request->validate([
            'prenom' => 'required',
            'nom' => 'required',
            'notell' => 'required',
            'email' => 'required|email'
        ]);


        $item = Prof::findOrFail($id);
        $user = User::findOrFail($item->userID);

        $item->prenom = $request->input('prenom');
        $item->nom = $request->input('nom');
        $item->tel = $request->input('notell');
        $user->email = $request->input('email');

        if(!empty($request->input('password'))){
            $request->validate([
                'password' => 'required|min:8'
            ]);
            $password = $request->input('password');
            $HashPass = bcrypt($password);
            $user->password = $HashPass;
        }

        $item->updated_at = now();
        $user->updated_at = now();
        $item->save();
        $user->save();

        if($item->save() && $user->save()){
            $request->session()->flash('success', 'Update successful.');
            return redirect()->back();
        }else{
            $request->session()->flash('error', 'Update failed.');
            return redirect()->back();
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
        //
    }
}
