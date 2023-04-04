@extends('etud.layouts.app')

@section('title', 'Classes')

@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('etud')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Cours</li>
  </ol>
@endsection
 

@section('content')

  <div class="row">
    <div class="col-12 mb-3">
        <div class="card recent-sales overflow-auto">
              

            <div class="card-body">
                <h4 class="card-title">Seances</h4>
                
                <table class="responsive table table-bordered">
                    <thead>
                        <tr>
                            <th>Cours</th>
                            <th>Classes</th>
                            <th>Prof</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cours as $course)
                        
                        <tr>
                            <td>{{$course->name}}</td>
                            <td>{{$course->Nom_classe}}</td>
                            <td>{{$course->prenom}} {{$course->nom}}</td>
                            <td>
                                <a href="{{route('cours.show', $course->idCours)}}">
                                    view
                                </a>
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
  </div>

@endsection
