<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\EtudController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\AbsenceController;
use Illuminate\Support\Facades\Redis;
use SocketIO\SocketIO;

$server = new SocketIO(8080);



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Authentification

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin');
        } elseif (Auth::user()->role == 'prof') {
            return redirect()->route('prof');
        } else {
            return redirect()->route('etud');
        }
    } else {
        return view('auth.login');
    }
})->name('home');

route::get('/login', [authController::class, 'login'])->name('login');
route::post('authenticate', [authController::class, 'authenticate'])->name('authenticate');
route::post('logout', [authController::class, 'logout'])->name('logout');

// End Ahtuentification
// Admin Panel

route::get('/home', [AdminController::class, 'index'])->name('admin');
route::get('/admin/profil', [AdminController::class, 'profil'])->name('admin.profil');
route::get('/admin/edit/', [AdminController::class, 'edit'])->name('admin.edit');
route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
route::get('/admin/All', [AdminController::class, 'allAdmin'])->name('admin.all');
route::post('/admin/Store', [AdminController::class, 'store'])->name('admin.store');
route::delete('/admin/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

route::get('/admin/etuds', [AdminController::class, 'etuds'])->name('admin.etuds');
route::get('/admin/etud/Add', [AdminController::class, 'etudAdd'])->name('admin.etudAdd');
route::get('/etuds/etudsMod/{id}', [AdminController::class, 'etudsMod'])->name('etuds.etudsMod');
Route::put('/etud/{id}',  [EtudController::class, 'update'])->name('etud.update');
Route::delete('/etuds/{id}', [UserController::class, 'destroyEtud'])->name('etuds.destroy');
Route::post('/register', [UserController::class, 'etudRegister'])->name('etud.register');

route::get('/admin/profs', [AdminController::class, 'profs'])->name('admin.profs');
route::get('/prof/add', [AdminController::class, 'profAdd'])->name('admin.profAdd');
route::get('/prof/update/{id}', [AdminController::class, 'profMod'])->name('admin.profMod');
route::put('/profs/profupdate/{id}', [ProfController::class, 'update'])->name('prof.update');
route::delete('/profs/Delete/{id}', [UserController::class, 'destroyProf'])->name('prof.destroy'); 
route::post('/profs', [UserController::class, 'profRegister'])->name('prof.register');


route::get('/formation',[FormationController::class, 'index'])->name('formation.show')->middleware('auth');
route::get('/formation/add',[FormationController::class, 'create'])->name('formation.add')->middleware('auth');
route::post('/formation/store',[FormationController::class, 'store'])->name('formation.store')->middleware('auth');
route::get('/formation/edit/{formation}',[FormationController::class, 'edit'])->name('formation.edit')->middleware('auth');
route::put('/formation/update/{formation}',[FormationController::class, 'update'])->name('formation.update')->middleware('auth');
route::delete('/formation/Delete/{id}',[FormationController::class, 'destroy'])->name('formation.destroy')->middleware('auth');

route::get('/Classe',[ClasseController::class, 'index'])->name('Classe.index')->middleware('auth');
route::get('/Classe/show/{id}',[ClasseController::class, 'show'])->name('Classe.show')->middleware('auth');
route::get('/Classe/add',[ClasseController::class, 'create'])->name('Classe.add')->middleware('auth');
route::post('/Classe/store',[ClasseController::class, 'store'])->name('Classe.store')->middleware('auth');
route::get('/Classe/edit/{Classe}',[ClasseController::class, 'edit'])->name('Classe.edit')->middleware('auth');
route::put('/Classe/update/{Classe}',[ClasseController::class, 'update'])->name('Classe.update')->middleware('auth');
route::delete('/Classe/Delete/{classe}',[ClasseController::class, 'destroy'])->name('Classe.destroy')->middleware('auth');
route::get('/Classe/Add/etuds/{id}', [ClasseController::class, 'addEtudClass'])->name('classe.addetud')->middleware('auth');
route::post('/Classe/Store/etuds/{id}', [ClasseController::class, 'StoreEtudClass'])->name('classe.storeEtud')->middleware('auth');
route::post('/Classe/delete/etuds/{idEtud}{idClass}', [ClasseController::class, 'deleteEtudClass'])->name('classe.deleteEtud')->middleware('auth');

route::get('/annonce',[AnnonceController::class, 'index'])->name('annonce.index')->middleware('auth');
route::get('/annonce/show/{id}',[AnnonceController::class, 'show'])->name('annonce.show')->middleware('auth');
route::get('/annonce/add',[AnnonceController::class, 'create'])->name('annonce.add')->middleware('auth');
route::post('/annonce/store',[AnnonceController::class, 'store'])->name('annonce.store')->middleware('auth');
route::get('/annonce/edit/{annonce}',[AnnonceController::class, 'edit'])->name('annonce.edit')->middleware('auth');
route::put('/annonce/update/{annonce}',[AnnonceController::class, 'update'])->name('annonce.update')->middleware('auth');
route::delete('/annonce/Delete/{annonce}',[AnnonceController::class, 'destroy'])->name('annonce.destroy')->middleware('auth');

//route::get('/Seance/add',[SeanceController::class, 'create'])->name('Seance.add')->middleware('auth');
route::post('/Seance/store',[SeanceController::class, 'store'])->name('Seance.store')->middleware('auth');
route::get('/Seance/edit/{Seance}',[SeanceController::class, 'edit'])->name('Seance.edit')->middleware('auth');
route::put('/Seance/update/{Seance}',[SeanceController::class, 'update'])->name('Seance.update')->middleware('auth');
route::delete('/Seance/Delete/{Seance}',[SeanceController::class, 'destroy'])->name('Seance.destroy')->middleware('auth');



// End Admin Panel






route::get('prof', [ProfController::class, 'index'])->name('prof')->middleware('auth');
route::get('prof/Classes', [ProfController::class, 'classes'])->name('prof.classes')->middleware('auth');
route::get('prof/seances', [ProfController::class, 'seances'])->name('prof.seances')->middleware('auth');
route::get('prof/cours', [ProfController::class, 'cours'])->name('prof.cours')->middleware('auth');
route::get('prof/profil', [ProfController::class, 'profil'])->name('prof.profil')->middleware('auth');
route::get('prof/edit', [ProfController::class, 'edit'])->name('prof.edit')->middleware('auth');
route::put('prof/update/{id}', [ProfController::class, 'profilUpdate'])->name('prof.update')->middleware('auth');

route::get('Cours/', [CoursController::class, 'index'])->name('cours.index')->middleware('auth');
route::get('Prof/cours/add', [CoursController::class, 'create'])->name('cours.create')->middleware('auth');
route::post('Prof/cours/store', [CoursController::class, 'store'])->name('cours.store')->middleware('auth');
route::delete('Prof/cours/destroy/{id}', [CoursController::class, 'destroy'])->name('cours.destroy')->middleware('auth');

route::get('Prof/show/{id}', [CoursController::class, 'show'])->name('cours.show')->middleware('auth');
route::get('Prof/Classe/{id}', [ClasseController::class, 'show'])->name('classe.show')->middleware('auth');

route::get('Prof/Absence/{id}', [AbsenceController::class, 'show'])->name('absence.show')->middleware('auth');
route::post('Prof/Absence/store/{idSeance}', [AbsenceController::class, 'store'])->name('absence.store')->middleware('auth');
 
route::delete('Prof/AbsenceDel/{idSeance}/{idEtud}', [AbsenceController::class, 'destroy'])->name('absence.destroy')->middleware('auth');





route::get('Etud', [EtudController::class, 'index'])->name('etud')->middleware('auth');
route::get('Etud/Classes/', [EtudController::class, 'classes'])->name('Etud.classes')->middleware('auth');
route::get('Etud/Classes/show/{id}', [EtudController::class, 'classeShow'])->name('Etud.classeShow')->middleware('auth');

route::get('Etud/seances', [EtudController::class, 'seances'])->name('Etud.seances')->middleware('auth');
route::get('Etud/cours', [EtudController::class, 'cours'])->name('Etud.cours')->middleware('auth');
route::get('Etud/edit', [EtudController::class, 'edit'])->name('Etud.edit')->middleware('auth');
route::get('Etud/profil', [EtudController::class, 'profil'])->name('Etud.profil')->middleware('auth');


