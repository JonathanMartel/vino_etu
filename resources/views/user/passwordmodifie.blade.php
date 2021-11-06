@extends('layouts.app')

@section('content')
<div class="flex-box">
  <div class="row"> 
    
    <div class="col s12 m12">
      <div class="card">
        <div class="card-content flex-center entete-login">
          <h1 class="titre-formulaire">Gérer mon mot de passe</h1>
          <!-- <img src="{{asset('assets/icon/bouteille-diagonale.svg')}}" class="center" alt="icone bouteille diagonale"></a> -->
        </div>

        <div class="card-content">
          <form action="{{ route('password.update', $id) }}" method="POST">
          @method('PUT')
          @csrf
            <div class="row">

              <div class="input-field col s12">
                <input id="oldPassword" type="password" class="validate" name="old_password" >
                <label for="oldPassword">Mot de passe actuel</label>
                @if ($errors->has('old_password'))
                    <span class="red-text">{{ $errors->first('old_password') }}</span>
                @endif
              </div>

              <div class="input-field col s12">
                <input id="nouveau_mot_de_passe" type="password" class="validate" name="nouveau_mot_de_passe" >
                <label for="nouveau_mot_de_passe">Nouveau mot de passe</label>
                @if ($errors->has('nouveau_mot_de_passe'))
                    <span class="red-text">{{ $errors->first('nouveau_mot_de_passe') }}</span>
                @endif
              </div>

              <div class="input-field col s12">
                <input id="mot_de_passe_confirme" type="password" class="validate" name="mot_de_passe_confirme" >
                <label for="mot_de_passe_confirme">Mot de passe confirmé</label>
                @if ($errors->has('mot_de_passe_confirme'))
                    <span class="red-text">{{ $errors->first('mot_de_passe_confirme') }}</span>
                @endif
              </div>
            
              <div class="input-field col s12 flex-row">  
                <a href="/dashboard" class="btn waves-effect waves-light button btn-annuler"  name="annuler">Annuler</a>
                <button type="submit" class="btn waves-effect waves-light button btn-modifier">Modifier</button>
              </div>
              @if(session('success'))
                <div class="text-center p-t-12">
                  <span class="red-text">{{ session('success')}}</span>
                </div>
              @endif
              
              
              
            </div>	
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection