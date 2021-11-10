@extends('layouts.app')
@section('content')

<link href="{{asset('css/celliers.css')}}" rel="stylesheet" />

@if(isset(Auth::user()->id))
<div class="entete-page">
    <h1 class="titre-formulaire">Nouveau cellier</h1>
    <img src="{{URL::asset('/assets/icon/logo-3-bouteilles-cellier.svg')}}" alt="Icone trois bouteilles">
</div>
<div class="form-ajout">
    <form action="{{ route('cellier.store')}}" method="POST">
        @csrf
        <div class="input-field col s12">

            <input type="text" name="nom" id="nom" class="@if($errors->first('nom')) invalid @endif validate" min='0' max='32' value="{{old('nom')}}" />
            <label for="nom">Nom :</label>
            @if ($errors->has('nom'))
            <span class="helper-text" data-error="{{ $errors->first('nom') }}"></span>
            @endif
        </div>

        <div class="input-field col s12">
            <input type="text" name="localisation" id="localisation" class="@if($errors->first('localisation')) invalid @endif validate" value="{{old('localisation')}}" max="40" />
            <label for="localisation">Localisation :</label>
            @if ($errors->has('localisation'))
            <span class="helper-text" data-error="{{ $errors->first('localisation') }}"></span>
            @endif


        </div>

        <div>
            <label hidden for="user_id">user_id :</label>
            <input hidden type="text" name="user_id" id="user_id" value="{{Auth::user()->id}}" />
        </div>
        <div class="btn-space">
            <a class="btn waves-effect waves-light button btn-annuler" href="{{route('cellier')}}">Annuler</a>
            <button class="btn waves-effect waves-light button btn-ajouter" type="submit">Créer</button>
        </div>

    </form>
</div>




@endif
@endsection