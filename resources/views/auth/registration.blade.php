@extends('layouts.app')

@section('content')


<div class="flex-box">
<div class="row"> 
  
  <div class="col s12 m12">
    <div class="card">
      <div class="card-content">
        <h4>Créer un compte</h4>
      </div>
  <div class="card-content">
    <form action="{{ route('register.custom') }}" method="POST">
    @csrf
      <div class="row">
      <div class="input-field col s12">
          <input id="nom" type="text" class="validate">
          <label for="nom">Nom du compte</label>
        </div>

        <div class="input-field col s12">
          <input id="Email" type="email" class="validate">
          <label for="Email">Adresse de courriel</label>
        </div>
        <div class="input-field col s12">
          <input id="Password" type="text" class="validate">
          <label for="Password">Mot de passe (minimum de 6 caractères)</label>
        </div>
        <div class="input-field col s12">
          <button type="submit" class="waves-effect waves-light btn-small blue right">Créer compte</button>
        </div>
        <div class="input-field col s12">
          <a href="{{ route('login') }}" class="right">Vous avez déjà un compte? Ouvrir une session</a>
        </div>      
      </div>	
    </form>
  </div>
  </div>
  </div>
  </div>
</div>
 

@endsection