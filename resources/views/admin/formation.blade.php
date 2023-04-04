@extends('admin.layouts.app')

@section('title', 'Formations')
@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Formation</li>
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
                    <th>Nom</th>
                    <th>Decription</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($formations as $fromation)
                <tr>
                    <td>{{$fromation->idFormation}}</td>
                    <td>{{$fromation->Nom_formation}}</td>
                    <td class="text-wrap" style="width: 75%">{{$fromation->description}}</td>
                    <td>
                        <a href="{{ route('formation.edit', $fromation->idFormation) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                    </td>
                    <td>
                       <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#myModal{{$fromation->idFormation}}">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </td>
                </tr>

                <div class="modal fade" id="myModal{{$fromation->idFormation}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Supprimer</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Vous voulez vraiment Supprimer <b>{{$fromation->Nom_formation}}</b>?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('formation.destroy', $fromation->idFormation) }}" method="POST">
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