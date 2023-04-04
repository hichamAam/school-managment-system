@extends('etud.layouts.app')

@section('title', 'Classes')

@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('etud')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Seances</li>
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
                            <th>Classe</th>
                            <th>Seance</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Prof</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($seances as $seance)
                        
                        <tr>
                            <td>
                                <a href="{{route('Etud.classeShow', $seance->idClasse)}}">
                                    {{$seance->Nom_classe}}
                                </a>
                            </td>
                            <td>{{$seance->name}}</td>
                            <td>{{$seance->Sdate}}</td>
                            <td>{{$seance->Stime}}</td>
                            <td>{{$seance->prenom}} {{$seance->nom}}</td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
  </div>

@endsection
