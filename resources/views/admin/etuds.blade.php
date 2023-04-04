@extends('admin.layouts.app')

@section('title', 'Etudiants')
@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Etudiants</li>
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
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Date Naissance</th>
                    <th>Niveau</th>
                    <th>Adresse</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($etuds as $etud)
                <tr>
                    <td>{{$etud->id}}</td>
                    <td>{{$etud->prenom}}</td>
                    <td>{{$etud->nom}}</td>
                    <td>{{$etud->bdate}}</td>
                    <td>{{$etud->niveau}}</td>
                    <td>{{$etud->adresse}}</td>
                    <td>{{$etud->email}}</td>
                    <td>
                        <a href="{{ route('etuds.etudsMod', $etud->id) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#myModal{{$etud->id}}">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                        <div class="modal fade" id="myModal{{$etud->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Supprimer</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Vous voulez vraiment Supprimer <b>{{$etud->prenom}} {{$etud->nom}} </b>?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('etuds.destroy', $etud->id) }}" method="POST">
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
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</main>

    
@endsection