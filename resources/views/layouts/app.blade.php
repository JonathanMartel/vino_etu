<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>In Vino Veritas</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet" />
    
</head>

<body>

    <header>
            <!-- Voir la navigation !!! -->

            <nav class="nav-extended">
            <!-- <div class="nav-wrapper white"> -->
            <div class="nav-wrapper white">
                <a href="#" class="brand-logo"><span class="black-text">Logo</sapn></a>
                <a href="#" class="sidenav-trigger right" data-target="mobile-links"><i class="material-icons"><span class="black-text">menu</span></i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="{{ route('inscription') }}"><span class="black-text">S'inscrire</span></a></li>
                    <li><a href="{{ route('login') }}"><span class="black-text">Se connecter</span></a></li>
                </ul>
            </div>
            <ul class="sidenav" id="mobile-links">
                <li><a href="/cellier">Accueil</a></li>
                <li><a href="/cellier">Les celliers</a></li>
                <li><a href="{{ route('inscription') }}">S'inscrire</a></li>
                <li><a href="{{ route('login') }}">Se connecter</a></li>
            </ul>
            <div class="nav-content row white">
                <div class="col s6">
                    <ul class="tabs tabs-transparent hide-on-med-and-down">
                        <li class="tab"><a href="/cellier"><span class="black-text">Accueil</span></a></li>
                        <li class="tab"><a href="/cellier"><span class="black-text">Les celliers</sapn></a></li>
                        <li class="tab"><a href="#"><span class="black-text">Compte</span></a></li>
                    </ul>
                </div>
                <div class="search-wrapper right col l4 s12  flex-row">
                    <input id="search" placeholder="Trouvez un vin">
                    <i class="material-icons"><span class="black-text">search</span></i>
                </div>
            </div>
        </nav>

    </header>


    @yield('content')

    <!-- Footer -->
    <footer class="footer text-faded text-center py-5">
        <div class="container">
            <p class="m-0 small">Copyright</p>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>


    <!-- <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });
    </script> -->

</body>

</html>