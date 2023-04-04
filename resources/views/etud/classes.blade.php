@extends('etud.layouts.app')

@section('title', 'Home')

@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('etud')}}">Home</a></li>
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
                        <a href="{{route('Etud.classeShow', $classe->idClasse)}}">
                            <h6 class="card-subtitle mb-2">{{$classe->Nom_classe}}</h6>
                        </a>
                        <h6 class="card-subtitle mb-2 text-muted">{{$classe->prenom}} {{$classe->nom}}</h6>
                    </div>
                    <h6 class="card-subtitle mb-2 text-muted">{{$classe->Nom_formation}}</h6>
                    <div class="card-text">{{$classe->description}}</div>

                    
                @endforeach
            </div>
            
        </div>
    </div>
  </div>


  @endsection
