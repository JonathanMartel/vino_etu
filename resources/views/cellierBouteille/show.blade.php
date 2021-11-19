@extends('layouts.app')
@section('content')

@if(Session::get('modifieBouteille'))
<span class="modifieBouteille"></span>
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
    <div class="bouteille-nom">
        <select  name ="select-bouteille">
            @foreach($cellierBouteillesByIDs as $vin)
            <option value="{{ $vin['id'] }}" @if( $vin['id'] == $bouteille->id) selected @endif>{{ $vin['bouteille']->nom}} </option>
            @endforeach
        </select>
    </div>
</header>
<main>
    <section class="info-fiche">
        <article class="infoBouteilleConteneur-fiche">
            <div class="">
                <p class="bold">@if($bouteille->pays){{ $bouteille->pays }} | @endif {{ $bouteille->type }}</p>
                <p>{{  $bouteille->format }}</p>
                <p>{{  $bouteille->taille }} cl</p>
                <p>Prix Saq | @if($bouteille->prix_saq)<span class="bold-20px">{{ $bouteille->prix_saq  }} $</span> @else N/A @endif</p>
            </div>
            <div>
                <div class="bouteilleSAQConteneur-fiche">
                    @if($bouteille->url_saq)
                    <a class="lienSAQ" href="{{ $bouteille->url_saq }}">SAQ</a>
                    <div class="cercle ">
                        <i class="material-icon check">check</i>
                    </div>
                    @else
                        <!-- Ajouter boutons modifier et suprimer bouteille ici à la place des infos SAQ !!! -->
                        <p>SAQ</p>
                        <div class="cercle ">
                            <i class="material-icon check">close</i>
                        </div>
                    @endif
                </div>
                @if(!$bouteille->url_saq || Auth::user()->admin)
                    <a class="bouteilleSAQConteneur-fiche" href="{{ route('bouteilleEdit', $bouteille->id)}}"><i class="material-icons-fiche">edit</i></a>
                @endif
            </div>

        </article>
        <article>
            <h2 class="description-titre">Description</h2>
            <p>{{ $bouteille->description ?? "Aucune description" }}</p>
        </article>
        <article>
        <div id="social-links">
            <ul>
                <li>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/" class="social-button " id="" title="" rel="">
                    <span class="fab fa-facebook-square"></span>
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/intent/tweet?text=Your+share+text+comes+here&amp;url=https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/" class="social-button " id="" title="" rel="">
                    <span class="fab fa-twitter"></span>
                    </a>
                </li>
                <li>
                    <a href="https://www.linkedin.com/sharing/share-offsite?mini=true&amp;url=https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/&amp;title=Your+share+text+comes+here&amp;summary=" class="social-button " id="" title="" rel="">
                    <span class="fab fa-linkedin"></span>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="https://telegram.me/share/url?url=https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/&amp;text=Your+share+text+comes+here" class="social-button " id="" title="" rel="">
                    <span class="fab fa-telegram"></span>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="https://wa.me/?text=https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/" class="social-button " id="" title="" rel="">
                    <span class="fab fa-whatsapp"></span>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="https://www.reddit.com/submit?title=Your+share+text+comes+here&amp;url=https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/" class="social-button " id="" title="" rel="">
                    <span class="fab fa-reddit"></span>
                    </a>
                </li>
            </ul>
        </div>
        </article>

    </section>


    <!-- Deuxième section de la fiche d'un vin, le "Millésime -->
    <!-- Bouton millésime, via le clique pour afficher les info -->
    <section class="millesime-conteneur">
        @foreach($cellierBouteilleMillesime as $cellierBouteille)
        <div data-js-bouton="{{ $cellierBouteille->millesime }}">
            <button @if($loop->last) class="millesime-item-selected millesime-item"  @endif id="bouton-millesime"class="millesime-item" >
                @if($cellierBouteille->millesime  != 0)
                    <p>{{ $cellierBouteille->millesime }}</p>
                @else
                    <p>N/A</p>
                @endif
            </button>
        </div>
        @endforeach
    </section>

    <!-- Section du fomulaire -->

    <section class="">
        <div class="form-modifier form">
            <form id="" name="myForm" action="" method="POST" class="form-modifier" data-js-form> 
                @method('PUT')
                @csrf
                <div class="millesime-info-debut">
                    <!-- L'image  -->
                    @if (isset($bouteille->url_img))
                        <img class="image-fiche" src="{{ $bouteille->url_img}}" alt="">
                    @else
                        <img class="image-fiche" src="{{asset('assets/icon/bouteille-fiche-vin.svg')}}" alt="">
                    @endif
                    <div> 
                        <div class="select-form"> <!-- La note de 0 à 5 sous forme d'étoiles -->
                            <select class="star-rating"  name="note"  data-id-bouteille="{{$cellierBouteille->bouteille_id}}" data-millesime="{{$cellierBouteille->millesime}}">
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
                                <!-- Le champs millésime n'est pas modifiable -->
                                <label for="millesime">Millésime</label>
                                <input  name="millesime" readonly="readonly" id="millesime"  class="input-fiche-cercle" value="@if($cellierBouteille->millesime != 0){{ $cellierBouteille->millesime }} @else N/A @endif"/>
                            </div>
                            <div class="form-modifier-item" >
                                <label for="prix">Prix d'achat</label>
                                <input type="number" name="prix"  readonly="readonly" id="prix" data-js-input class="input-fiche-cercle" value="{!! $cellierBouteille->prix !!}"/>
                            </div>
                            <p id="messagePrix" class="nonValide"></p>
                            <div class="form-modifier-item" >
                                <label for="quantite">Qte</label>
                                <input type="number" name="quantite" readonly="readonly" id="quantite" data-js-input class="input-fiche-cercle" value="{!! $cellierBouteille->quantite !!}"/>
                            </div>
                            <p id="messageQuantite" class="nonValide"></p>
                        </div>
                    </div>
                </div>
                <div class="millesime-info-fin">
                    <div class="item-commentaire" >
                        <label for="commentaire">Commentaire</label>
                        <input type="textarea" name="commentaire" readonly="readonly" id="commentaire" data-js-input class="textarea" placeholder="Aucun commentaire" value="{{ $cellierBouteille->commentaire }}"/>
                        <p id="messageCommentaire" class="nonValide"></p>
                    </div>
                    <div class="item-commentaire" >
                        <label for="garde_jusqua">Garder jusqu'à</label>
                        <input type="textarea" name="garde_jusqua" readonly="readonly" placeholder="Non disponible" id="garde_jusqua" data-js-input class="textarea" value="{!! $cellierBouteille->garde_jusqua !!}"/>
                        <p id="messageGardeJusqua" class="nonValide"></p>
                    </div>
                    <div class="item-commentaire" >
                        <label for="date_achat">Date d'achat :</label>
                        <input type="text" name="date_achat" disabled tabindex="-1" autocomplete="off" class="datepicker" id="date_achat" data-js-input class="" value="{!! $cellierBouteille->date_achat !!}"/>
                    </div>
                </div>

                <!-- Validation non fonctionnelle, à terminer dans le sprint 3 -->
                <!-- Boutons, modifier, annuler, valider, suprimer -->

                <div class="bouton">
                    <button class="bouton-fiche valider"  data-js-modifier>Modifier</button>
                    <button class="bouton-fiche non-active" data-js-btnAnnuler>Annuler</button> 
                    <button  class="bouton-fiche valider non-active modal-trigger" href="#modal-valider" data-js-btnValider >Valider</button>
                    <button class="bouton-fiche effacer non-active modal-trigger" href="#modal-suprimer"  data-js-btnEffacer >Suprimer</button>
                </div>

                <!-- Modal bouton suprimer -->
                <div id="modal-suprimer" class="modal">
                    <div class="modal-content">
                        <h4>Supprimer ce millésime</h4>
                        <p>Êtes-vous certain de vouloir supprimer ce millésime et les informations qu'il contient?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="waves-effect waves-green btn-flat modale-close" data-js-suprimerModal >Supprimer</button>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
                    </div>
                </div>
                 <!-- Modal bouton valider -->
                 <div id="modal-valider" class="modal">
                    <div class="modal-content">
                        <h4>Modifier ce millésime</h4>
                        <p>Êtes-vous certain de vouloir modifier ce millésime, en cliquant valider les informations seront modifiées.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="waves-effect waves-green btn-flat modal-close" data-js-validerModal >Valider</button>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>


@endsection

<!-- Script et CSS -->
<script src="{{asset('js/cellierBouteille_show.js')}}"></script> 
<link href="{{asset('css/cellierBouteillesListe.css')}}" rel="stylesheet" />
<link href="{{asset('css/star-rating.css')}}" rel="stylesheet" />
<link href="{{asset('css/fiche-vin.css')}}" rel="stylesheet" />
<script src="{{asset('js/star-rating.js')}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<script src="{{asset('js/cellier_index.js')}}"></script>



