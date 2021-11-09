@extends('layouts.app')
@section('content')

@if(Session::get('nouvelleBouteille'))
<span class="nouvelleBouteille"></span>
@endif



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


</header>

<main>
    <div class="bouton-ajout-vin-conteneur">
        <a class="bouton-ajout-vin" href="{{ route('ajouterVin', $cellier->id) }}"><i class="material-icon">add</i> Ajouter un vin</a>

        <div class="search-container">
            <form action="/search" method="get">
                <input class="search expandright" id="searchright" type="search" name="q" placeholder="Rechercher une bouteille" autocomplete="off">
                <label class="button searchbutton" for="searchright"><span class="mglass">&#9906;</span></label>
            </form>
        </div>
    
    </div>


    <div class="articlesConteneur">
        @forelse ($cellierBouteillesByIDs as $vin)
        <article class="articleVin">
            <a href="{{route('ficheVin', [
                    'idCellier'=>$cellier->id,
                    'idBouteille'=>$vin['id'],
                    ]) }}">
                <div class="nomVinConteneur">
                    <h2 class="underline">{{$vin['bouteille']->nom}}</h2>
                </div>
            </a>

           
            <div class="infoBouteilleConteneur">
                @if(isset($vin['bouteille']->url_img))
                    <img class="image" src="{{$vin['bouteille']->url_img}}" alt="{{$vin['bouteille']->nom}}">
                @else
                    <img class="image" src="{{asset('assets/icon/bouteille-fiche-vin.svg')}}" alt="Image {{$vin['bouteille']->nom}}">
                @endif               

                <div class="info">
                    <div>
                    @if(isset($vin['bouteille']->pays))
                        <p>{{$vin['bouteille']->pays}}</p>
                    @else
                        <p>Pays:non</p>
                    @endif
                    <p>{{$vin['bouteille']->type}}</p>
                    </div>
                    
                    <p class="taille">{{$vin['bouteille']->taille}} cl</p>
                </div>
                <div class="bouteilleSAQConteneur">
                    @if($vin['bouteille']->url_saq)
                    <a class="lienSAQ underline" href="{{$vin['bouteille']->url_saq}}">SAQ</a>
                    <div class="cercle ">
                        <i class="material-icon check">check</i>
                    </div>

                    @else

                    <!-- Ajouter boutons modifier et suprimer bouteille ici à la place des infos SAQ !!! -->
                    <p class="nonlienSAQ">SAQ</p>
                    <div class="cercle ">
                        <i class="material-icon check">close</i>
                    </div>
                    <!-- <div class="cercle nonborder">
                        <i class="material-icon">edit</i>
                    </div>
                    <div class="cercle nonborder">
                        <i class="material-icon">delete</i>
                    </div> -->




                    @endif
                </div>
            </div>

            <div class="infoCellierBouteilleConteneur">
                @foreach ($vin['dataCellier'] as $bouteille)
                <section class="infoCellierBouteille">
                    <div class="infoUnitaires">
                    
                        @if($bouteille->millesime > 0)
                        <p>{{$bouteille->millesime }}</p>
                        @else
                        <p>Non millisimé</p>
                        @endif
                        <div class="select">
                            <select class="star-rating" data-id-bouteille="{{$vin['id']}}" data-millesime="{{$bouteille->millesime}}" name="note">
                                <option value="">Choisir une note</option>
                                <option value="5" @if( $bouteille->note == 5) selected @endif>Excellent</option>
                                <option value="4" @if( $bouteille->note == 4) selected @endif>Très bon </option>
                                <option value="3" @if( $bouteille->note == 3) selected @endif>Passable</option>
                                <option value="2" @if( $bouteille->note == 2) selected @endif>Médiocre</option>
                                <option value="1" @if( $bouteille->note == 1) selected @endif>Terrible</option>
                            </select>
                        </div>

                        <p class="quantite">Quantité : <span>{{$bouteille->quantite}}</span></p>
                    </div>
                    <div class=" flex bouton-conteneur">
                        <div class="cercle bouton-cercle-remove">
                            <a class="btn-floating btn-large waves-effect waves-light " name="btnRetirerBouteille" href="{{ route('boireBouteille',[
                            'idCellier'=>$cellier->id,
                            'idBouteille'=>$vin['id'],
                            'millesime'=> $bouteille->millesime,
                            ])}}">
                                <i class="material-icon">remove</i>
                            </a>
                        </div>
                        <div class="cercle bouton-cercle-add">
                            <a class="btn-floating btn-large waves-effect waves-light" name="btnAjouterBouteille" href="{{ route('ajouterBouteille',[
                            'idCellier'=>$cellier->id,
                            'idBouteille'=>$vin['id'],
                            'millesime'=> $bouteille->millesime,
                            ])}}">
                                <i class="material-icon">add</i>
                            </a>
                        </div>
                        
                    </div>
                </section>
                @endforeach
            </div>
        </article>
            @empty
    <div class="list-empty">
        <p>Vous n'avez pour l'instant aucun vin.</p>
    </div>
        
        @endforelse
    </div>



    

</main>
@endsection

<script src="{{asset('js/cellierBouteille_index.js')}}"></script>
<link href="{{asset('css/cellierBouteillesListe.css')}}" rel="stylesheet" />
<link href="{{asset('css/star-rating.css')}}" rel="stylesheet" />
<script src="{{asset('js/star-rating.js')}}"></script>
<link href="{{asset('css/autocomplete.css')}}" rel="stylesheet" />
<link href="{{asset('css/barre-recherche.css')}}" rel="stylesheet" />