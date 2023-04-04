<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Etud;
use App\Models\User;
use App\Models\Prof;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function etudRegister(Request $request)
    {
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        $firstName = $request->input('prenom');
        $lastName = $request->input('nom');
        
        $emailCon = User::where('email', $email)->first();
        
        if($emailCon == null){
            // Hash password
            $hashedPassword = bcrypt($password);

            // Insérer des données dans la table des users
            $userId = DB::table('users')->insertGetId([
                'name' => $username,
                'email' => $email,
                'password' => $hashedPassword,
                'role' => 'etud',
                'updated_at' => now(),
                'created_at' => now()
            ]);

            // Insérer des données dans la table des etuds
            $result = DB::table('etuds')->insert([
                'userID' => $userId,
                'prenom' => $firstName,
                'nom' => $lastName,
                'bdate' => '2000-01-01',
                'updated_at' => now(),
                'created_at' => now()
            ]);

            if($result){
                
                $request->session()->flash('success', 'Bien Ajouter.');
                return redirect()->route('admin.etudAdd');//->with('success', 'Item updated successfully');
            }else{
                $request->session()->flash('error', 'N\'est pas Ajouter.');
                return redirect()->route('admin.etudAdd');//->with('success', 'Item updated successfully');
            }
        }else{
            $request->session()->flash('emailFail', 'Cette email déjà s\'inscrit!');
            return redirect()->route('admin.etudAdd');
        }
    }
    public function profRegister(Request $request)
    {
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        $firstName = $request->input('prenom');
        $lastName = $request->input('nom');
        
        $emailCon = User::where('email', $email)->first();
        
        if($emailCon == null){
    
            // Hash password
            $hashedPassword = bcrypt($password);

            // Insert data into users table
            $userId = DB::table('users')->insertGetId([
                'name' => $username,
                'email' => $email,
                'password' => $hashedPassword,
                'role' => 'prof',
                'updated_at' => now(),
                'created_at' => now()
            ]);

            // Insert data into etuds table
            $result = DB::table('profs')->insert([
                'userID' => $userId,
                'prenom' => $firstName,
                'nom' => $lastName,
                'tel' => '0612345678',
                'updated_at' => now(),
                'created_at' => now()
            ]);

            if($result){
                
                $request->session()->flash('success', 'Bien Ajouter.');
                return redirect()->route('admin.profAdd');//->with('success', 'Item updated successfully');
            }else{
                $request->session()->flash('error', 'N\'est pas Ajouter.');
                return redirect()->route('admin.profAdd');//->with('success', 'Item updated successfully');
            }

        }else{
            $request->session()->flash('emailFail', 'Cette email déjà s\'inscrit!');
            return redirect()->route('admin.etudAdd');
        }
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
    public function destroyEtud($id)
    {
        $etud = Etud::findOrFail($id);
        $user = User::findOrFail($etud->userID);
        $user->delete();

        return redirect()->route('admin.etuds')->with('success', 'Student deleted successfully!');
    }
    public function destroyProf($id)
    {
        $prof = Prof::findOrFail($id);
        $user = User::findOrFail($prof->userID);
        $user->delete();

        return redirect()->route('admin.profs')->with('success', 'Student deleted successfully!');
    }
}
