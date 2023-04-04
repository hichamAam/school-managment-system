@extends('admin.layouts.app')

@section('title', ucfirst($prof->prenom).' '.ucfirst($prof->nom))
@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.profs')}}">Profs</a></li>
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
        <form action="{{ route('prof.update', ['id' => $prof->id]) }}" method="POST">
        @csrf
        @method('PUT')
            <div class="row mb-3">
            <label for="company" class="col-md-4 col-lg-3 col-form-label">Identifiant</label>
            <div class="col-md-8 col-lg-9">
                <input name="id" type="text" class="form-control" value="{{$prof->id}}" readonly>
            </div>
            </div>

            <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nom Complet</label>
            <div class="col-md-8 col-lg-9">
                <div class="input-group mb-3">
                    <input type="text" aria-label="Last name" class="form-control" name="prenom" placeholder="Prenom" value="{{$prof->prenom}}" require>
                    <input type="text" aria-label="First name" class="form-control" name="nom" placeholder="Nom" value="{{$prof->nom}}" require>
                </div>
            </div>
            </div>
            
            <div class="row mb-3">
            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Téléphone</label>
            <div class="col-md-8 col-lg-9">
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="notell" value="{{$prof->tel}}" require>
            </div>
            </div>

            <div class="row mb-3">
            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
            <div class="col-md-8 col-lg-9">
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="email" value="{{$prof->email}}" readonly require>
            </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Sauvegarder</button>
                <a href="{{route('admin.profs')}}" class="btn btn-danger">Retour</a>
            </div>
        </form>
    </div>
    
@endsection