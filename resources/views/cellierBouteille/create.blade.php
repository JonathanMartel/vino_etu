@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">search</i>
          <input type="text" name="autocomplete" autocomplete="off">
          <label for="autocomplete">Rechercher une bouteille</label>
          <ul></ul>
        </div>
      </div>
    </div>
  </div>
<div class="row">
    <form class="col s12 z-depth-5">
        <div class="input-field col s12">
          <input id="nom" type="text" class="validate">
          <label for="nom">Nom</label>
        </div>
        <div class="input-field col s12">
          <input id="quantite" type="number" min="1" class="validate">
          <label for="quantite">Quantité</label>
        </div>
        <div class="input-field col s12">
          <input id="quantite" type="number" pattern="[0-9]+(\\.[0-9][0-9]?)?" step=".01" class="validate">
          <span class="helper-text" data-error="Format invalid"></span>
          <label for="quantite">Prix</label>
        </div>
        <div class="input-field col s12">
          <input id="quantite" type="number" class="validate">
          <label for="quantite">Millesime</label>
        </div>
        <div class="input-field col s12">
          <input id="date_achat" type="text" class="datepicker validate">
          <label for="date_achat">Date d'achat</label>
        </div>
        <div class="input-field col s12">
          <input id="commentaire" type="text" class="validate">
          <label for="commentaire">Commentaire</label>
        </div>
        <div class="input-field col s12">
          <input id="garde_jusqua" type="text" class="validate">
          <label for="garde_jusqua">Garder jusqu'à</label>
        </div>
        <div class="rate">
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
    </form>
    </div>
@endsection
<link href="{{asset('css/rating.css')}}" rel="stylesheet" />
<script src="{{asset('js/cellierBouteille_create.js')}}"></script>