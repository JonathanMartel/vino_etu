
@extends('layouts.app')
<link href="{{asset('css/fiche-vin.css')}}" rel="stylesheet" />
@section('content')

<header>
    <div class="cellier">
        <select name ="select-cellier">
            
            @foreach($celliers as $unCellier)
            <option value="{{ $unCellier->id }}" @if( $unCellier->id == $cellier->id) selected @endif>{{ $unCellier->nom}} </option>
            @endforeach
          </select>
    </div>
    <div class="localisation">
        <span><img class="map-icone" src="{{URL::asset('/assets/icon/map-marker-rouge.svg')}}" alt="icone map"> {{ $cellier->localisation }}</span>
    </div>
    <div class="bouteille-nom">
    <select  name ="select-bouteille">
            
            @foreach($cellierBouteillesByIDs as $vin)
            <option value="{{ $vin['id'] }}" @if( $vin['id'] == $bouteille->id) selected @endif>{{ $vin['bouteille']->nom}} </option>
            @endforeach
          </select>
        <a class="" href="{{ route('bouteilleEdit', $bouteille->id)}}"><i class="material-icons">edit</i></a>
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


<!-- Deuxième partie "Millésime -->

         <section class="millesime-conteneur">
             @foreach($cellierBouteilleMillesime as $cellierBouteille)
                     <div data-js-bouton="{{ $cellierBouteille->millesime }}">
                        <button id="bouton-millesime"class="millesime-item" >
                            @if($cellierBouteille->millesime  != 0)
                                <p>{{ $cellierBouteille->millesime }}</p>
                            @else
                                <p>N/A</p>
                            @endif
                        </button>
                     </div>
                @endforeach
         </section>
        <section class="">
            <div class="form-modifier form">
                <form id="" action="" method="POST" class="form-modifier" data-js-form>
                    @method('PUT')
                    @csrf
                    <div class="millesime-info-debut">
                        <img class="image-fiche" src="{{ $bouteille->url_img}}" alt="">
                        <div>
                            <div class="select-form">
                                <select class="star-rating"  name="note" value="{!! $cellierBouteille->note !!}">
                                    <option value="">Choisir une note</option>
                                    <option value="5" @if( $cellierBouteille->note == 5) selected @endif>Excellent</option>
                                    <option value="4" @if( $cellierBouteille->note == 4) selected @endif>Très bon </option>
                                    <option value="3" @if( $cellierBouteille->note == 3) selected @endif>Passable</option>
                                    <option value="2" @if( $cellierBouteille->note == 2) selected @endif>Médiocre</option>
                                    <option value="1" @if( $cellierBouteille->note == 1) selected @endif>Terrible</option>
                                </select>
                            </div>
                            <div>
                                <div class="form-modifier-item " >
                                    <label for="millesime">Millésime</label>
                                    <input type="number" name="millesime" id="millesime" class="input-fiche-cercle" value="{!! $cellierBouteille->millesime !!}"/>
                                </div>
                                <div class="form-modifier-item" >
                                    <label for="prix">Prix d'achat</label>
                                    <input type="number" name="prix" id="prix" class="input-fiche-cercle" value="{!! $cellierBouteille->prix !!}"/>
                                </div>
                                <div class="form-modifier-item" >
                                    <label for="quantite">Qte</label>
                                    <input type="number" name="quantite" id="quantite" class="input-fiche-cercle" value="{!! $cellierBouteille->quantite !!}"/>
                                </div>
                        </div>
                        </div>
                    </div>
                    <div class="millesime-info-fin">
                        <div class="item-commentaire" >
                            <label for="commentaire">Commentaire</label>
                            <input type="textarea" name="commentaire" id="commentaire" class="" value="{!! $cellierBouteille->commentaire !!}"/>
                        </div>
                        <div class="item-commentaire" >
                            <label for="garde_jusqua">À conserver</label>
                            <input type="textarea" name="garde_jusqua" id="garde_jusqua" class="" value="{!! $cellierBouteille->garde_jusqua !!}"/>
                        </div>
                        <div class="item-commentaire" >
                            <label for="date_achat">Date d'achat :</label>
                            <input type="date" name="date_achat" id="date_achat" class="" value="{!! $cellierBouteille->date_achat !!}"/>
                        </div>
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
<link href="{{asset('css/star-rating.css')}}" rel="stylesheet" />
<script src="{{asset('js/star-rating.js')}}"></script>

