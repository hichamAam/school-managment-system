@extends('prof.layouts.app')

@section('title', )

@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('prof')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('prof.classes')}}">Classes</a></li>
    <li class="breadcrumb-item active" aria-current="page">absence</li>
  </ol>
@endsection
 
@section('content')

<div class="row">
    <div class="col-md-8">    
        <div class="card">
            <div class="card-header p-3" style="background-color: var(--bs-success-bg-subtle);">
                <h5 class="card-title">{{$classe->Nom_classe}}</h5>
                <br>
                <h6 class="card-subtitle mb-2 text-muted">Seance : {{$seance->name}}</h6>
                <h6 class="card-subtitle mb-2 text-muted">Formation : {{$classe->Nom_formation}}</h6>
            </div>
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Description : </h6>
                <p class="card-text">{{$classe->description}}</p>
                <hr>
                <div class="table-responsive">
                    <form action="{{route('absence.store', $seance->idSeance)}}" method="post">
                        @csrf
                        <input type="hidden" name="seance_id" value="{{ $seance->idSeance }}">
                        <button type="submit" class="btn btn-success mb-3">Sauvegarder</button>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Absent</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @foreach ($etuds as $etud)
                                <tr>
                                    <td>{{$etud->id}}</td>
                                    <td>{{$etud->prenom}}</td>
                                    <td>{{$etud->nom}}</td>
                                    <td><input type="checkbox" name="etud[]" value="{{$etud->id}}"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                    
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h4 class="card-title">Les Absences</h4>
            <div class="card-body">
                <table class="responsive table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Prenom</th>
                            <th>Nom</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absents as $absent)
                        <tr>
                            <td>{{$absent->id}}</td>
                            <td>{{$absent->prenom}}</td>
                            <td>{{$absent->nom}}</td>
                            <td>
                                <form action="{{route('absence.destroy', [ $seance->idSeance , $absent->id] )}}" method="post">
                                    @csrf       
                                    @method('DELETE')
                                    <button type="submit" style="border-style: none;background-color: #FA8072;"><i class="bi bi-trash"></i></button>
                                </form>
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