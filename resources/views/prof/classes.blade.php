@extends('prof.layouts.app')

@section('title', 'Classes')

@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('prof')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Classes</li>
  </ol>
@endsection
 

@section('content')

  <div class="row">
    <div class="col-12 mb-3">
        <div class="card recent-sales overflow-auto">
              

            <div class="card-body">
                <h4 class="card-title">Classes</h4>
                @foreach ($classes as $classe)
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{route('classe.show', $classe->idClasse)}}">
                            <h6 class="card-subtitle mb-2">{{$classe->Nom_classe}}</h6>
                        </a>
                        <h6 class="card-subtitle mb-2 text-muted">{{$prof->prenom}} {{$prof->nom}}</h6>
                    </div>
                    <h6 class="card-subtitle mb-2 text-muted">{{$classe->Nom_formation}}</h6>
                    <div class="card-text">{{$classe->description}}</div>

                    
                @endforeach
            </div>
            
        </div>
    </div>
  </div>

@endsection
