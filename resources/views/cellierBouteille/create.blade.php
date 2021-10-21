@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">search</i>
          <input type="text" name="autocomplete" autocomplete="off">
          <label for="autocomplete">Recherche</label>
          <ul></ul>
        </div>
      </div>
    </div>
  </div>
<div class="row">
    <form class="col s12">
        <div class="input-field col s6">
          <input id="nom" type="text" class="validate">
          <label for="nom">Nom</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
      </div>
  
    </form>
 
@endsection

<script src="{{asset('js/cellierBouteille_create.js')}}"></script>