import React from 'react';
import './DetailsBouteille.css';

export default class DetailsBouteille extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			items :[],
			nom : "",
			description: "",
			pays: "",
			millesime: "",
			codSaq: "",
			format: "",
			typeId: "",
			garder: "",
			note: "",
			dateAjout: null, 
			type: ""
		}
		
		/* console.log(this.props); */
		this.recupereBouteille = this.recupereBouteille.bind(this);
		this.modifier = this.modifier.bind(this);
		
	}

	recupereBouteille() { 
		
		const getMethod = {
			method: 'GET', 
			headers: {
				'Content-type': 'application/json',
				'authorization': 'Basic ' + btoa('vino:vino')
			}
			//, body: JSON.stringify(donnes) 
		}

		fetch("https://rmpdwebservices.ca/webservice/php/bouteilles/" + this.props.param.match.params.id, getMethod)
			.then(reponse => reponse.json())
        	.then((donnees)=>{
				this.setState({items: donnees.data[0]})
				console.log("Bouteilles ", this.state.items )
        });
	}

	modifier() {
		console.log("Click en modifier !!!");

	
		const donnes = {
			nom: this.state.nom,
			description: this.state.description,
			pays: this.state.pays,
			millesime: this.state.millesime,
			codSaq: this.state.codSaq,
			format: this.state.format,
			typeId: this.state.typeId,
			garder: this.state.garder,
			note: this.state.note,
			dateAjout: this.state.dateAjout
		}
		console.log('donnes ? ', donnes);
		
		/* const getMethod = {
			method: 'POST', 
			headers: {
				'Content-type': 'application/json',
				'authorization': 'Basic ' + btoa('vino:vino')
			},
			body: JSON.stringify(donnes) 
		}

		fetch("https://rmpdwebservices.ca/webservice/php/bouteille/", getMethod)
			.then(reponse => reponse.json())
        	.then((donnees)=>{
				console.log("Bouteilles ", donnees.data )
        }); */

		//this.props.history.push("/cellier/1"); // + this.props.info.id_cellier
	}

	componentDidMount(){
		this.recupereBouteille();
		
	}

	render() {
		console.log("items: ", this.state.items);
		//console.log("Render nom: ", this.state.items.nom); 
	 
		var bouteille = this.state.items;
		console.log("Mi botella: ", bouteille);
		console.log("Mi botella.nom: ", bouteille.nom);
			
		return (
			<form>
				{/* <p>Je suis au DetailsBouteille : { this.props.param.match.params.id } </p> */}

				<p>Nom : <input name="nom" value={this.state.nom ?? "test"} defaultValue={bouteille.nom} onChange={(e) => this.setState({ nom: e.target.value })} /></p>
				<p>Description : <input name="description" defaultValue={bouteille.description} onChange={e => this.setState({ description: e.target.value })} /></p>
				<p>Pays : <input name="pays" defaultValue={bouteille.pays} onChange={e => this.setState({ pays: e.target.value })} /></p>
				<p>Millesime : <input name="millesime" defaultValue={bouteille.millesime} onChange={e => this.setState({ millesime: e.target.value })} /></p>
				<p>Cod. Saq : <input name="codSaq" defaultValue={bouteille.cod_saq} onChange={e => this.setState({ codSaq: e.target.value })} /></p>
				<p>Format : <input name="format" defaultValue={bouteille.format} onChange={e => this.setState({ format: e.target.value })} /></p>
				{/* <p>Type Id : <input name="typeId" defaultValue={bouteille.vinop__type_id} onChange={e => this.setState({ typeId: e.target.value })} /></p> */}
				<p>Type : <input name="type" defaultValue={bouteille.type} onChange={e => this.setState({ type: e.target.value })} /></p>
				<p>Garder jusqu'à : <input name="garder" defaultValue={bouteille.garder_jusqua} onChange={e => this.setState({ garder: e.target.value })} /></p>
				<p>Note dégustation : <input name="note" defaultValue={bouteille.note_degustation} onChange={e => this.setState({ note: e.target.value })} /></p>
				<p>Date ajout : <input name="dateAjout" defaultValue={bouteille.date_ajout} onChange={e => this.setState({ dateAjout: e.target.value })} /></p>

				<button type="button" onClick={(e) => this.modifier()}>Modifier</button>
				
			</form>
		)
	}
};

