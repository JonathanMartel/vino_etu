@extends('layouts.app')

@section('content')


<div class="flex-box">
<div class="row"> 
  
  <div class="col s12 m12">
    <div class="card">
      <div class="card-content">
        <h4>Connectez-vous à votre compte</h4>
      </div>
  <div class="card-content">
    <form action="{{ route('login.custom') }}" method="POST">
      @csrf
      <div class="row">
        <div class="input-field col s12">
          <input id="Email" type="email" class="validate">
          <label for="Email">Adresse de courriel</label>
        </div>
        <div class="input-field col s12">
          <input id="Password" type="text" class="validate">
          <label for="Password">Mot de passe</label>
        </div>
        <div class="input-field col s12">
          <button type="submit" class="waves-effect waves-light btn-small blue right">Ouvrir une session</button>
        </div>
        <!-- <div class="input-field col s12">
          <a href="#" class="right">Mot de passe oublié?</a>
        </div>       -->
        <div class="input-field col s12">
          <a href="/registration" class="right">Nouveau client? Créer un compte</a>
        </div>      
      </div>	
    </form>
  </div>
  </div>
  </div>
  </div>
</div>
 

@endsection