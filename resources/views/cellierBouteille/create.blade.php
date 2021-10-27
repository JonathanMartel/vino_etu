@extends('layouts.app')
@section('content')

@if(Session::get('erreur'))
<span class="success"></span>
@endif

<div class="flex-center">
  <h1>Nouveau vin</h1>
</div>
<div class="row">
      <div class="input-field col s12 recherche">
          <i class="material-icons prefix">search</i>
          <input type="text"  name="recherche" autocomplete="off">
          <label for="recherche">Rechercher un vin</label>
          <div class="autocomplete z-depth-2"></div>
        </div>
      </div>
      
<div class="row">
  
    <form class="col s12" action="{{route('cellierBouteille.store')}}" method="POST" enctype="multipart/form-data" >
    <img name="img-bouteille" src="{{ old('url_img') }}" alt="{{ old('nom') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input-field col s12">
          <input id="nom" name="nom" type="text" class="@if($errors->first('nom')) invalid @endif validate" value="{{ old('nom') }}" required />
          <label for="nom">Nom</label>
          <span class="helper-text" data-error="Champ obligatoire"></span>
        </div>
        <div class="input-field col s12">
          <select name ="type_id">
            <option value="" disabled selected></option>
            @foreach($types as $type)
            <option value="{{ $type->id }}" @if( old('type_id') == $type->id) selected @endif>{{ $type->type}}</option>
            @endforeach
          </select>
          <label>Type</label>
        </div>
        <div class="input-field col s12">
          <select name ="format_id">
            <option value="" disabled selected></option>
            @foreach($formats as $format)
            <option value="{{ $format->id }}" @if( old('format_id') == $format->id) selected @endif>{{ $format->nom}} - {{$format->taille}} cL </option>
            @endforeach
          </select>
          <label>Format</label>
        </div>
        <div class="input-field col s12">
          <textarea id="description" name="description" class="materialize-textarea">{{ old('description') }}</textarea>
          <label for="description">Description</label>
          <span class="helper-text" data-error="Format invalid"></span>
        </div>
        <div class="input-field col s12">
          <input id="pays" type="text" name="pays" class="validate" value="{{ old('pays') }}">
          <label for="pays">Pays</label>
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
          <label name="labelMillesime">{{ old('millesimes') ?? 'Millesime' }}</label>
        </div>
        <div class="input-field col s12">
          <input id="quantite" type="number" name="quantite" min="1" class="validate" value="{{ old('quantite') }}">
          <label for="quantite">Quantité</label>
          <span class="helper-text" data-error="Format invalid"></span>
        </div>
        <div class="input-field col s12">
          <input id="prix" type="number" pattern="[0-9]+(\\.[0-9][0-9]?)?" name="prix" step=".01" min=".01" class="validate" value="{{ old('prix') }}">
          <label for="prix">Prix</label>
          <span class="helper-text" data-error="Format invalid"></span>
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
            <input type="file" name="file" accept="image/*">
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
        <input type="hidden" name="millesimes" value="{{ old('millesimes') }}" id="millesimes">
        <input type="hidden" name="bouteille_id" value="{{ old('bouteille_id') }}" id="bouteille_id">
        <input type="hidden" name="url_img" value="{{ old('url_img') }}" id="url_img">
        <div class="col s12 flex-row">
        <button class="btn waves-effect waves-light"  name="annuler">Annuler</button>
        <button class="btn waves-effect waves-light" type="submit" name="submit">Ajouter<i class="material-icons right">send</i>
        </button>
        </div>
  </button>

    </form>
    </div>


@endsection
<link href="{{asset('css/autocomplete.css')}}" rel="stylesheet" />
<link href="{{asset('css/cellierBouteilles.css')}}" rel="stylesheet" />
<script src="{{asset('js/cellierBouteille_create.js')}}"></script>
<link href="{{asset('css/star-rating.css')}}" rel="stylesheet" />
<script src="{{asset('js/star-rating.js')}}"></script>