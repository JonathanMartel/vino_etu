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
              <td class="nom">{{$user->nom}}</td>
              <td>{{$user->courriel}}</td>
              <td>{{$user->date_naissance}}</td>
              <td>
                
                @if($user->admin === 1)
                <!-- <i class="material-icons small black-text">check</i> -->
                <span>Oui</span>
                @else
                <!-- <i class="material-icons small black-text">close</i> -->
                <span>Non</span>
                @endif
                </form>
              </td>

              <td>
                <a class="waves-effect waves-light button modifier margin-right" href="{{ route('adminuser.edit', $user->id)}}"><i class="material-icons">edit</i></a>
                @if(Auth::user()->id === $user->id)
                <a class="waves-effect waves-light button supprimer modal-trigger" href="#modaladmin"><i class="material-icons">delete</i></a>
                <!-- Modal Structure supprimer-->
                <div id="modaladmin" class="modal">
                  <div class="modal-content">
                      <h4>Supprimer ce usager</h4>
                      <p>Vous ne pouvez pas supprimer vous-même!</p>
                  </div>
                  <div class="modal-footer">
                    
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
                  </div>
                </div>

                @else

                <a class="waves-effect waves-light button supprimer modal-trigger" href="#{{$user->id}}"><i class="material-icons">delete</i></a>
                @endif
                <!-- Modal Structure supprimer-->
                <div id="{{$user->id}}" class="modal">
                  <div class="modal-content">
                      <h4>Supprimer ce usager</h4>
                      <p>Êtes-vous certain de supprimer le usager <span>{{ ucfirst($user->nom) }}</span>?</p>
                  </div>
                  <div class="modal-footer">
                    <form action="{{ route('user.destroy', $user->id)}}" method="POST">
                      @method('DELETE')
                      @csrf
                      <button class="waves-effect waves-green btn-flat">Supprimer</button>
                    </form>
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Annuler</a>
                  </div>
                </div>
              </td>
            </tr>
          
          
          
          

        @endforeach

       
        </tbody>
      </table>