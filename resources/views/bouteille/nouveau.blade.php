
<h1>Ajout d'une bouteille à un cellier</h1>
<form name="recherche">
    @csrf
<input type="text" name="recherche" id="recherche" class="form-controller" onkeyup="fetchData()">
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
<table id="listeAutoComplete">
    <thead>
        <tr>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody id="tbodyfordata">
        <!-- Data will be appened here -->
    </tbody>
</table>

<div id="nouvelleBouteille">
	<form id="formAjoutBouteille">
		@csrf
	
		 <!-- Obligatoire -->
		  <label for="nom"> * Nom  :</label>
		  <input id="nom" name="nom" type="text" value="" required>
		  <br>
		  <span>* Type :</span>
		  <br>
		  <input type="radio" name="type" id="rouge" value="1" required>
		  <label for="rouge">Rouge</label>
		  <input type="radio" name="type" id="blanc" value="2">
		  <label for="blanc">Blanc</label>
		  <input type="radio" name="type" id="rose" value="3">
		  <label for="rose">Rosé</label>
		  <br>
		  <!-- Pas obligatoire -->
		  <label for="pays">Pays :</label>
		  <input id="pays" name="pays" type="text" value="">
		  <br>
		  <label for="format">Format :</label>
		  <input id="format" name="format" type="text" value="">
		  <br>
		  <label for="millesime">Millesime :</label>
		  <input id="millesime" name="millesime" type="text" value="">
		  <br>
		  <label for="description">Description</label>
		  <textarea id="description" name="description"></textarea>
		  <br>
		  <!-- Caché non obligatoire -->
		  <input id="url_saq" name="url_saq" type="hidden" value="">
		  <input id="code_saq" name="code_saq" type="hidden" value="">
		  <input id="image" name="image" type="hidden" value="">
		  <input id="prix_saq" name="prix_saq" type="hidden" value="">
		  <input id="url_img" name="url_img" type="hidden" value="">
	
		  <button>Ajouter</button>

		</form>

</div>

<!-- SCRIPT-->
<script>
    function fetchData()
	{
       
		//recherche Value
		let elRecheche = document.getElementById('recherche').value;

		//Liste recherche
		let liste = document.getElementById('listeAutoComplete');
		console.log(liste)

		//recherche Url
        const url = "{{route('bouteille.recherche')}}";
		//console.log(url);

		const options = {
				headers: {
				"Content-Type": "application/json",
				"Accept": "application/json",
				"X-Requested-With": "XMLHttpRequest",
				"X-CSRF-Token": document.querySelector('input[name="_token"]').value
				},
				method: "post",
				credentials: "same-origin",
				body: JSON.stringify({
				recherche: elRecheche
				})
			}

		fetch(url, options)
		.then((resp) => resp.json()) //Transforme  data en json
		.then(function(data){
			

			var tbodyref  = document.getElementById('tbodyfordata');
			tbodyref.innerHTML = '';
			let bouteilles = data;
			console.log(bouteilles);
			bouteilles.map(function(bouteille){
				let tr = createNode('tr'),
					nom = createNode('td');
					id = bouteille.id
					nom.innerText = bouteille.nom;
					nom.setAttribute('data-id', bouteille.id)
					append(tr,nom);
					append(tbodyref,tr);

					/*
      					* Gestionnaire d'évènement clique sur l'élément tr ( nom de la bouteille ) 
     					  qui permet de faire la sélection parmi les choix de la liste
    				*/
					tr.addEventListener("click", function(evt){
						//console.log(evt.target.dataset.id)
						if(evt.target.tagName == "TD"){
						
						injectBouteilleInfo(bouteille)
						
						//console.log(liste);
						liste.innerHTML = "";
						elRecheche = "";

						}
					});

				});			
		})
		.catch(function(error){
			console.log(error);
		})
	}

	//Creation de l'élément de recherche
	function createNode(element)
	{
		return document.createElement(element);
	}

	//Injection de l'élément de recherche
	function append(parent,el)
	{
		return parent.appendChild(el);
	}


	function injectBouteilleInfo(bte)
	{

		//console.log(bte)
		var form = document.getElementById('formAjoutBouteille')
		
		//Injecter les info de la bouteille dans le formulaire si vient de la recherche
		for (const property in bte) {
			  prop = `${property}`;
			  value = `${bte[property]}`;
			 // console.log(prop);
			 // console.log(value);

			 // radio bouton
			  if (prop == 'type'){
				console.log(typeof value)
				valueBte = value
				switch (valueBte) {
					case '1':
					console.log(document.getElementById("rouge"))
					document.getElementById("rouge").checked =true;
					break;
					case '2':
					document.getElementById("blanc").checked =true;
					break;
					case '3':
					document.getElementById("rose").checked =true;
					break;
				}
			  }else{
				form[prop].value = value;
			  }  
		}
		
	}

</script>