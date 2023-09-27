<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\models\Admin;
use App\models\User;
use App\models\Classe;
use App\models\Etud;
use App\models\Prof;
use App\models\Formation;
use App\models\Annonce;


class AdminController extends Controller
{
    public function index()
    {
        if(session()->has('role') && session('role') == "admin"){
            
            $classes = Classe::with(['formation', 'prof'])->get();
            $seances = DB::table('seances')
            ->select('*')
            ->join('classes','seances.idClasse','=','classes.idClasse')
            ->join('profs','classes.idProf','=','profs.id')
            ->join('formations','classes.idFormation','=','formations.idFormation')
            ->get();

            $startDate = now()->subDays(3);
            $endDate = now();
            $NewEtud = Etud::whereBetween('created_at', [$startDate, $endDate])->count();
            $newprofs = Prof::whereBetween('created_at', [$startDate, $endDate])->count();
            $newFormation = Formation::whereBetween('created_at', [$startDate, $endDate])->count();
            $AllEtuds = Etud::count();
            $allprofs = Prof::count();
            $allFormation = Formation::count();
            $annonces = Annonce::select('*')->get();



            return view('admin.index', [
                'classes' => $classes,
                'seances' => $seances,
                'numetuds' => $NewEtud,
                'alletuds' => $AllEtuds,
                'allprofs' => $allprofs,
                'newprofs' => $newprofs,
                'allFormation' => $allFormation,
                'newFormation' => $newFormation,
                'annonces' => $annonces
            ]);
        }else{
            return redirect()->route('login');
        }  
    }

    public function allAdmin(){
        if(session()->has('role') && session('role') == "admin"){
            $admins = Admin::select('admins.prenom', 'admins.nom', 'admins.id', 'admins.tel', 'users.email' )
            ->join('users','admins.userID', '=', 'users.id' )
            ->get();
            return view('admin.admin', ['admins' => $admins] );
        }else{
            return redirect()->route('login');
        } 
    }

    public function etuds(){
        if(session()->has('role') && session('role') == "admin"){
            $etuds = DB::table('etuds')
            ->join('users', 'etuds.userID', '=', 'users.id')
            ->select('etuds.*', 'users.email')
            ->get();
            return view('admin.etuds', ['etuds' => $etuds]);
        }else{
            return redirect()->route('login');
        } 
    }
    
    public function etudsMod($id){
        if(session()->has('role') && session('role') == "admin"){
            $etud = DB::table('etuds')
            ->join('users', 'etuds.userID', '=', 'users.id')
            ->select('etuds.*', 'users.email')
            ->where('etuds.id', '=', $id)
            ->first();
            if($etud == null ){
                abort(404);
            }else {
                return view('admin.etudsMod', ['etud' => $etud]);
            }
        }else{
            return redirect()->route('login');
        } 
    }

    public function etudAdd(){
        if(session()->has('role') && session('role') == "admin"){
            return view('admin.etudAdd');
        }else{
            return redirect()->route('login');
        } 
    }



    public function profs(){
        if(session()->has('role') && session('role') == "admin"){
            $profs = DB::table('profs')
            ->join('users', 'profs.userID', '=', 'users.id')
            ->select('profs.*', 'users.email')
            ->get();
            return view('admin.profs', ['profs' => $profs]);
        }else{
            return redirect()->route('login');
        }
    }
    public function profAdd(){
        if(session()->has('role') && session('role') == "admin"){
            return view('admin.profAdd');
        }else{
            return redirect()->route('login');
        } 
    }
    public function profMod($id){
        if(session()->has('role') && session('role') == "admin"){
            $prof = DB::table('profs')
            ->join('users', 'profs.userID', '=', 'users.id')
            ->select('profs.*', 'users.email')
            ->where('profs.id', '=', $id)
            ->first();
            return view('admin.profMod', ['prof' => $prof]);
        }else{
            return redirect()->route('login');
        } 
    }
    
    public function profil(){
        if(session()->has('role') && session('role') == "admin"){ 

            $id = session('userID');
            $admin = Admin::join('users', 'admins.userID', '=', 'users.id')
            ->where('admins.userID', '=', $id)
            ->select('*')
            ->first();

            return view('admin.profil',['admin' => $admin]);
        }else{
            return redirect()->route('login');
        } 
    }

    


    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'prenom' => 'required',
            'username' => 'required',
            'nom' => 'required',
            'tel' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        
        $emailCon = User::where('email', $request->input('email'))->first();
        
        if($emailCon == null){
        
        $admin = new Admin();
        $adminUser = new User();

        

            $adminUser->name = $request->input('username'); 
            $adminUser->email = $request->input('email'); 
            $adminUser->password = bcrypt($request->input('password'));
            $adminUser->role = 'admin';
            $adminUser->created_at = now();
            $adminUser->updated_at = now();
            $adminUser->save();

            $admin->prenom = $request->input('prenom');
            $admin->nom = $request->input('nom');
            $admin->tel = $request->input('tel');
            $admin->userID = $adminUser->id;
            $admin->created_at = now();
            $admin->updated_at = now();
            $admin->save();

            if($adminUser->save() && $admin->save()){
                $request->session()->flash('success', 'Bien Ajouter');
                return redirect()->route('admin.all');
            }else{
                $request->session()->flash('error', 'Bien Ajouter');
                return redirect()->route('admin.all');
            }

        }else{
            $request->session()->flash('emailFail', 'Cette email déjà s\'inscrit!');
            return redirect()->route('admin.etudAdd');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if(session()->has('role') && session('role') == "admin"){ 

            $id = session('userID');
            $admin = Admin::join('users', 'admins.userID', '=', 'users.id')
            ->where('admins.userID', '=', $id)
            ->select('*')
            ->first();

            return view('admin.adminMod',['admin' => $admin]);
        }else{
            return redirect()->route('login');
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
        $request->validate([
            'prenom' => 'required',
            'nom' => 'required',
            'notell' => 'required',
            'email' => 'required|email'
        ]);

        $item = Admin::findOrFail($id);
        $user = User::findOrFail($item->userID);

        $item->prenom = $request->input('prenom');
        $item->nom = $request->input('nom');
        $item->tel = $request->input('notell');
        $item->updated_at = now();
        $user->email = $request->input('email');
        $user->updated_at = now();

        if(!empty($request->input('password'))){
            $request->validate([
                'password' => 'required|min:8'
            ]);
            $password = $request->input('password');
            $HashPass = bcrypt($password);
            $user->password = $HashPass;
        }

        $item->save();
        $user->save();

        if($item->save() && $user->save()){
            $request->session()->flash('success', 'Update successful.');
            return redirect()->route('admin.edit');//->with('success', 'Item updated successfully');
        }else{
            $request->session()->flash('error', 'Update failed.');
            return redirect()->route('admin.edit');//->with('success', 'Item updated successfully');
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
        $admin = Admin::FindOrFail($id);
        if($admin == null){
            abort(404);
        }else{
            $user = User::FindOrFail($admin->userID);
            $user->delete();
            return redirect()->back();
        }
    }
}
