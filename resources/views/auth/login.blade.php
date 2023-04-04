<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Se Connecter</title>
</head> 
<body>
    
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4" style="background-color: cornflowerblue;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                   
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center fs-2">Se Connecter</h5>
                                <p class="text-center small fs-6">Saisir votre Email et Mot de passe</p>
                            </div>

                            @if (session('FailLogin'))
                                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                    Les informations sont incorrect !
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form class="row g3 needs-validation" action="{{ route('authenticate') }}" method="post">
                            @csrf
                                <div class="col-12 p-3">
                                    <label for="yourUsername" class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="email" id="email" name="email" class="form-control" value="{{old('email')}}" required>
                                                                                
                                    </div>
                                </div>
                                <div class="col-12 p-3">
                                    <label for="yourPassword" class="form-label">Mot de passe</label>
                                    <input type="password" id="password" class="form-control" name="password" value="{{old('password')}}" required>
                                                                        
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <button class="btn btn-primary btn-primary-style w-100 mb-3" type="submit">
                                        Login
                                </button>
                                </div>
                                <div class="col-12 ">
                                    <a class="btn btn-link" href="">Mot de passe oublié ?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </section>

    @if (session('error'))
        
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
</body>
</html>