@extends('admin.layouts.app')
@section('title','Home')

@section('navbar')
<ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Home /</li>
  </ol>
@endsection
 
@section('content')

<section class="section dashboard">
      <div class="row">

        <div class="col-lg-8">
          <div class="row">
          
              
              
              
            <div class="col-12 mb-3">
                <div class="card recent-sales overflow-auto" style="max-height: 400px;">
                      

                    <div class="card-body">
                        <h4 class="card-title">Classes</h4>
                        @foreach ($classes as $classe)
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="{{route('classe.addetud', $classe->idClasse)}}">
                                <h6 class="card-subtitle mb-2">{{$classe->Nom_classe}}</h6>
                            </a>
                            <h6 class="card-subtitle mb-2 text-muted">{{$classe->prof->prenom}} {{$classe->prof->nom}}</h6>
                        </div>
                        <h6 class="card-subtitle mb-2 text-muted">{{$classe->formation->Nom_formation}}</h6>
                        <div class="card-text">{{$classe->description}}</div>

                            
                        @endforeach
                    </div>
                    
                </div>
            </div>
    

    <div class="col-xxl-4 col-md-6 m-0 mb-3">
      <div class="card info-card sales-card">

        

        <div class="card-body">
          <h5 class="card-title">Etudiants </h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <img src="{{ url('img\studentsIcon.png') }}" style="width: auto;height: 40px;">
            </div>
            <div class="ps-3">
              <h6>{{$alletuds}}</h6>
              <span class="text-success small pt-1 fw-bold">{{$numetuds}}</span> <span class="text-muted small pt-2 ps-1">Nouveau</span>

            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="col-xxl-4 col-md-6 mb-3">
      <div class="card info-card revenue-card">

       

        <div class="card-body">
          <h5 class="card-title">Professeur </h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <img src="{{url('img\prof.png')}}" style="width: auto;height: 40px;">
            </div>
            <div class="ps-3">
              <h6>{{$allprofs}}</h6>
              <span class="text-success small pt-1 fw-bold">{{$newprofs}}</span> <span class="text-muted small pt-2 ps-1">Nouveau</span>

            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="col-xxl-4 col-xl-12">

      <div class="card info-card customers-card">

        <div class="card-body">
          <h5 class="card-title">Formation </h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <img src="{{url('img/education.png')}}" style="width: auto;height: 40px;">
            </div>
            <div class="ps-3">
              <h6>{{$allFormation}}</h6>
              <span class="text-danger small pt-1 fw-bold">{{$newFormation}}</span> <span class="text-muted small pt-2 ps-1">Nouveau</span>
            </div>
          </div>

        </div>
      </div>

    </div>

            <div class="col-12 mt-3 mb-3">
              <div class="card top-selling overflow-auto" style="height: 500px">


                <div class="card-body pb-0">
                  <h5 class="card-title">Annonces </h5>

                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Sujet</th>
                        <th scope="col">Date</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($annonces as $annonce)
                          
                      <tr>
                          <td>{{$annonce->titre}}</td>
                          <td>{{$annonce->sujet}}</td>
                          <td>{{$annonce->created_at}}</td>
                      </tr>
                      
                      @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div>

          </div>
        </div>

        <div class="col-lg-4 mb-3">


          <div class="card overflow-auto p-3" style="height: 800px;">
            <h4 class="card-title">Seances</h4>
            
                     
                        @foreach ($seances as $seance)
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="#">
                                <h6 class="card-subtitle mb-2">{{$seance->name}}</h6>
                            </a>
                            <h6 class="card-subtitle mb-2 text-muted">{{$seance->prenom}} {{$seance->nom}}</h6>
                        </div>
                        <h6 class="card-subtitle mb-2 text-muted">{{$seance->Nom_formation}}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{$seance->Sdate}} : {{$seance->Stime}}</h6>

                            
                        @endforeach
                    
          </div>

          

        

        </div>

      </div>
    </section>

@endsection
