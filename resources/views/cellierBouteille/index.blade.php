
@extends('layouts.app')
@section('content')

@if(Session::get('nouvelleBouteille'))
<span class="nouvelleBouteille"></span>
@endif


<header>
    <div class="cellier">
        <span>Cellier | Party de bureau</span>
    </div>
    <div class="emplacement">
        <span>Emplacement | Maison</span>
    </div>
    <div class="row">
      <div class="input-field col s12 recherche">
          <i class="material-icons prefix">search</i>
          <input type="text"  name="recherche" autocomplete="off">
          <label for="recherche">Rechercher un vin</label>
          <div class="autocomplete z-depth-2"></div>
        </div>
      </div>
    <div class="row">
</header>


<main>
    <h1>Vos bouteilles</h1>
    <a href="{{ route('ajouterVin', $idCellier) }}">Ajouter un nouveau vin au cellier</a>
    @foreach($cellierBouteilles as $cellierBouteille)
    <section>
        <div class="flex">
            <div>
                <img src="{{ asset($cellierBouteille->url_img) }}" alt="{{$cellierBouteille->nom}}">
            </div>
            <div class="info">
                <p>{{$cellierBouteille->pays}}</p>
                <p>{{$cellierBouteille->type}} |   @if( $cellierBouteille->millesime != 0)
                    {{$cellierBouteille->millesime}}
                    @endif
                </p>
                <p>Qte | {{$cellierBouteille->quantite}}</p>
            </div>
            <div class="bouton-conteneur">
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
</table>
@endsection

<script src="{{asset('js/cellierBouteille_index.js')}}"></script>
<link href="{{asset('css/cellierBouteillesListe.css')}}" rel="stylesheet" />