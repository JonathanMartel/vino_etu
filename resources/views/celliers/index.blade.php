@extends('layouts.app')
@section('content')

<link href="{{asset('css/celliers.css')}}" rel="stylesheet" />
@if(isset(Auth::user()->id))
<div class="entete-page">
    <h1>Vos celliers</h1>
    <img src="{{URL::asset('/assets/icon/logo-3-bouteilles-cellier.svg')}}" alt="Icone trois bouteilles">
</div>

<div class="bouton-ajout-conteneur">
    <a class="bouton-cercle-ajout" href="{{route('cellier.create')}}"><i class="material-icons">add</i></a>
</div>



<div class="liste-celliers">
    @forelse($celliers as $cellier)
    
    <a class="lien-cellier" href="{{route('cellier.show',  $cellier->id)}}">
        <article class="cellier">
            <div class="texte-cellier-container">
                <h2 class="nom-cellier">{{ ucfirst($cellier->nom) }}</h2>
                <h3 class="localisation-cellier"><img class="map-icone" src="{{URL::asset('/assets/icon/map-marker-rouge.svg')}}" alt="icone map"> {{ ucfirst($cellier->localisation) }}</h3>
            </div>
            <div class="droite-container">
                <img class="bouteille-icone" src="{{URL::asset('/assets/icon/bouteille-cellier.svg')}}" alt="Icone Bouteille">
                <!-- <p class="nb-vins-cellier">42</p> -->
                <!-- !!! insérer nb vins dans cellier ici  -->
                <div class="btn-space-col">
                    <a class="btn waves-effect waves-light button btn-modifier" href="{{ route('cellier.edit', $cellier->id)}}"><i class="material-icons">edit</i></a>
                    <!-- <a class="btn waves-effect waves-light button btn-supprimer" href="#"><i class="material-icons">delete</i></a> -->
                    <form action="{{ route('cellier.destroy', $cellier->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn waves-effect waves-light button btn-supprimer"><i class="material-icons">delete</i></button>
                </form>
                </div>
            </div>
        </article>
    </a>
    @empty
    <div class="list-empty">
        <p>Vous n'avez pour l'instant aucun cellier.</p>
        <a class="btn waves-effect waves-light button" href="{{route('cellier.create')}}">Ajouter un cellier</a>
    </div>

    @endforelse
</div>


@endif


@endsection