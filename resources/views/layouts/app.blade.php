<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>In Vino Veritas</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    
    
    
    <!-- Polices  -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">


    <!-- Materialize CSS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet" />
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet" />


    <script src="{{asset('js/app.js')}}"></script>
    
</head>

<body>
<div id="body_container">
    <header class="flex-row padding-1rem z-depth-1">
            <!-- Voir la navigation !!! -->
        <a href="/" class="brand-logo left "><img src="{{asset('assets/logo/logo-vino.svg')}}"></a>

        <nav class="nav-extended white z-depth-0">
            <div class="nav-wrapper">
                <a href="#" class="sidenav-trigger right" data-target="mobile-links"><i class="material-icons" style="font-size: 50px"><span class="black-text  md-48">menu</span></i></a>
                <ul class="right hide-on-med-and-down">
                    @guest
                    <li><a href="/registration"><span class="black-text">S'inscrire</sapn></a></li>
                    <li><a href="/login"><span class="black-text">Se connecter</sapn></a></li>
                    @else
                    <li><a href="/logout"><span class="black-text">Se déconnecter</sapn></a></li>
                    <li><a href="/dashboard"><i class="large material-icons"><span class="black-text">account_circle</span></i></a></li>
                    @endguest
                </ul>
            </div>
            <ul class="sidenav" id="mobile-links">
                <li><a href="/cellier">Vos celliers</a></li>
                @guest
                    <li><a href="/registration">S'inscrire</a></li>
                    <li><a href="/login">Se connecter</a></li>
                @else
                    <li><a href="/dashboard"><span class="black-text">Mon Compte</sapn></a></li>
                    <li><a href="/logout"><span class="black-text">Se déconnecter</sapn></a></li>
                @endguest
            </ul>
            <div class="nav-content row white">
                <div class="col s6">
                    <ul class="tabs tabs-transparent hide-on-med-and-down">
                        <li class="tab"><a href="/cellier"><span class="black-text">Vos celliers</sapn></a></li>
                        <li class="tab"><a href="/dashboard"><span class="black-text">Compte</sapn></a></li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
    <main>

    @yield('content')
    </main>
    <!-- Footer -->
    <footer class="footer text-faded text-center py-5">
        <div class="container">
            <p class="m-0 small">Copyright - In Vino Veritas</p>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
</div>
</body>

</html>