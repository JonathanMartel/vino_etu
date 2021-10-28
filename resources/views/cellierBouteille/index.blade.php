
@extends('layouts.app')
@section('content')

@if(Session::get('nouvelleBouteille'))
<span class="nouvelleBouteille"></span>
@endif


<header>
    <div class="cellier">
        <span>Cellier | {{ $cellier->nom }}</span>
    </div>
    <div class="emplacement">
        <span>Emplacement | {{ $cellier->localisation }}</span>
    </div>

    <!-- La barre de recherche n'est pas fonctionnel -->

    <!--<div class="row">
      <div class="input-field col s12 recherche">
          <i class="material-icons prefix">search</i>
          <input type="text"  name="recherche" autocomplete="off">
          <label for="recherche">Rechercher un vin</label>
          <div class="autocomplete z-depth-2"></div>
        </div>
      </div>
    <div class="row">-->


</header>


<main>
    <h1>Vos bouteilles</h1>
    <a href="{{ route('ajouterVin', $idCellier) }}">Ajouter un nouveau vin au cellier</a>
    @foreach($cellierBouteilles as $cellierBouteille)
    <section>
        <div class="flex">
            <div class="img-conteneur ">
                <img  class="image" src="{{ asset($cellierBouteille->url_img) }}" alt="{{$cellierBouteille->nom}}">
            </div>
            <div class="info">
                <p>{{$cellierBouteille->pays}}</p>
                <p>{{$cellierBouteille->type}} |   @if( $cellierBouteille->millesime != 0)
                    {{$cellierBouteille->millesime}}
                    @endif
                </p>
                <p>{{$cellierBouteille->quantite}}ml</p>
                <p class="quantite">Qte | {{$cellierBouteille->quantite}}</p>
            </div>

            <div class=" flex bouton-conteneur">
                <div class="bouton-cercle-remove">
                    <a class="icon-item" name="btnRetirerBouteille" href="{{ route('boireBouteille',[
                            'idCellier'=>$cellierBouteille->cellier_id,
                            'idBouteille'=>$cellierBouteille->bouteille_id,
                            'millesime'=> $cellierBouteille->millesime
                            ])}}">
                        <i class="material-icons">remove</i>
                    </a>
                </div>
                <div class="bouton-cercle-add" >
                    <a  class="icon-item" name="btnAjouterBouteille" href="{{ route('ajouterBouteille',[
                            'idCellier'=>$cellierBouteille->cellier_id,
                            'idBouteille'=>$cellierBouteille->bouteille_id,
                            'millesime'=> $cellierBouteille->millesime
                            ])}}">
                        <i class="material-icons">add</i>
                    </a>
                </div>
            </div>
        </div>
        <div class="nomVin">
            <p>{{$cellierBouteille->nom}}</p>
        </div>
    </section>
    @endforeach
</main>




<!-- Page de liste originale -->

<!--
<table class="responsive-table striped highlight">
    <thead>
        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Quantité</th>
            <th>Pays</th>
            <th>Millesime</th>
            <th>Type</th>
            <th>Lien SAQ</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cellierBouteilles as $cellierBouteille)

        <tr>
        
            <td><img src="{{ asset($cellierBouteille->url_img) }}" alt="{{$cellierBouteille->nom}}"></td>
            <td>{{$cellierBouteille->nom}}</td>
            <td name="quantite">{{$cellierBouteille->quantite}}</td>
            <td>{{$cellierBouteille->pays}}</td>
            <td>
                @if( $cellierBouteille->millesime != 0)
                {{$cellierBouteille->millesime}}
                @endif
            </td>
            <td>{{$cellierBouteille->type}}</td>
            <td><a href="{{$cellierBouteille->url_saq}}">Lien SAQ</a></td>
            <td>


                <i class="material-icons">edit</i>
                <a name="btnAjouterBouteille" href="{{ route('ajouterBouteille',[
                        'idCellier'=>$cellierBouteille->cellier_id,
                        'idBouteille'=>$cellierBouteille->bouteille_id,
                        'millesime'=> $cellierBouteille->millesime
                        ])}}">
                    <i class="material-icons">add</i>
                </a>
                <a name="btnRetirerBouteille" href="{{ route('boireBouteille',[
                        'idCellier'=>$cellierBouteille->cellier_id,
                        'idBouteille'=>$cellierBouteille->bouteille_id,
                        'millesime'=> $cellierBouteille->millesime
                        ])}}">
                    <i class="material-icons">remove</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>-->
@endsection

<script src="{{asset('js/cellierBouteille_index.js')}}"></script>
<link href="{{asset('css/cellierBouteillesListe.css')}}" rel="stylesheet" />
<link href="{{asset('css/star-rating.css')}}" rel="stylesheet" />
<script src="{{asset('js/star-rating.js')}}"></script>
<link href="{{asset('css/autocomplete.css')}}" rel="stylesheet" />