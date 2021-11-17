@extends('layouts.app')
@section('content')

<h1 class="titre">Modification de bouteilles</h1>

<nav>
    <div class="nav-wrapper">
      <form>
        <div class="input-field">
          <input id="search" type="search" required>
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </form>
    </div>
  </nav>

<table class="table striped highlight responsive-table">
        <thead>
          <tr>
              <th>Image</th>
              <th>Nom</th>
              <th>Pays</th>
              <th>Description</th>
              <th>Code SAQ</th>
              <th>Prix SAQ</th>
              <th>URL SAQ</th>
              <th>Format</th>
              <th>Type</th>
          </tr>
        </thead>

        <tbody>
        @foreach($bouteilles as $bouteille)
          <tr>
            <td><img src="{{$bouteille->url_img}}" alt="{{$bouteille->nom}}"></td>
            <td>{{$bouteille->nom}}</td>
            <td>{{$bouteille->pays}}</td>
            <td>{{$bouteille->description}}</td>
            <td>{{$bouteille->code_saq}}</td>
            <td>{{$bouteille->prix_saq}}</td>
            <td>{{$bouteille->url_saq}}</td>
            <td>{{$bouteille->taille}} cL</td>
            <td>{{$bouteille->type}}</td>

            
          </tr>

        @endforeach
        </tbody>
      </table>
      {!! $bouteilles->links('pagination::bootstrap-4') !!}
<span class="message"></span>
@endsection

<script src="{{asset('js/modifierCatalogue.js')}}"></script>
