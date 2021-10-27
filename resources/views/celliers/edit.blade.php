@extends('layouts.app')
@section('content')

<link href="{{asset('css/celliers.css')}}" rel="stylesheet" />

@if(isset(Auth::user()->id))
<div class="entete-page">
    <h1>Modifier ce cellier</h1>
    <img src="{{URL::asset('/assets/icon/logo-3-bouteilles-cellier.svg')}}" alt="Icone trois bouteilles">
</div>
<div class="form-ajout">
    <form id="edit-form" action="" method="POST">
        @method('PUT')
        @csrf
        <div class="input-field col s12">

            <input type="text" name="nom" id="nom" class="@if($errors->first('nom')) invalid @endif validate" value="{!! $cellier->nom !!}" />
            <label for="nom">Nom :</label>

            @if ($errors->has('nom'))
            <span class="helper-text" data-error="Champ obligatoire"></span>
            @endif
        </div>

        <div class="input-field col s12">

            <input type="text" name="localisation" id="localisation" class="validate" value="{!! $cellier->localisation !!}" />
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
            <button class="btn waves-effect waves-light button btn-modifier" type="submit">Modifier</button>
            <!-- <a class="btn waves-effect waves-light button btn-supprimer " href="#"><i class="material-icons">delete</i></a> -->

        </div>
    </form>
</div>

    
    <form class="btn-sup-container" id="delete-form" action="/cellier/{{$cellier->id}}" method="POST">
        @method('DELETE')
        @csrf
        <button class="btn waves-effect waves-light button btn-supprimer"><i class="material-icons">delete</i></button>
    </form>




@endif
@endsection