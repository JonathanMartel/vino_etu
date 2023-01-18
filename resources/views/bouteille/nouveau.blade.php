
<h1>Ajout d'une bouteille à un cellier</h1>
<form>
    @csrf
<input type="text" name="recherche" id="recherche" class="form-controller" onkeyup="fetchData()">
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody id="tbodyfordata">
        <!-- Data will be appened here -->
    </tbody>
</table>

<script>
    function fetchData()
	{
       
		//recherche Value
		const val = document.getElementById('recherche').value;

		//recherche Url
		//const url = {{route('bouteille.recherche')}};
        const url = "{{route('bouteille.recherche')}}";
		
		fetch(url,
            {   method:'POST',
                headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            "X-CSRF-Token": document.querySelector('input[name=_token]').value
                        }
            })
		.then((resp) => resp.json()) //Transforme  data en json
		.then(function(data){
			console.log(data);

			var tbodyref  = document.getElementById('tbodyfordata');
			console.log(tbodyref);
			tbodyref.innerHTML = '';

			let bouteilles = data;
			console.log(bouteilles);
			bouteilles.map(function(bouteille){
				let tr = createNode('tr'),
					nom = createNode('td');
					nom.innerText = bouteille.nom;
					append(tr,nom);
					append(tbodyref,tr);
				});			
		})
		.catch(function(error){
			console.log(error);
		})
	}

	function createNode(element)
	{
		return document.createElement(element);
	}

	function append(parent,el)
	{
		return parent.appendChild(el);
	}
</script>