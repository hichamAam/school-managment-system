@extends('etud.layouts.app')

@section('title', 'Home')

@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('etud')}}">Home</a></li>
  </ol>
@endsection

@section('content')

  <div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header p-3" style="background-color: var(--bs-success-bg-subtle);">
                <h5 class="card-title">{{$classe->Nom_classe}}</h5>
                <br>
                <h6 class="card-subtitle mb-2 text-muted">Prof : {{$classe->prenom}} {{$classe->nom}}</h6>
                <h6 class="card-subtitle mb-2 text-muted">Formation : {{$classe->Nom_formation}}</h6>
            </div>
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Description : </h6>
                <p class="card-text">{{$classe->description}}</p>
                <hr>
                
            </div>
        </div>
    </div>
    <div class="col-md-6 card p-3 bg-light">
        <h4 class="title">Seances</h4>
                <div class="table-responsive">
                    <table id="example" class="table table-striped dt-responsive nowrap">
                    <thead>
                        <tr>
                        <th>Nom</th>
                        <th>Date</th>
                        <th>Heure</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($seances as $seance)
                                
                            <tr>
                                <td>{{$seance->name}}</td>
                                <td>{{$seance->Sdate}}</td>
                                <td>{{$seance->Stime}}</td>
                            </tr>
                            
                        @endforeach
                            
                        </tbody>
                    </table>
                </div>
    </div>
  </div>

@endsection