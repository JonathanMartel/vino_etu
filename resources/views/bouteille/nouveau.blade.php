
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
		  
		  <span>* Type :</span>
		  <input type="radio" name="type" id="rouge" value="1" required>
		  <label for="rouge">Rouge</label><br>
		  <input type="radio" name="type" id="blanc" value="2">
		  <label for="blanc">Blanc</label><br>
		  <input type="radio" name="type" id="rose" value="3">
		  <label for="rose">Rosé</label><br>
	
		  <!-- Pas obligatoire -->
		  <label for="format">Format :</label>
		  <input id="format" name="format" type="text" value="">
		  
		  <label for="millesime">Millesime :</label>
		  <input id="millesime" name="millesime" type="text" value="">
	
		  <label for="description">Description</label>
		  <textarea id="description" name="description">
			
		  </textarea>
	
		  <!-- Caché non obligatoire -->
		  <input id="url_saq" name="url_saq" type="hidden" value="">
		  <input id="code_saq" name="code_saq" type="hidden" value="">
	
		  <button>Ajouter</button>

		</form>

</div>

<!-- SCRIPT-->
<script>
    function fetchData()
	{
       
		//recherche Value
		const elRecheche = document.getElementById('recherche').value;

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
						//bouteille.nom.dataset.id = evt.target.dataset.id;
						//bouteille.nom.innerHTML = evt.target.children.innerHTML;
						
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
		//console.log(form.nom)
		
		for (const property in bte) {
  			//console.log(form.`${property}`);
			  console.log(`${property}: ${object[property]}`);
			  prop = `${property}`;
			  
			  //Si element existe dans le form
			  if(form[prop]){

				//radio bouton
				if (prop == 'type'){
					console.log('type')
					switch (`${object[property]}`) {
						case '1':
						document.getElementById("rouge").checked;
							break;
						case '2':
						document.getElementById("blanc").checked;
						break;
						case '3':
						document.getElementById("rose").checked;
						break;
					}
				}else{
					form[prop].value = `${bte[property]}`;
				}
			}
		
			  
		}
		
	}

</script>