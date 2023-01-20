
<a href="/cellier">Espace cellier</a>
<a href="/bouteille">Liste bouteille du catalogue</a>

<h1>Modification d'une bouteille d'un cellier</h1>
@if (session()->has('success'))
<span style="color:green">{{ session('success') }}</span>
@endif

<!-- Début form modif -->

	<form id="formAjoutBouteille" action="{{ route('bouteille.update', ['id' => $bouteille->id])}}" method="POST">
		@csrf
	
		 <!-- Obligatoire -->
		  <label for="nom"> * Nom  :</label>
		  <input id="nom" name="nom" type="text" value="{{ old('nom', $bouteille->nom)}}" required>
		  <br>

          
		  <span>* Type :</span>
		  <br>
		  <input type="radio" name="type" id="rouge" value="1" required @if($bouteille->type == "1") checked @endif >
		  <label for="rouge">Rouge</label>
		  <input type="radio" name="type" id="blanc" value="2" @if($bouteille->type == "2") checked @endif>
		  <label for="blanc">Blanc</label>
		  <input type="radio" name="type" id="rose" value="3" @if($bouteille->type == "3") checked @endif>
		  <label for="rose">Rosé</label>
		  <br>
		  <!-- Pas obligatoire -->
		  <label for="pays">Pays :</label>
		  <input id="pays" name="pays" type="text" value="{{ old('pays', $bouteille->pays)}}">
		  <br>
		  <label for="format">Format :</label>
		  <input id="format" name="format" type="text" value="{{ old('format', $bouteille->format)}}">
		  <br>
		  <label for="millesime">Millesime :</label>
		  <input id="millesime" name="millesime" type="text" value="{{ old('millesime', $bouteille->millesime)}}">
		  <br>
		  <label for="description">Description</label>
		  <textarea id="description" name="description">{{ old('description', $bouteille->description)}}</textarea>
		  <br>
		  <!-- Caché non obligatoire -->
		  <input id="url_saq" name="url_saq" type="hidden" value="{{ old('url_saq', $bouteille->url_saq)}}">
		  <input id="code_saq" name="code_saq" type="hidden" value="{{ old('code_saq', $bouteille->code_saq)}}">
		  <input id="image" name="image" type="hidden" value="{{ old('image', $bouteille->image)}}">
		  <input id="prix_saq" name="prix_saq" type="hidden" value="{{ old('prix_saq', $bouteille->prix_saq)}}">
		  <input id="url_img" name="url_img" type="hidden" value="{{ old('url_img', $bouteille->url_img)}}">
	
		  <button>Modifier</button>

		</form>

        <form action="{{ route('bouteille.supprime', ['id' => $bouteille->id]) }}" method="POST">
            @csrf
        
            <button>Supprimer</button>
        </form>


