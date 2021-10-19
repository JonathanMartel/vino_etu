<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">  
      </script>    
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="{{asset('css/main.css')}}" rel="stylesheet" />
        
<h1>Un petit verre de vino ?</h1>
<a href="{{ route('ajouterNouveauBouteille')}}">Ajouter une bouteille au cellier</a>
<table class="responsive-table striped highlight">
        <thead>
          <tr>
              <th>Image</th>
              <th>Nom</th>
              <th>Quantité</th>
              <th>Pays</th>
              <th>Millesime</th>
              <th>Lien SAQ</th>
              <th>Actions</th>
          </tr>
        </thead>

        <tbody>
@foreach($cellier as $cellier) 
    @if(isset($cellier->bouteille))



        <tr>
        <td><img src="{{$cellier->bouteille->url_img}}" alt=""></td>
        <td>{{$cellier->bouteille->nom}}</td>
        <td>{{$cellier->quantite}}</td>
        <td>{{$cellier->bouteille->pays}}</td>
        <td>{{$cellier->bouteille->type->nom}}</td>
        <td><a href="{{$cellier->bouteille->url_saq}}">Lien SAQ</a></td>
        <td> 
            <i class="material-icons">edit</i>
            <a href="{{ route('ajouterBouteille', $cellier->id) }}"><i class="material-icons">add</i></a>
            <a href="{{ route('boireBouteille', $cellier->id) }}"><i class="material-icons">remove</i></a>
        </td>
        </tr>
    @endif
@endforeach
    </tbody>
      </table>