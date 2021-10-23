@extends('layouts.app')
@section('content')
<div class="row">
      <div class="input-field col s12">
          <i class="material-icons prefix">search</i>
          <input type="text"  name="recherche" autocomplete="off">
          <label for="recherche">Rechercher une bouteille</label>
          <div class="autocomplete"></div>
        </div>
      </div>

<div class="row">
    <form class="col s12">
        <div class="input-field col s12">
          <input id="nom" type="text" class="validate">
          <label for="nom">Nom</label>
          <span class="helper-text" data-error="Format invalid"></span>
        </div>
        <div class="input-field col s12">
          <input id="quantite" type="number" min="1" class="validate">
          <label for="quantite">Quantité</label>
          <span class="helper-text" data-error="Format invalid"></span>
        </div>
        <div class="input-field col s12">
          <input id="prix" type="number" pattern="[0-9]+(\\.[0-9][0-9]?)?" step=".01" class="validate">
          <label for="prix">Prix</label>
          <span class="helper-text" data-error="Format invalid"></span>
        </div>
        <div class="input-field col s12">
          <input id="millesime" type="number" max="9999" min="0000" pattern="\d{4}" class="validate">
          <label for="millesime">Millesime</label>
          <span class="helper-text" data-error="Format invalid"></span>
        </div>
        <div class="input-field col s12">
          <input id="date_achat" type="text" class="datepicker validate">
          <label for="date_achat">Date d'achat</label>
          <span class="helper-text" data-error="Format invalid"></span>
        </div>
        <div class="input-field col s12">
        <textarea id="commentaire" class="materialize-textarea"></textarea>
          <label for="commentaire">Commentaire</label>
          <span class="helper-text" data-error="Format invalid"></span>
        </div>
        <div class="input-field col s12">
          <input id="garde_jusqua" type="text" class="validate">
          <label for="garde_jusqua">Garder jusqu'à</label>
          <span class="helper-text" data-error="Format invalid"></span>
        </div>
        <div class="file-field input-field col s12">
          <div class="btn">
            <span>Image</span>
            <input type="file">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
        <div class="rate col s12">
          <input type="radio" id="star5" name="rate" value="5" />
          <label for="star5" title="text">5 stars</label>
          <input type="radio" id="star4" name="rate" value="4" />
          <label for="star4" title="text">4 stars</label>
          <input type="radio" id="star3" name="rate" value="3" />
          <label for="star3" title="text">3 stars</label>
          <input type="radio" id="star2" name="rate" value="2" />
          <label for="star2" title="text">2 stars</label>
          <input type="radio" id="star1" name="rate" value="1" />
          <label for="star1" title="text">1 star</label>
        </div>
        <input type="hidden" id="bouteille_id">
        <div class="col s12">
        <button class="btn waves-effect waves-light" type="reset" name="action">reset
              <i class="material-icons right">reset</i>
          <button class="btn waves-effect waves-light" type="submit" name="action">Submit
              <i class="material-icons right">send</i>
        </div>
  </button>

    </form>
    </div>

   
  
@endsection
<link href="{{asset('css/rating.css')}}" rel="stylesheet" />
<link href="{{asset('css/autocomplete.css')}}" rel="stylesheet" />
<script src="{{asset('js/cellierBouteille_create.js')}}"></script>
