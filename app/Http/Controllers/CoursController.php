<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->has('role') && session('role') == "prof"){

            $cours = Course::select('*')
            ->join('classes', 'courses.idClasse', '=', 'classes.idClasse')
            ->join('profs', 'courses.idProf', '=', 'profs.id')
            ->get();

            return view('prof.cours', [
                'cours' => $cours
            ]);
        }else{
            return redirect('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(session()->has('role') && session('role') == "prof"){

            $idProf = DB::table('profs')->select('id')->where('userID', '=', session('userID'))->first()->id;
            $classes = DB::table('classes')
            ->join('formations', 'classes.idFormation', '=', 'formations.idFormation')
            ->select('*')
            ->where('idProf', '=', $idProf)
            ->get();

            return view('prof.coursAdd', [
                'classes' => $classes
            ]);
        }else{
            return redirect('login');
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
        $request->validate([
            'name' => 'required',
            'idClasse' => 'required',
            'file' => 'required|mimes:pdf' // validate the file type and size
        ]);
        
        $idProf = DB::table('profs')->select('id')->where('userID', '=', session('userID'))->first()->id;

        $cours = new Course();
        $cours->name = $request->name;
        $cours->idClasse = $request->idClasse;
        $cours->idProf = $idProf;

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName(); // generate a unique filename

        $path = $file->storeAs('public/Courses', $filename); // store the file in the 'public/Courses' directory

        $cours->path = 'public/Courses/' . $filename; // update the path to be relative to the 'public' directory
        $cours->save();

        
        if($cours->save()){
            $request->session()->flash('success', 'Bien Ajouter.');
            return redirect()->back();
        }else{
            $request->session()->flash('error', 'N\'est pas Ajouter.');
            return redirect()->back(); 
        }
        
        //return redirect()->back()->with('success', 'PDF uploaded successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(session()->has('role') && (session('role') == "prof" || session('role') == "etud" ) ){
            
            
            $pdf = DB::table('courses')->where('idCours', $id)->first();
            
            $filePath = storage_path('app/' . $pdf->path);

            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $pdf->name . '"'
            ]);

        }else{
            return redirect('login');
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
    public function destroy($id)
    {
        $cours = Course::where('idCours', $id)->first();
        if($cours == null){
            abort(404);
        }else{
            $cours->delete();
            return redirect()->back();
        }
        
    }
}
