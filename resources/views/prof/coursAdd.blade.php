@extends('prof.layouts.app')

@section('title', 'Cours')

@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('prof')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('cours.index')}}">Cours</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
  </ol>
@endsection
 

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@section('content')

<div class="container card shadow p-4" style="margin-bottom: 10px;">
        <form action="{{route('cours.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Nom</span>
                <input type="text" name="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Nom de Classe" required>
            </div> 


            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Classe</label>
                <select class="form-select" id="inputGroupSelect01" name="idClasse">
                    <option selected>Choisir...</option>
                    @foreach ($classes as $classe)
                        <option value="{{$classe->idClasse}}">{{$classe->Nom_classe}}</option>
                    @endforeach
                        
                </select>
            </div>
                
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="file" id="inputGroupFile02">
            </div>
              


            <div class="text-center">
                <button type="submit" class="btn btn-success">Sauvegarder</button>
                <a href="{{route('cours.index')}}" class="btn btn-danger">Retour</a>
            </div>
        </form>
    </div>
    
@endsection
