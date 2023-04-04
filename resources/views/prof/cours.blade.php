@extends('prof.layouts.app')

@section('title', 'Coures')

@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('prof')}}">Home</a> </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        . / Coures
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{route('cours.index')}}">Tous les Coures</a></li>
          <li><a class="dropdown-item" href="{{route('cours.create')}}">Ajouter</a></li>
        </ul>
      </li>
  </ol>
@endsection

@section('content')

<main class="main">
    <div class="pagetitle">
    </div>
    
    <div class="card shadow p-4">
        <table id="example" class="table table-striped dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Classe</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($cours as $coure)
                <tr>
                    <td>{{$coure->idCours}}</td>
                    <td>{{$coure->name}}</td>
                    <td>{{$coure->Nom_classe}}</td>
                    <td><a href="{{route('cours.show', $coure->idCours)}}">view</a></td>
                    <td>
                       <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#myModal{{$coure->idCours}}">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </td>
                </tr>

                <div class="modal fade" id="myModal{{$coure->idCours}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Supprimer</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Vous voulez vraiment Supprimer <b>{{$coure->name}}</b>?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{route('cours.destroy', $coure->idCours)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Supprimer
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>  
            @endforeach
            </tbody>
        </table>
    </div>

</main>

@endsection
