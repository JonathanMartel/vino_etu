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
                        <i class="small material-icons">cake</i>
                        <p>{{$date_naissance}}</p>   
                    </div>         
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                    
                    <div class="flex-row">    
                      <i class="small material-icons">account_box</i>
                      <h6>Gérer mon compte</h6>      
                    </div>      
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                    <a href="/cellier">
                    <div class="flex-row space">  
                        <h6>Vos celliers</h6>   
                        <i class="small material-icons">chevron_right</i>   
                    </div> </a>     
                </div>
            </div>

            <!-- <div class="card">
                <div class="card-content">
                    
                    <div class="flex-row space">    
                      <a href="/cellier">
                        <h6>Vos vins</h6>   
                        <i class="small material-icons">chevron_right</i>
                      </a>
                    </div>      
                </div>
            </div> -->


        </div>
    </div>
</div>


@endsection