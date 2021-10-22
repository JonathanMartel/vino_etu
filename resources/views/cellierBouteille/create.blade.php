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
          <input id="quantite" type="number" min="1" class="validate">
          <label for="quantite">Date d'achat</label>
        </div>
        <div class="input-field col s12">
          <input id="quantite" type="number" min="1" class="validate">
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
        <input type="hidden" id="bouteille_id">
    </form>
    </div>
@endsection

<script src="{{asset('js/cellierBouteille_create.js')}}"></script>