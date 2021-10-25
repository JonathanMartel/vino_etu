@extends('layouts.app')
@section('content')

@if(Session::get('erreur'))
<span class="success"></span>
@endif
<div class="row">
      <div class="input-field col s12 recherche">
          <i class="material-icons prefix">search</i>
          <input type="text"  name="recherche" autocomplete="off">
          <label for="recherche">Rechercher une bouteille</label>
          <div class="autocomplete z-depth-2"></div>
        </div>
      </div>

<div class="row">
    <form class="col s12" action="{{route('cellierBouteille.store')}}" method="POST">
          @csrf
        <div class="input-field col s12">
          <input id="nom" name="nom" type="text" class="@if($errors->first('nom')) invalid @endif validate" value="{{ old('nom') }}" required />
          <label for="nom">Nom</label>
          <span class="helper-text" data-error="Champ obligatoire"></span>
          
         
        </div>
        <div class="input-field col s12">
          <input id="quantite" type="number" name="quantite" min="1" class="validate" value="{{ old('quantite') }}">
          <label for="quantite">Quantité</label>
          <span class="helper-text" data-error="Format invalid"></span>
        </div>
        <div class="input-field col s12">
          <input id="prix" type="number" pattern="[0-9]+(\\.[0-9][0-9]?)?" name="prix" step=".01" class="validate" value="{{ old('prix') }}">
          <label for="prix">Prix</label>
          <span class="helper-text" data-error="Format invalid"></span>
        </div>
        <div class="input-field col s12">
    <select name ="millesime">
      <option value="" disabled selected></option>
      {{ $anneeDebut= 1700 }}
      {{ $anneePresent = date('Y') }}

      @for ($i = $anneePresent; $i >= $anneeDebut; $i--)
          <option value="{{ $i }}" @if( old('millesime') == $i) selected @endif>{{ $i }}</option>
      @endfor
    </select>
    <label>Millesime</label>
  </div>
        <div class="input-field col s12">
          <input id="date_achat" type="text" tabindex="-1" name="date_achat" class="datepicker validate" value="{{ old('date_achat') }}" autocomplete="off">
          <label for="date_achat">Date d'achat</label>
          <span class="helper-text" data-error="Format invalid"></span>
        </div>
        <div class="input-field col s12">
        <textarea id="commentaire" name="commentaire" class="materialize-textarea">{{ old('commentaire') }}</textarea>
          <label for="commentaire">Commentaire</label>
          <span class="helper-text" data-error="Format invalid"></span>
        </div>
        <div class="input-field col s12">
          <input id="garde_jusqua" type="text" name="garde_jusqua" value="{{ old('garde_jusqua') }}" class="validate">
          <label for="garde_jusqua">Garder jusqu'à</label>
          <span class="helper-text" data-error="Format invalid"></span>
        </div>
        <div class="file-field input-field col s12">
          <div class="btn">
            <span>Image</span>
            <input type="file" accept="image/*">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
        <!-- https://www.cssscript.com/select-star-rating/ -->
        <div class="input-field col s12">
          <select class="star-rating" name="note">
              <option value="">Choisir une note</option>
              <option value="5" @if( old('note') == 5) selected @endif>Excellent</option>
              <option value="4" @if( old('note') == 4) selected @endif>Très bon </option>
              <option value="3" @if( old('note') == 3) selected @endif>Passable</option>
              <option value="2" @if( old('note') == 2) selected @endif>Médiocre</option>
              <option value="1" @if( old('note') == 1) selected @endif>Terrible</option>
          </select>
        </div>
        <input type="hidden" name="bouteille_id" value="{{ old('bouteille_id') }}" id="bouteille_id">
        <div class="col s12">
        <button class="btn waves-effect waves-light" type="reset" name="reinitialiser">Réinitialiser
      
          <button class="btn waves-effect waves-light" type="submit" name="submit">Ajouter
              <i class="material-icons right">send</i>
        </div>
  </button>

    </form>
    </div>


  
@endsection
<link href="{{asset('css/autocomplete.css')}}" rel="stylesheet" />
<script src="{{asset('js/cellierBouteille_create.js')}}"></script>
<link href="{{asset('css/star-rating.css')}}" rel="stylesheet" />
<script src="{{asset('js/star-rating.js')}}"></script>