@extends('layouts.app')
@section('content')



<h1 class="titre">Liste d'usager</h1>

<div class="padding">
<table class="table striped">
        <thead>
          <tr>
              <th>Nom</th>
              <th>Courriel</th>
              <th>Date d'naissance</th>
              <th>Admin</th>
              <th></th>
          </tr>
        </thead>

        <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{$user->nom}}</td>
            <td>{{$user->courriel}}</td>
            <td>{{$user->date_naissance}}</td>
            <td>
              <form action="#">
              @if($user->admin === 1)
              <p>
                <label>
                  <input type="checkbox" checked="checked"/>
                  <span></span>
                </label>
              </p>
              @else
              <p>
                <label>
                  <input type="checkbox" />
                  <span></span>
                </label>
              </p>
              @endif
              </form>
            </td>

            <td>
              <a class="waves-effect waves-light button modifier margin-right" href="{{ route('custom.edit', $user->id)}}"><i class="material-icons">edit</i></a>
              <a class="waves-effect waves-light button supprimer modal-trigger" href="#"><i class="material-icons">delete</i></a>
            </td>
          </tr>

        @endforeach

       
        </tbody>
      </table>
    
<span class="message"></span>
@endsection

<link href="{{asset('css/liste-usager.css')}}" rel="stylesheet" />

<!-- <link href="{{asset('css/bouteilles.css')}}" rel="stylesheet" /> -->
<!-- <script src="{{asset('js/bouteille_index.js')}}"></script> -->