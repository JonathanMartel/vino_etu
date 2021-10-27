@extends('layouts.app')
@section('content')

<link href="{{asset('css/celliers.css')}}" rel="stylesheet" />

@if(isset(Auth::user()->id))
<div class="entete-page">
    <h1>Nouveau cellier</h1>
    <img src="{{URL::asset('/assets/icon/logo-3-bouteilles-cellier.svg')}}" alt="Icone trois bouteilles">
</div>
<div class="form-ajout">
    <form action="" method="POST">
        @csrf
        <div class="input-field col s12">
            
            <input type="text" name="nom" id="nom"  class="@if($errors->first('nom')) invalid @endif validate" value="{{old('nom')}}" />
            <label for="nom">Nom :</label>
            
            @if ($errors->has('nom'))
            <span class="helper-text" data-error="Champ obligatoire"></span>
            @endif
        </div>

        <div class="input-field col s12">
            
            <input type="text" name="localisation" id="localisation" class="validate" value="{{old('localisation')}}" />
            <label for="localisation">Localisation :</label>
            
            @if ($errors->has('localisation'))
            <span class="helper-text" data-error="Champ obligatoire"></span>
            @endif
        </div>

        <div>
            <label hidden for="user_id">user_id :</label>
            <input hidden type="text" name="user_id" id="user_id" value="{{Auth::user()->id}}" />


        </div>
        <div class="btn-space">
        <a class="btn waves-effect waves-light button btn-annuler" href="/">Annuler</a>
        <button class="btn waves-effect waves-light button btn-ajouter" type="submit">Créer</button>
        </div>
        
    </form>
</div>




@endif
@endsection