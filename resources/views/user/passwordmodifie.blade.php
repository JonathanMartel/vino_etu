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
                <input id="newPassword" type="password" class="validate" name="nouveau_password" >
                <label for="newPassword">Nouveau mot de passe</label>
                @if ($errors->has('nouveau_password'))
                    <span class="red-text">{{ $errors->first('nouveau_password') }}</span>
                @endif
              </div>

              <div class="input-field col s12">
                <input id="Password_confirmation" type="password" class="validate" name="password_confirmation" >
                <label for="Password_confirmation">Mot de passe confirmé</label>
                @if ($errors->has('password_confirmation'))
                    <span class="red-text">{{ $errors->first('password_confirmation') }}</span>
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