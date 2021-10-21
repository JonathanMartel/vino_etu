@extends('layouts.app')
@section('content')
<h1>Un petit verre de vino ?</h1>
<a href="{{ route('ajouterNouvelleBouteille') }}">Ajouter une nouvelle bouteille au ceillier</a>
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
        <td><img src="{{$cellierBouteille->bouteille->url_img}}" alt=""></td>
        <td>{{$cellierBouteille->bouteille->nom}}</td>
        <td name="quantite">{{$cellierBouteille->quantite}}</td>
        <td>{{$cellierBouteille->bouteille->pays}}</td>
        <td>
            @if( $cellierBouteille->millesime != 0)
                {{$cellierBouteille->millesime}}
            @endif
        </td>
        <td>{{$cellierBouteille->bouteille->type->type}}</td>
        <td><a href="{{$cellierBouteille->bouteille->url_saq}}">Lien SAQ</a></td>
        <td> 
           
        
            <i class="material-icons">edit</i>
            <a name="btnAjouterBouteille" href="{{ route('ajouterBouteille',[
                    'idCellier'=>$cellierBouteille->cellier_id,
                    'idBouteille'=>$cellierBouteille->bouteille_id,
                    'millesime'=> $cellierBouteille->millesime
                    ])}}"><i class="material-icons">add</i>
            </a>
            <a href="{{ route('boireBouteille',[
                    'idCellier'=>$cellierBouteille->cellier_id,
                    'idBouteille'=>$cellierBouteille->bouteille_id,
                    'millesime'=> $cellierBouteille->millesime
                    ])}}"><i class="material-icons">remove</i>
            </a>
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

<script src="{{asset('js/cellierBouteille_index.js')}}"></script>