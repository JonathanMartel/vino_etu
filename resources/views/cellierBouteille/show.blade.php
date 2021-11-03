@extends('layouts.app')
@section('content')




{{ $cellier->nom }}
{{ $cellier->localisation }}

<div>
    <ul>
        <li>Nom :{{  $bouteille->nom }}</li>
        <li>Description :{{ $bouteille->description }}</li>
        <li>Pays :{{ $bouteille->pays }}</li>
        <li>Prix Saq :{{  $bouteille->prix_saq }}</li>
        <li>Type : {{  $bouteille->type }}</li>
        <li>Format : {{  $bouteille->format }}</li>
        <li>Lien SAQ : {{  $bouteille->url_saq }}</li>
        <li>image : {{  $bouteille->url_img }}</li>
    </ul>
</div>
<div>
    <ul>
        <li>Quantié : {{ $cellierBouteille->quantite }}</li>
        <li>Note : {{ $cellierBouteille->note }}</li>
        <li>Millesime : {{ $cellierBouteille->millesime }}</li>
        <li>Image: {{ $cellierBouteille->url_img }}</li>
        <li>Taille: {{ $cellierBouteille->taille }}</li>
        <li>Prix: {{ $cellierBouteille->garde_jusqua }}</li>
        <li>Commentaire: {{ $cellierBouteille->commentaire }}</li>
        <li>Date: {{ $cellierBouteille->date_achat }}</li>
        <li>Garder:{{ $cellierBouteille->garde_jusqua }}</li>
    </ul>
</div>

@endsection

<link href="{{asset('css/cellierBouteillesListe.css')}}" rel="stylesheet" />