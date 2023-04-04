@extends('admin.layouts.app')

@section('title', 'Modifier une Annonce')
@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('annonce.index')}}">Annocnes</a></li>
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
        <form action="{{route('annonce.update', $annonce->idAnnonce)}}" method="POST">
            @csrf
            @method('put')

            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Titre</span>
                <input type="text" name="titre" value="{{$annonce->titre}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Titre d'annonce" required>
            </div> 

            <div class="form-group mb-3">
                <label for="exampleFormControlTextarea1" class="mb-3">Sujets</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="Sujet"></textarea>
            </div>

            <script>
                var myTextarea = document.getElementById("exampleFormControlTextarea1");
                var textareaValue = myTextarea.innerHTML; // get the value
                myTextarea.innerHTML = "{{$annonce->sujet}}"; // set the value
            </script>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Sauvegarder</button>
                <a href="{{route('annonce.index')}}" class="btn btn-danger">Retour</a>
            </div>
        </form>
    </div>
    
@endsection