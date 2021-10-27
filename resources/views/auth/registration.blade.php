@extends('layouts.app')

@section('content')


<div class="flex-box">
  <div class="row"> 
    
    <div class="col s12 m12">
      <div class="card">
        <div class="card-content flex-center">
          <h4>Créer un compte</h4>
          <img src="{{asset('assets/icon/logo-3-bouteilles-cellier.svg')}}" class="center"></a>
        </div>

        <div class="card-content">
          <form action="{{ route('register.custom') }}" method="POST">
          @csrf
            <div class="row">
              <div class="input-field col s12">
                  <input id="nom" type="text" class="validate" name="nom" value="{{ old('nom')}}">
                  <label for="nom">Nom et prénom</label>
                  @if ($errors->has('nom'))
                      <span class="red-text">{{ $errors->first('nom') }}</span>
                  @endif
              </div>

              <div class="input-field col s12">
                  <input id="date_naissance" type="text" class="validate" name="date_naissance" value="{{ old('date_naissance')}}">
                  <label for="date_naissance">Date de naissance(aaaa-mm-jj)</label>
                  @if ($errors->has('date_naissance'))
                      <span class="red-text">{{ $errors->first('date_naissance') }}</span>
                  @endif
              </div>

              <div class="input-field col s12">
                <input id="courriel" type="email" class="validate" name="courriel" value="{{ old('courriel')}}">
                <label for="courriel">Adresse de courriel</label>
                @if ($errors->has('courriel'))
                    <span class="red-text">{{ $errors->first('courriel') }}</span>
                @endif
              </div>

              <div class="input-field col s12">
                <input id="Password" type="password" class="validate" name="password">
                <label for="Password">Mot de passe</label>
                @if ($errors->has('password'))
                    <span class="red-text">{{ $errors->first('password') }}</span>
                @endif
              </div>

              <div class="input-field col s12">
                <button type="submit" class="waves-effect waves-light btn-small right">Créer compte</button>
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