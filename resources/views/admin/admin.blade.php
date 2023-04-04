@extends('admin.layouts.app')
@section('title','Tableau de bord')

@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Admins</li>
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
    <div class="row">
      <div class="col-lg-6">
        <div class="card mb-4">
          <div class="card-header">
            Admins Table
          </div>
          <div class="card-body">
            <table class="table-responsive table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Prenom</th>
                  <th>Nom</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($admins as $admin)
                    
                <tr>
                  <td>{{$admin->id}}</td>
                  <td>{{$admin->prenom}}</td>
                  <td>{{$admin->nom}}</td>
                  <td>{{$admin->tel}}</td>
                  <td>{{$admin->email}}</td>
                  <td>
                    <form action="{{route('admin.destroy', $admin->id )}}" method="post">
                        @csrf       
                        @method('DELETE')
                        <button type="submit" style="border-style: none;background-color: #FA8072;"><i class="bi bi-trash"></i></button>
                    </form>
                  </td>
                </tr>
                
                @endforeach
                <!-- Add more rows here as needed -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card mb-4">
          <div class="card-header">
            Ajouter Admin
          </div>
          <div class="card-body">
            <form class="row g-3 needs-validation" novalidate method="post" action="{{route('admin.store')}}">
              @csrf
              <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Prenom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-4">
                <label for="validationCustom02" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-4">
                <label for="validationCustomUsername" class="form-label">Username</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend">@</span>
                  <input type="text" class="form-control" id="username" name="username" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please choose a username.
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <label for="validationCustom03" class="form-label">Phone</label>
                <input type="text" name="tel" class="form-control" id="phone" required>
                <div class="invalid-feedback">
                  Saisir un Valid Telephone !
                </div>
              </div>
              <div class="col-md-12">
                <label for="validationCustom03" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
                <div class="invalid-feedback">
                  Saisir un Valid Email !
                </div>
              </div>
              <div class="col-md-6">
                <label for="validationCustom04" class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" id="password" required>
                <div class="invalid-feedback">
                  
                </div>
              </div>
              <div class="col-md-6">
                <label for="validationCustom05" class="form-label">Confirmer Mot de Passe</label>
                <input type="password" class="form-control" id="password_confirmation" name="conpassword" required>
                <div class="invalid-feedback">
                  
                </div>
              </div>
              
              <div class="col-12">
                <button class="btn btn-success" type="submit">Ajouter</button>
              </div>
            </form>
          </div>
        </div>
       
      </div>
    </div>
  </div>

  
  
@endsection