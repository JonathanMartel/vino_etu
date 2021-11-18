<table class="table striped highlight responsive-table">
        <thead>
          <tr>
              <th>Image</th>
              <th>Nom</th>
              <th>Pays</th>
              <th>Description</th>
              <th>Code SAQ</th>
              <th>Prix SAQ</th>
              <th>URL SAQ</th>
              <th>Format</th>
              <th>Type</th>
          </tr>
        </thead>

        <tbody>
        @foreach($bouteilles as $bouteille)
          <tr>
            <td><img src="{{$bouteille->url_img}}" alt="{{$bouteille->nom}}"></td>
            <td>{{$bouteille->nom}}</td>
            <td>{{$bouteille->pays}}</td>
            <td>{{$bouteille->description}}</td>
            <td>{{$bouteille->code_saq}}</td>
            <td>{{number_format((float)$bouteille->prix_saq, 2, '.', '')}} $</td>
            <td>{{$bouteille->url_saq}}</td>
            <td>{{$bouteille->taille}} cL</td>
            <td>{{$bouteille->type}}</td>

            
          </tr>

        @endforeach
        </tbody>
      </table>
      {!! $bouteilles->links('pagination::bootstrap-4') !!}