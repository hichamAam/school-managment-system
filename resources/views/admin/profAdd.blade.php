@extends('admin.layouts.app')
@section('title', 'Ajouter Un Professeur')

@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.profs')}}">Profs</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ajouter Un Professeur</li>
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

@if (session('emailFail'))
    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
        Cette email déjà s'inscrit!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@section('content')
    <div class="container">
        <div class="card shadow p-3 m-3">
            <form action="{{route('prof.register')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Username</span>
                    <input type="text" name="username" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Username" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Nom Complet</span>
                    <input type="text" name="prenom" aria-label="First name" class="form-control" placeholder="Prenom" required>
                    <input type="text" name="nom" aria-label="Last name" class="form-control" placeholder="Nom" required>
                </div>  

                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
                    <input type="email" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="email@example.com" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mot de Passe</span>
                    <input type="password" name="password" id="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Mot de Passe" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Confirmer Mot de Passe</span>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Confirmer Mot de Passe" required>
                </div>


                <div class="text-center">
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </form> 
        </div>    
    </div>
@endsection