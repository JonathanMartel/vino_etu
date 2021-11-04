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
                    <div class="flex-row space">   
                        <div  class="flex-row"> 
                            <i class="small material-icons black-text">account_circle</i>
                            <p>{{$nom}}</p>
                        </div>    
                        <i class="small material-icons black-text" data-js-modifie>edit</i>
                    </div>
                    <div class="flex-row space hidden" data-js-button>
                        <input type="text" name="nom" data-js-inputNom>
                        <button class="waves-effect waves-light btn-small" data-js-btnNom>Modifier</button>
                    </div>
                    <span class="red-text"></span>
                    
                    <div class="flex-row space">    
                        <div  class="flex-row">
                            <i class="small material-icons black-text">email</i>
                            <p>{{$courriel}}</p>    
                        </div>    
                        <i class="small material-icons black-text" data-js-modifie>edit</i>    
                    </div>
                    <div class="flex-row space hidden" data-js-button>
                        <input type="text" name="courriel" data-js-inputCourriel>
                        <button class="waves-effect waves-light btn-small" data-js-btnCourriel>Modifier</button>
                    </div>

                    <div class="flex-row space">    
                        <div  class="flex-row">
                            <i class="small material-icons black-text">cake</i>
                            <p>{{$date_naissance}}</p>  
                        </div>    
                        <i class="small material-icons black-text" data-js-modifie>edit</i> 
                    </div>    
                    <div class="flex-row space hidden" data-js-button>
                        <input type="text" name="date_naissance" data-js-inputDateNaissance>
                        <button class="waves-effect waves-light btn-small" data-js-btnDateNaissance>Modifier</button>
                    </div>     
                </div>
            </div>

            <div class="card">
                <div class="card-content hoverclass">
                    <a href="{{ route('custom.edit', $id)}}">
                        <div class="flex-row">    
                        <i class="small material-icons black-text">account_box</i>
                        <h6>Gérer mon compte</h6>      
                        </div>      
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-content hoverclass">
                    <a href="/cellier">
                    <div class="flex-row space">  
                        <h6>Vos celliers</h6>   
                        <i class="small material-icons black-text">chevron_right</i>   
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

<script src="{{asset('js/dashboard.js')}}"></script>
