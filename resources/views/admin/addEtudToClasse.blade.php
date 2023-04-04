@extends('admin.layouts.app')

@section('title', 'Classe')
@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"> {{$classe->Nom_classe}} </li>
  </ol>
@endsection

@section('content')
    
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header p-3" style="background-color: var(--bs-success-bg-subtle);">
                        <h5 class="card-title">{{$classe->Nom_classe}}</h5>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">Prof : {{$classe->prof->prenom}} {{$classe->prof->nom}}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">Formation : {{$classe->formation->Nom_formation}}</h6>
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Description : </h6>
                        <p class="card-text">{{$classe->description}}</p>
                        <hr>
                        <div class="table-responsive">
                            <!--<a href=""><button type="submit" class="btn btn-danger mb-3">Supprimer</button></a>-->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($etudClass as $EC)
                                        
                                    <tr>
                                        <td>
                                            <form action="{{route('classe.deleteEtud', [ $EC->id , $classe->idClasse] )}}" method="post">
                                                @csrf       
                                                <button type="submit" style="border-style: none;background-color: #FA8072;"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                        <td>{{$EC->id}}</td>
                                        <td>{{$EC->prenom}}</td>
                                        <td>{{$EC->nom}}</td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 card p-3 d-md-block">
                <form action="{{route('classe.storeEtud', $classe->idClasse)}}" method="post">
                @csrf
                    <a href=""><button type="submit" class="btn btn-success mb-3">Ajouter</button></a>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped dt-responsive nowrap">
                        <thead>
                            <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                @foreach ($etuds as $etud)
                                    <tr>
                                        <td><input type="checkbox" name="etud[]" value="{{ $etud->id }}"></td>
                                        <td>{{$etud->id}}</td>
                                        <td>{{$etud->prenom}}</td>
                                        <td>{{$etud->nom}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="col-lg-8 mb-3 p-3 d-md-block">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Seances</h5>

                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                            <li class="nav-item" role="presentation">
                            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="false" tabindex="-1">Seances</button>
                            </li>
                            <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Ajouter</button>
                            </li>
                            <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">les Seances Passee</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="borderedTabContent">
                            <div class="tab-pane fade" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                            @foreach ($seances as $seance)
                                
                            <hr>
                            <h5 class="card-title">#{{$seance->idSeance}} : {{$seance->name}}</h5>
                            <br>
                            <h6 class="card-subtitle mb-2 text-muted">Emplois : {{$seance->Sdate}} {{$seance->Stime}}</h6>
                            
                            @endforeach
                            </div>
                            <div class="tab-pane fade active show p-3" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">

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

                                    <!-- No Labels Form -->
                                    <form action="{{route('Seance.store')}}" method="POST" class="row g-3">
                                        @csrf
                                        <input type="hidden" name="idClasse" value="{{$classe->idClasse}}">
                                        <div class="col-md-12">
                                        <input type="text" class="form-control" placeholder="Nom" name="nom">
                                        </div>
                                        <div class="col-md-6">
                                        <input type="date" class="form-control" name="date">
                                        </div>
                                        <div class="col-md-6">
                                        <input type="time" class="form-control" id="myDatepicker" name="time">
                                        </div>
                                        
                                        <script>
                                            const today = new Date().toISOString().split('T')[0];
                                            document.getElementById("myDatepicker").setAttribute("min", today);
                                        </script>
                                        
                                        
                                        <div class="text-center">
                                        <button type="submit" class="btn btn-success">Ajouter</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        </div>
                                    </form><!-- End No Labels Form -->

                            </div>
                            <div class="tab-pane fade" id="bordered-contact" role="tabpanel" aria-labelledby="contact-tab">
                            @foreach ($seancesPassed as $seancePassed)
                                
                                <hr>
                                <h5 class="card-title">#{{$seancePassed->idSeance}} : {{$seancePassed->name}}</h5>
                                <br>
                                <h6 class="card-subtitle mb-2 text-muted">Emplois : {{$seancePassed->Sdate}} {{$seancePassed->Stime}}</h6>
                                
                                @endforeach
                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
                    </div>
                 </div>
            </div>
        </div>


    </section>

@endsection
