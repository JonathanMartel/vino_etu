@extends('layouts.app')
@section('content')

<link href="{{asset('css/celliers.css')}}" rel="stylesheet" />

<div class="entete-page">
    <h1>Nouveau cellier</h1>
    <img src="{{URL::asset('/assets/icon/logo-3-bouteilles-cellier.svg')}}" alt="Icone trois bouteilles">
</div>

<form action="" method="POST">
    @csrf
    <div>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" placeholder="Nom de votre cellier" value="{{old('nom')}}" />
        
        @if ($errors->has('nom'))
        <span class="text-danger">{{ $errors->first('nom') }}</span>
        @endif
    </div>

    <div>
        <label for="localisation">Localisation :</label>
        <input type="text" name="localisation" id="localisation" placeholder="Localisation de votre cellier" value="{{old('localisation')}}" />
        
        @if ($errors->has('localisation'))
        <span class="text-danger">{{ $errors->first('localisation') }}</span>
        @endif
    </div>

    <div>
        <label hidden for="user_id">user_id :</label>
        <input hidden type="text" name="user_id" id="user_id" value="{{Auth::user()->id}}" />
        
        
    </div>
    <button type="submit">Créer</button>
</form>




@endsection