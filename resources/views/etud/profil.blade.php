@extends('etud.layouts.app')
@section('title','Profil')

@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('etud')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Profil</li>
</ol>
@endsection

@section('content')

    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="my-3">{{$etud->prenom}} {{$etud->nom}}</h5>
                            <p class="text-muted mb-3"><b>@</b>{{$etud->name}} </p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="{{route('Etud.edit')}}"><button type="button" class="btn btn-outline-primary ms-1">Modifier</button></a>
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Nom Complet</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0" style="text-transform: capitalize;">{{$etud->prenom}} {{$etud->nom}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$etud->email}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$etud->tel}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>    
        </div>   
    </section>

    

@endsection