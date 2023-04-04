@extends('admin.layouts.app')

@section('title', 'Ajouter une Formation')
@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('formation.show')}}">Formation</a></li>
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
        <form action="{{route('formation.store')}}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Nom</span>
                <input type="text" name="nom-formation" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Nom de Formation" required>
            </div> 

            <div class="form-group mb-3">
                <label for="exampleFormControlTextarea1" class="mb-3">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Sauvegarder</button>
                <a href="{{route('formation.show')}}" class="btn btn-danger">Retour</a>
            </div>
        </form>
    </div>
    
@endsection