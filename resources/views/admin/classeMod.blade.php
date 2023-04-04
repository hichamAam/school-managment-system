@extends('admin.layouts.app')

@section('title', 'Modifier une Classes')
@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('Classe.index')}}">Classes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modifier</li>
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
        <form action="{{route('Classe.update', $classe->idClasse)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Nom</span>
                <input type="text" name="Nom_classe" value="{{$classe->Nom_classe}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Nom de Classe" required>
            </div> 

            <div class="row">
                <div class="col">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Formation</label>
                        <select class="form-select" id="inputGroupSelect01" name="idFormation">
                        <option value="{{$formationSelected->idFormation}}">{{$formationSelected->Nom_formation}}</option>
                        @foreach ($formations as $formation)
                            <option value="{{$formation->idFormation}}">{{$formation->Nom_formation}}</option>
                        @endforeach  
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Professeur</label>
                        <select class="form-select" id="inputGroupSelect01" name="idProf">
                            <option selected value="{{$profSelected->id}}">{{$profSelected->prenom}} {{$profSelected->nom}}</option>
                            @foreach ($profs as $prof)
                                <option value="{{$prof->id}}">{{$prof->prenom}} {{$prof->nom}}</option>
                            @endforeach  
                        </select>
                    </div>
                </div>
            </div>




            <div class="form-group mb-3">
                <label for="exampleFormControlTextarea1" class="mb-3">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description"></textarea>
            </div>

            <script>
                var myTextarea = document.getElementById("exampleFormControlTextarea1");
                var textareaValue = myTextarea.innerHTML; // get the value
                myTextarea.innerHTML = "{{$classe->description}}"; // set the value
            </script>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Sauvegarder</button>
                <a href="{{route('Classe.index')}}" class="btn btn-danger">Retour</a>
            </div>
        </form>
    </div>
    
@endsection