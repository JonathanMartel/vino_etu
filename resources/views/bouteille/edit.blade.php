@extends('layouts.app')
@section('content')

@if(Session::get('erreur'))
<span class="success"></span>
@endif

<div class="entete-page">
    <h1 class="titre-formulaire">Modifier un vin</h1>
    <img src="{{URL::asset('/assets/icon/deux-coupe-jaune.svg')}}" alt="Icone deux coupe de vin">
</div>

@if (Auth::user()->id)
@if(isset($bouteille->code_saq) || $bouteille->user_id === 1 )
<!-- La bouteille est importé de la saq ou créée par un administrateur -->
@if(Auth::user()->admin)
<!-- L'utilisateur a droit de modifier une bouteille de la SAQ si c'est un admin -->
<p>Attention, vous modifiez une bouteille accessible globalement</p>

<!-- formulaire de modification d'une bouteille de la SAQ -->

@else
<p class="msg-redirect">Vous n'avez pas les droits suffisant pour modifier cette bouteille. Vous pouvez en créer une personifiée dans votre cellier, elle ne sera accessible qu'à vous</p>

@endif
@else

<!-- C'est une bouteille perso donc l'utilisateur doit être le user_id de la bouteille ou un admin -->
@if(Auth::user()->id === $bouteille->user_id )
<!-- Si l'admin peut modifier les bouteilles perso on peut lui donner le droit ici  -->

<form class="col s12 ajout-vin" action="" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="input-field col s12">
        <input id="nom" name="nom" max="111" type="text" class="@if($errors->first('nom')) invalid @endif validate" value="{{$bouteille->nom}}" required />
        <label for="nom">Nom</label>
        <span class="helper-text" data-error="Champ obligatoire"></span>
    </div>
    <div class="input-field col s12">
        <input id="pays" type="text" name="pays" pattern="^[-a-zA-ZáéíóúÁÉÍÓÚÑñÇç]*$" class="@if($errors->first('pays')) invalid @endif validate" value="{{$bouteille->pays}}">
        <label for="pays">Pays</label>
        <span class="helper-text" data-error="Format invalid"></span>
    </div>
    <div class="input-field col s12 ">
        <select name="type_id">
            <option value="{{$bouteille->type_id}}" disabled selected>{{$bouteille->type->type}}</option>
            @foreach($types as $type)
            <option value="{{ $type->id }}" @if( '$bouteille->type_id'==$type->id) selected @endif> {{ $type->type}}</option>
            @endforeach
        </select>
        <label>Type</label>
        @if($errors->first('type_id')) <span class="helper-text erreur" data-error="Format invalid">Champ obligatoire</span> @endif
    </div>
    <div class="input-field col s12">
        <select name="format_id">
            <option value="{{$bouteille->format_id}}" selected>{{$bouteille->format->nom}} - {{$bouteille->format->taille}} cl</option>
            @foreach($formats as $format)
            <option value="{{ $format->id }}" @if( '$bouteille->format_id'==$format->id) selected @endif>{{ $format->nom}} - {{$format->taille}} cL </option>
            @endforeach
        </select>
        <label>Format</label>
        @if($errors->first('format_id')) <span class="helper-text erreur" data-error="Format invalid">Champ obligatoire</span> @endif
    </div>
    <div class="input-field col s12">
        <textarea id="description" name="description" class="materialize-textarea">{{$bouteille->description}}</textarea>
        <label for="description">Description</label>
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

    <input type="hidden" name="id" value="{{ old('id') }}" id="id">
    <input type="hidden" name="url_img" value="{{ old('url_img') }}" id="url_img">
    <div class="col s12 btn-space">
        <a href="#<!-- route('cellier.show', $idCellier) -->" class="btn waves-effect waves-light button btn-annuler" name="annuler">Annuler</a>
        <button class="btn waves-effect waves-light button btn-ajouter" type="submit" name="submit">Ajouter</button>
    </div>

</form>


@else
<!-- theoriquement l'utilisateur ne devrait pas pouvoir accéder à cette bouteille car c'est la bouteille perso d'un autre user  -->
<p class="msg-redirect">Vous n'avez pas les droits suffisant pour modifier cette bouteille. Vous pouvez en créer une personifiée dans votre cellier, elle ne sera accessible qu'à vous</p>
<!-- bouton créer bouteille ou redirection auto -->

@endif
@endif
@else
<p>Veuillez vous identifier pour accéder à cette partie du site</p>
@endif

@endsection
<link href="{{asset('css/bouteille_edit.css')}}" rel="stylesheet" />
<script src="{{asset('js/bouteille_edit.js')}}"></script>