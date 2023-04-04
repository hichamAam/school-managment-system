@extends('prof.layouts.app')

@section('title', 'Home')

@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Home /</li>
  </ol>
@endsection
 

@section('content')
 
  <div class="row">
    <div class="col-md-8">
      <div class="col-12 mb-3">
        <div class="card recent-sales overflow-auto" style="max-height: 500px;">
            <div class="card-body">
                <h4 class="card-title"><a href="{{route('prof.classes')}}">Classes</a></h4>
                @foreach ($classes as $classe)
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="{{route('classe.show', $classe->idClasse)}}">
                      <h6 class="card-subtitle mb-2">{{$classe->Nom_classe}}</h6>
                    </a>
                    <h6 class="card-subtitle mb-2 text-muted">{{$classe->prof->prenom}} {{$classe->prof->nom}}</h6>
                </div>
                <h6 class="card-subtitle mb-2 text-muted">{{$classe->formation->Nom_formation}}</h6>
                <div class="card-text">{{$classe->description}}</div>
                @endforeach
              </div>
          </div>
        </div>
        <div class="card top-selling overflow-auto mb-3" style="height: 500px">


          <div class="card-body pb-0">
            <h5 class="card-title">Annonces </h5>

            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Titre</th>
                  <th scope="col">Sujet</th>
                  <th scope="col">Date</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($annonces as $annonce)
                    
                <tr>
                    <td>{{$annonce->titre}}</td>
                    <td>{{$annonce->sujet}}</td>
                    <td>{{$annonce->created_at}}</td>
                </tr>
                
                @endforeach
              </tbody>
            </table>

          </div>

        </div>
      </div>
      <div class="col-md-4">
        <div class="card overflow-auto p-3 mb-3" style="height: 800px;">
          <h4 class="card-title">Seances</h4>
          
                   
                      @foreach ($seances as $seance)
                      <hr>
                      <div class="d-flex justify-content-between">
                          <a href="{{route('absence.show', $seance->idSeance)}}">
                              <h6 class="card-subtitle mb-2">{{$seance->name}}</h6>
                          </a>
                          <h6 class="card-subtitle mb-2 text-muted">{{$seance->prenom}} {{$seance->nom}}</h6>
                      </div>
                      <h6 class="card-subtitle mb-2 text-muted">{{$seance->Nom_formation}}</h6>
                      <h6 class="card-subtitle mb-2 text-muted">{{$seance->Sdate}} : {{$seance->Stime}}</h6>

                          
                      @endforeach
                  
        </div>
      </div>
  </div>

@endsection
