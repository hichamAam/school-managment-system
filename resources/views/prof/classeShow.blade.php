@extends('prof.layouts.app')

@section('title', $classe->Nom_classe)

@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('prof')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('prof.classes')}}">Classes</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$classe->Nom_classe}}</li>
  </ol>
@endsection

@section('content')
<section>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header p-3" style="background-color: var(--bs-success-bg-subtle);">
                    <h5 class="card-title">{{$classe->Nom_classe}}</h5>
                    <br>
                    <h6 class="card-subtitle mb-2 text-muted">Prof : {{$classe->prof->prenom}} {{$classe->prof->nom}}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">Formation : {{$classe->formation->Nom_formation}}</h6>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Description : </h6>
                    <p class="card-text">{{$classe->description}}</p>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Prénom</th>
                                <th>Nom</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($etudClass as $EC)
                                    
                                <tr>
                                    
                                    <td>{{$EC->id}}</td>
                                    <td>{{$EC->prenom}}</td>
                                    <td>{{$EC->nom}}</td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 card p-3 d-md-block">
                <h4 class="title">Seances</h4>
                <div class="table-responsive">
                    <table id="example" class="table table-striped dt-responsive nowrap">
                    <thead>
                        <tr>
                        <th>Nom</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Absense</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($seances as $seance)
                                
                            <tr>
                                <td>{{$seance->name}}</td>
                                <td>{{$seance->Sdate}}</td>
                                <td>{{$seance->Stime}}</td>
                                <td>
                                    <a href="{{route('absence.show', $seance->idSeance)}}">Absence</a>
                                </td>
                            </tr>
                            
                        @endforeach
                            
                        </tbody>
                    </table>
                </div>
        </div>
        
                    </div><!-- End Bordered Tabs -->

                </div>
                </div>
             </div>
        </div>
    </div>


</section>
@endsection