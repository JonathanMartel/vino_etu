@extends('layouts.app')

@section('content')






<div class="flex-box">
<div class="row"> 
  <div class="col s12 m12">
    <div class="card">
      <div class="card-content flex-center entete-page">
        <h4>Connectez-vous à votre compte</h4>
        <img src="{{asset('assets/icon/coupe-verte.svg')}}" class="center" alt="icone coupe verte"></a>
    </div>
  <div class="card-content">
    <form action="{{ route('login.custom') }}" method="POST">
      @csrf
      <div class="row">
        <div class="input-field col s12">
          <input id="courriel" type="email" class="validate" name="courriel" value="{{ old('courriel')}}" required>
          <label for="courriel">Adresse de courriel</label>
          @if ($errors->has('courriel'))
            <span class="red-text">{{ $errors->first('courriel') }}</span>
          @endif
        </div>
        <div class="input-field col s12">
          <input id="mot_de_passe" type="password" class="validate" name="password"  required>
          <label for="mot_de_passe">Password</label>
          @if ($errors->has('password'))
              <span class="red-text">{{ $errors->first('password') }}</span>
          @endif
        </div>
        <div class="input-field col s12">
          <button type="submit" class="btn waves-effect waves-light button right">Ouvrir une session</button>
          @if(session('success'))
                    <div class="text-center p-t-12">
						<span class="red-text">{{ session('success')}}</span>
					</div>
					@endif
        </div>

        <!-- <div class="input-field col s12">
          <a href="#" class="right">Mot de passe oublié?</a>
        </div>       -->
        <div class="input-field col s12">
          <a href="{{ route('register') }}" class="right">Nouveau client? Créer un compte</a>
        </div>      
      </div>	
    </form>
  </div>
  </div>
  </div>
  </div>
</div>
 

@endsection