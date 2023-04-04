<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
   

    public function login(){
        if (Auth::check()) {
            $role = session('role');
            switch ($role) {
                case 'etud':
                    return redirect()->route('etud');
                case 'prof':
                    return redirect()->route('prof');
                case 'admin':
                    return redirect()->route('admin');
                default:
                    return '/';
            }
        } else {
            return view('auth.login');
        }
    }


    public function authenticate(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if(auth()->attempt($request->only('email','password'), $request->has('remember'))){
    
            $role = Auth::user()->role;
            $id = Auth::user()->id;
        
            $data = $request->input();
            $request->session()->put('userID',$id);  
            $request->session()->put('role',$role);  
        
            switch ($role) {
                case 'etud':
                    return redirect()->route('etud');
                case 'prof':
                    return redirect()->route('prof');
                case 'admin':
                    return redirect()->route('admin');
                default:
                    return '/';
            }
            
        }else{
            $request->session()->flash('FailLogin', 'les informations incorrect!');
            return redirect()->back();;
        }
    }
    

    public function logout(){

        session()->pull('id');
        session()->pull('role');
        auth()->logout();
        return redirect()->route('login');
    }
}
