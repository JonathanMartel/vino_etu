@extends('layouts.app')
@section('content')

<link href="{{asset('css/celliers.css')}}" rel="stylesheet" />

<div class="col-8">
    <h1>Vos celliers</h1>
    <p>Pour entrer dans un cellier, veuiller cliquer sur sa vignette</p>
</div>

<div>
    <a href="/create/cellier">Ajouter un cellier</a>
</div>

<div class="liste-cellier">
@forelse($celliers as $cellier)
<a href="./cellier/{{ $cellier->id }}">
    <article class="cellier">
        <div>
            <h2 class="titre-vignette">{{ ucfirst($cellier->nom) }}</h2>
            <p class="localisation-vignette">{{ ucfirst($cellier->localisation) }}</p>
        </div>
        <img src="" alt="Logo bouteille">
        <p class="nb-vins-cellier">42</p><!-- !!! insérer nb vins dans cellier ici  -->

    </article>
</a>
@empty
<p>Vous n'avez pour l'instant aucun cellier.</p>
@endforelse
</div>




@endsection