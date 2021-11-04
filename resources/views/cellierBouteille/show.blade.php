@extends('layouts.app')
@section('content')

<header>
    <div class="cellier">
        <span>{{ $cellier->nom }}</span>
        <select name="cellier" id="cellier">
            <option value="{{ $cellier->id }}">{{ $cellier->nom }}</option>
            <!-- Ajouter les options du select de cellier !!! -->
        </select>
    </div>
    <div class="localisation">
        <span><img class="map-icone" src="{{URL::asset('/assets/icon/map-marker-rouge.svg')}}" alt="icone map"> {{ $cellier->localisation }}</span>
    </div>
    <div class="bouteille-nom">
        <span>{{ $bouteille->nom }}</span>
        <a class="" href="{{ route('cellier.edit', $cellier->id)}}"><i class="material-icons">edit</i></a>
    </div>
</header>
<main>
    <section class="info">
        <article class="infoBouteilleConteneur">
            <div class="">
                <p>{{ $bouteille->pays }} | {{ $bouteille->type }}</p>
                <p>{{  $bouteille->format }}</p>
                <p>{{  $bouteille->taille }} cl</p>
                <p>Prix Saq | {{ $bouteille->prix_saq }}$</p>
            </div>
            <div class="bouteilleSAQConteneur">
                <a class="lienSAQ" href="{{ $bouteille->url_saq }}">SAQ</a>
                <div class="cercle ">
                    <i class="material-icon check">check</i>
                </div>
            </div>
        </article>
        <article>
            <h2 class="description-titre">Description</h2>
            <p>{{ $bouteille->description  }}</p>
        </article>
    </section>

    <section class="millesime-conteneur">
         @foreach($cellierBouteilleMillesime as $cellierBouteille)
            <div class="millesime-item" data-js-bouton>
                @if($cellierBouteille->millesime  != 0)
                    <p>{{$cellierBouteille->millesime }}</p>
                @else
                    <p>N/A</p>
                @endif
            </div>
        @endforeach 
    </section>
    <section>
        <img class="image" src="{{ $bouteille->url_img}}" alt="">
        <div class="form-modifier">
            <form id="" action="" method="POST" class="form-modifier">
                @method('PUT')
                 @csrf
                <div class="form-modifier-item" >
                    <label for="quantite">Quantité :</label>
                    <input type="number" name="quantite" id="quantite" class="" value="{!! $cellierBouteille->quantite !!}"/>
                </div>
                <div class="form-modifier-item" >
                    <label for="note">Note :</label>
                    <input type="number" name="note" id="note" class="" value="{!! $cellierBouteille->note !!}"/>
                </div>
                <div class="form-modifier-item" >
                    <label for="prix">Prix :</label>
                    <input type="number" name="prix" id="prix" class="" value="{!! $cellierBouteille->prix !!}"/>
                </div>
                <div class="form-modifier-item" >
                    <label for="commentaire">commentaire :</label>
                    <input type="textarea" name="commentaire" id="commentaire" class="" value="{!! $cellierBouteille->commentaire !!}"/>
                </div>
                <div class="form-modifier-item" >
                    <label for="date_achat">Date d'achat :</label>
                    <input type="date" name="date_achat" id="date_achat" class="" value="{!! $cellierBouteille->date_achat !!}"/>
                </div>
                <div class="form-modifier-item" >
                    <label for="garde_jusqua">À conserver :</label>
                    <input type="textarea" name="garde_jusqua" id="garde_jusqua" class="" value="{!! $cellierBouteille->garde_jusqua !!}"/>
                </div>
            </form>
        </div>
    </section>
   

</main>

<!-- <div>
    <ul>
        <li>Nom ://  $bouteille->nom //</li>
        <li>Description :// $bouteille->description //</li>
        <li>Pays :// $bouteille->pays //</li>
        <li>Prix Saq ://  $bouteille->prix_saq //</li>
        <li>Type : //  $bouteille->type //</li>
        <li>Format : //  $bouteille->format //</li>
        <li>Lien SAQ : //  $bouteille->url_saq //</li>
        <li>image : //  $bouteille->url_img //</li>
    </ul>
</div>
<div>
    <ul>
        <li>Quantié : // $cellierBouteille->quantite //</li>
        <li>Note : // $cellierBouteille->note //</li>
        <li>Millesime : // $cellierBouteille->millesime //</li>
        <li>Prix: // $cellierBouteille->garde_jusqua //</li>
        <li>Commentaire: // $cellierBouteille->commentaire //</li>
        <li>Date: // $cellierBouteille->date_achat //</li>
        <li>Garder:// $cellierBouteille->garde_jusqua //</li>
    </ul>
</div> -->

@endsection
<script src="{{asset('js/cellierBouteille_show.js')}}"></script> 
<link href="{{asset('css/cellierBouteillesListe.css')}}" rel="stylesheet" />
