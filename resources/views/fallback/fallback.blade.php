
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  @vite('resources/css/app.css')
  <title>L'Atelier a Vin</title>


</head>

<body >

        <div class="container_fallback">
            <img class="" src="https://www.kindpng.com/picc/m/150-1500725_animated-thinking-man-png-transparent-png.png" alt="Animated Thinking Man Png, Transparent Png@kindpng.com">
        </div>

        <div class="text_fallback">
            <h1>404</h1>
            <h3>Vous semblez aussi perdu que moi ?</h3>
            <br>
            <button class="button_fallback">
                <a href="{{ route('acceuil') }}">Retourner à l'accueil</a>
            </button>
        </div>

</body>
</html>
