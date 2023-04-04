@extends('admin.layouts.app')

@section('title', 'Etudiants')
@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.etuds')}}">Etudiants</a></li>
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
        <form action="{{ route('etud.update', ['id' => $etud->id]) }}" method="POST">
        @csrf
        @method('PUT')
            <div class="row mb-3">
            <label for="company" class="col-md-4 col-lg-3 col-form-label">Identifiant</label>
            <div class="col-md-8 col-lg-9">
                <input name="idEtud" type="text" class="form-control" value="{{$etud->id}}" readonly>
            </div>
            </div>

            <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nom Complet</label>
            <div class="col-md-8 col-lg-9">
                <div class="input-group mb-3">
                    <input type="text" aria-label="Last name" class="form-control" name="prenom" placeholder="Prenom" value="{{$etud->prenom}}" require>
                    <input type="text" aria-label="First name" class="form-control" name="nom" placeholder="Nom" value="{{$etud->nom}}" require>
                </div>
            </div>
            </div>

            <div class="row mb-3">
            <label for="company" class="col-md-4 col-lg-3 col-form-label">Date de Naissance</label>
            <div class="col-md-8 col-lg-9">
                <input name="bdate" type="date" class="form-control" id="company" value="{{$etud->bdate}}">
            </div>
            </div>

            <div class="row mb-3">
            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Niveau</label>
            <div class="col-md-8 col-lg-9">
                <select class="form-control" name="niveau">
                    <option value="{{$etud->niveau}}">{{$etud->niveau}}</option>
                    <option value="2 BAC">2 BAC</option>
                    <option value="1 BAC">1 BAC</option>
                    <option value="Troncs ommuns">Troncs ommuns</option>
                    <option value="3ème College">3ème College</option>
                    <option value="2ème college">2ème college</option>
                    <option value="1ème college">1ème college</option>
                    <option value="Primaire">Primaire</option>
                </select>
            </div>
            </div>

        
            <div class="row mb-3">
            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
            <div class="col-md-8 col-lg-9">
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="adresse" value="{{$etud->adresse}}" require>
            </div>
            </div>

            <div class="row mb-3">
            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Téléphone</label>
            <div class="col-md-8 col-lg-9">
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="notell" value="{{$etud->tel}}" require>
            </div>
            </div>

            <div class="row mb-3">
            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
            <div class="col-md-8 col-lg-9">
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="email" value="{{$etud->email}}" readonly require>
            </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Sauvegarder</button>
                <a href="{{route('admin.etuds')}}" class="btn btn-danger">Annuler</a>
            </div>
        </form>
    </div>
    
@endsection