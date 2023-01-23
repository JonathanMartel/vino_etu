
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  @vite('resources/css/app.css')
  <title>L'Atelier a Vin</title>

  {{-- Section AlpineJS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.11.1/cdn.js"></script>
</head>
<body>


        <div id="myCarousel" class="carousel carousel-fade slide" data-ride="carousel" data-interval="3000">
          <div class="carousel-inner" role="listbox">
            <div class="item active background a"></div>
            <div class="item background b"></div>
            <div class="item background c"></div>
          </div>
        </div>

        <div class="covertext">
          <div class="col-lg-10" style="float:none; margin:0 auto;">
            <h1 class="title">L'ATELIER À VIN</h1>

          </div>
          <div class="col-xs-12 explore">
            <a href="/utilisateur/inscription"><button class=" w-80 bg-red-800 hover:bg-red-300 text-white font-regular py-2 px-4 rounded">
                Inscrivez-vous
              </button></a>
          </div>
          <div class="col-xs-12 explore">
            <a href="/utilisateur/connnexion"><button class=" w-80 bg-red-800 hover:bg-red-300 text-white font-regular py-2 px-4 rounded">
                Connexion
              </button></a>
          </div>
          <div class=" py-12 col-xs-12 explore">
            <button class="w-80 bg-transparent hover:bg-red-300 text-white font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent rounded">
                EXPLORER LES CELLIERS
              </button>
        </div>



</body>
</html>
