@extends('admin.layouts.app')

@section('title', 'Profs')
@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Profs</li>
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
                    <th>Phone</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($profs as $prof)
                <tr>
                    <td>{{$prof->id}}</td>
                    <td>{{$prof->prenom}}</td>
                    <td>{{$prof->nom}}</td>
                    <td>{{$prof->tel}}</td>
                    <td>{{$prof->email}}</td>
                    <td>
                        <a href="{{ route('admin.profMod', $prof->id) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#myModal{{$prof->id}}">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                        <div class="modal fade" id="myModal{{$prof->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Supprimer</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Vous voulez vraiment Supprimer <b>{{$prof->prenom}} {{$prof->nom}} </b>?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('prof.destroy', $prof->id) }}" method="POST">
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