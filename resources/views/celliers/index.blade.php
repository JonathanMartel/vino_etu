@extends('layouts.app')
@section('content')

<link href="{{asset('css/celliers.css')}}" rel="stylesheet" />
<script src="{{asset('js/cellier_index.js')}}"></script>
@if(isset(Auth::user()->id))
<div class="entete-page">
    <h1>Vos celliers</h1>
    <img src="{{URL::asset('/assets/icon/logo-3-bouteilles-cellier.svg')}}" alt="Icone trois bouteilles">
</div>

<!-- <div class="bouton-ajout-conteneur">
    <a class="bouton-cercle-ajout" href="{{route('cellier.create')}}"><i class="material-icons">add</i></a>
</div> -->

<div class="bouton-ajout-vin-conteneur">
    <a class="bouton-ajout-vin" href="{{ route('cellier.create') }}">Ajouter un cellier</a>
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
                    <a class="btn waves-effect waves-light button btn-supprimer modal-trigger" href="#{{$cellier->id}}"><i class="material-icons">delete</i></a>
                    <!-- Modal Structure -->
                    <div id="{{$cellier->id}}" class="modal">
                        <div class="modal-content">
                            <h3>Supprimer ce cellier</h3>
                            <p>Êtes-vous certain de vouloir le cellier <span>{{ ucfirst($cellier->nom) }}</span>? Tous les bouteilles dans le cellier seront supprimées aussi.</p>
                        </div>
                        <div class="modal-footer">
                        <form action="{{ route('cellier.destroy', $cellier->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="waves-effect waves-green btn-flat">Supprimer</button>
                                        </form>
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </a>
    @empty
    <div class="list-empty">
        <p>Vous n'avez pour l'instant aucun cellier. Veuillez en créer un avant de continuer</p>
    </div>

    @endforelse
</div>


@endif


@endsection