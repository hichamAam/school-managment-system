@extends('admin.layouts.app')

@section('title', 'Modifier une Formation')
@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('formation.show')}}">Formation</a></li>
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
        <form action="{{route('formation.update', $formation->idFormation)}}" method="POST">
        @csrf
        @method('PUT')
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Nom</span>
                <input type="text" name="nom-formation" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Nom de Formation" value="{{$formation->Nom_formation}}" required>
            </div> 


            <div class="form-group mb-3">
                <label for="exampleFormControlTextarea1" class="mb-3">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description" ></textarea>
            </div>
            
            <script>
                var myTextarea = document.getElementById("exampleFormControlTextarea1");
                var textareaValue = myTextarea.innerHTML; // get the value
                myTextarea.innerHTML = "{{$formation->description}}"; // set the value
            </script>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Sauvegarder</button>
                <a href="{{route('formation.show')}}" class="btn btn-danger">Roteur</a>
            </div>
        </form>
    </div>
@endsection