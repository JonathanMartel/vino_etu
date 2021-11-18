@extends('layouts.app')
@section('content')

@if(Session::get('modifieBouteille'))
<span class="modifieBouteille"></span>
@endif

@if(Session::get('deleteBouteille'))
<span class="deleteBouteille"></span>
@endif

<h1 class="titre">Modification de bouteilles</h1>

<nav class="white ">
    <div class="nav-wrapper">
      <form>
        <div class="input-field">
          <input id="search" type="search" required>
          <label class="label-icon" for="search"><i class="material-icons black-text">search</i></label>
          <i id="close" class="material-icons">close</i>
        </div>
      </form>
    </div>
  </nav>

<div id="table">
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
            <tr data-id="{{$bouteille->id}}">
              <td><img src="{{$bouteille->url_img}}" alt="{{$bouteille->nom}}"></td>
              <td>{{$bouteille->nom}}</td>
              <td>{{$bouteille->pays}}</td>
              <td>{{$bouteille->description}}</td>
              <td>{{$bouteille->code_saq}}</td>
              <td>{{number_format((float)$bouteille->prix_saq, 2, '.', '')}} $</td>
              <td>{{$bouteille->url_saq}}</td>
              <td>{{$bouteille->taille}} cL</td>
              <td>{{$bouteille->type}}</td>
  
  
            </tr>
  
          @endforeach
          </tbody>
        </table>
        {!! $bouteilles->links('pagination::bootstrap-4') !!}
</div>
<span class="message"></span>
@endsection

<script src="{{asset('js/modifierCatalogue.js')}}"></script>
<link href="{{asset('css/liste-usager.css')}}" rel="stylesheet" />
<link href="{{asset('css/modifierCatalogue.css')}}" rel="stylesheet" />