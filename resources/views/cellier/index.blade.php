@extends('layouts.app')
@section('content')
<h1>Un petit verre de vino ?</h1>

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
    @foreach($cellier as $cellierBouteille)
      

        <tr>
        <td><img src="{{$cellierBouteille->bouteille->url_img}}" alt=""></td>
        <td>{{$cellierBouteille->bouteille->nom}}</td>
        <td>{{$cellierBouteille->quantite}}</td>
        <td>{{$cellierBouteille->bouteille->pays}}</td>
        <td>{{$cellierBouteille->bouteille->millesime}}</td>
        <td>{{$cellierBouteille->bouteille->type->type}}</td>
        <td><a href="{{$cellierBouteille->bouteille->url_saq}}">Lien SAQ</a></td>
        <td> 
            <i class="material-icons">edit</i>
            <a href="{{ route('ajouterBouteille',[
                    'idCellier'=>$cellierBouteille->cellier_id,
                    'idBouteille'=>$cellierBouteille->bouteille_id,
                    ])}}"><i class="material-icons">add</i></a>
        </td>
        </tr>
        @endforeach
    </tbody>
</table>



@endsection