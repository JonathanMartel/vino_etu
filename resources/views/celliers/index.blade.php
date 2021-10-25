@extends('layouts.app')
@section('content')

<div class="col-8">
    <h1>Vos celliers</h1>
    <p>Pour entrer dans un cellier, veuiller cliquer sur sa vignette</p>
</div>

<div>
    <a href="/create/cellier">Ajouter un cellier</a>
</div>


@forelse($celliers as $cellier)
<a href="./cellier/{{ $cellier->id }}">
    <article class="flex-row">
        <div>
            <h2>{{ ucfirst($cellier->nom) }}</h2>
            <p>{{ ucfirst($cellier->localisation) }}</p>
        </div>
        <img src="" alt="Logo bouteille">
        <p>42</p><!-- !!! insérer nb vins dans cellier ici  -->

    </article>
</a>
@empty
<p>Vous n'avez pour l'instant aucun cellier.</p>
@endforelse



@endsection