@extends('layouts.app')

@section('content')

<div class="">
    <div class="row"> 
    
        <div class="col s12 m12">
            <div class="card">
                <div class="card-content flex-center">
                    <h4>Bienvenue!</h4><h4 class="">{{$nom}}</h4>
                </div>
                <div class="card-content">
                    <h6>Tableau de bord des comptes</h6>
                    <div class="flex-row">    
                        <i class="small material-icons">email</i>
                        <p>{{$courriel}}</p>    
                    </div>
                    <div class="flex-row">    
                        <i class="small material-icons">today</i>
                        <p>{{$date_naissance}}</p>   
                    </div>         
                </div>
                
            </div>
        </div>
    </div>
</div>


@endsection