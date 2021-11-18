@extends('layouts.app')

@section('content')
<script src="{{asset('js/cellier_index.js')}}"></script>
<link href="{{asset('css/adminmodifieuser.css')}}" rel="stylesheet" />



<div class="flex-box">
  <div class="row"> 
    
    <div class="col s12 m12">
      <div class="card">
        <div class="card-content flex-center entete-login">
          <h1 class="titre-formulaire">Gérer un compte</h1>
          <!-- <img src="{{asset('assets/icon/bouteille-diagonale.svg')}}" class="center" alt="icone bouteille diagonale"></a> -->
        </div>

        <div class="card-content">
          <form action="{{ route('adminuser.update', $id) }}" method="POST">
          @method('PUT')
          @csrf
            <div class="row">
              <div class="input-field col s12">
                  <input id="nom" type="text" class="validate" name="nom" value="{{ $nom }}">
                  <label for="nom">Nom et prénom</label>
                  @if ($errors->has('nom'))
                      <span class="red-text">{{ $errors->first('nom') }}</span>
                  @endif
              </div>

              <div class="input-field col s12">
                  <input id="date_naissance" type="text" class="validate" name="date_naissance" value="{{ $date_naissance }}">
                  <label for="date_naissance">Date de naissance(aaaa-mm-jj)</label>
                  @if ($errors->has('date_naissance'))
                      <span class="red-text">{{ $errors->first('date_naissance') }}</span>
                  @endif
              </div>

              <div class="input-field col s12">
                <input id="courriel" type="email" class="validate" name="courriel" value="{{ $courriel }}">
                <label for="courriel">Adresse de courriel</label>
                @if ($errors->has('courriel'))
                    <span class="red-text">{{ $errors->first('courriel') }}</span>
                @endif
              </div>

              <div class="input-field col s12">
                <div class="flex-row">
                <span>Admin</span>
                 @if(isset($user->admin))
                  <label>
                    <input type="checkbox" name="admin" checked="checked">
                    <span></span></label>
                    @else
                    <label>
                    <input type="checkbox" name="admin">
                    <span></span>
                    @endif
                  </label>
                </div>
              </div>


              <div class="input-field col s12">
                <input id="Password" type="password" class="validate" name="password" >
                <label for="Password">Mot de passe d'administrateur</label>
                @if ($errors->has('password'))
                    <span class="red-text">{{ $errors->first('password') }}</span>
                @endif
              </div>
            
              <div class="input-field col s12 flex-row">  
                <a href="{{ route('gererUsagers') }}" class="btn waves-effect waves-light button btn-annuler"  name="annuler">Annuler</a>
                <a class="btn waves-effect waves-light button btn-modifier modal-trigger" href="#modal-modifier">Modifier</a>

                <!-- Modal Structure pour modifier-->
                <div id="modal-modifier" class="modal">
                <div class="modal-content">
                    <h4>Modifier les informations personnelles</h4>
                    <p>Êtes-vous certain de vouloir modifier les informations personnelles de <span>{{ ucfirst($nom) }}</span>? </p>
                </div>
                <div class="modal-footer">
                    
                  <button type="submit" class="modal-close waves-effect waves-green btn-flat">Modifier</button>
                  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
                </div>
        </div>


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