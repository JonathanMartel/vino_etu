import React from 'react';
import './DetailsBouteille.css';

export default class DetailsBouteille extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			items: [],
			nom: "",
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
		}

		fetch("https://rmpdwebservices.ca/webservice/php/bouteilles/" + this.props.param.match.params.id, getMethod)
			.then(reponse => reponse.json())
			.then((donnees) => {
				if (donnees.data[0] === undefined) return this.props.history.push("/ListeCelliers/1");

				this.setState({
					nom: donnees.data[0].nom,
					description: donnees.data[0].description,
					pays: donnees.data[0].pays,
					millesime: donnees.data[0].millesime,
					codSaq: donnees.data[0].code_saq,
					format: donnees.data[0].format,
					garder: donnees.data[0].garder_jusqua,
					note: donnees.data[0].note_degustation,
					dateAjout: donnees.data[0].date_ajout,
				})
			});
	}

	modifier() {
		let donnes = {
			id: this.props.param.match.params.id,
			nom: this.state.nom,
			description: this.state.description,
			pays: this.state.pays,
			millesime: this.state.millesime,
			codSaq: this.state.codSaq,
			format: this.state.format,
			garder: this.state.garder,
			note: this.state.note,
			dateAjout: this.state.dateAjout
		}

		const putMethod = {
			method: 'PUT',
			headers: {
				'Content-type': 'application/json',
				'authorization': 'Basic ' + btoa('vino:vino')
			},
			body: JSON.stringify(donnes)
		}

		fetch("https://rmpdwebservices.ca/webservice/php/bouteilles/", putMethod)
			.then(reponse => reponse.json())
			.then((donnees) => {
				if (donnees.data) return this.props.history.push("/ListeCelliers/1"); //TODO Changer la logique du id (créer object user on login)
			});
	}

	componentDidMount() {
		this.recupereBouteille();

	}

	render() {
		return (
			<form>
				{/* <p>Je suis au DetailsBouteille : { this.props.param.match.params.id } </p> */}

				<p>Nom : <input name="nom" value={this.state.nom} onChange={(e) => this.setState({ nom: e.target.value })} /></p>
				<p>Description : <input name="description" value={this.state.description} onChange={e => this.setState({ description: e.target.value })} /></p>
				<p>Pays : <input name="pays" value={this.state.pays} onChange={e => this.setState({ pays: e.target.value })} /></p>
				<p>Millesime : <input name="millesime" value={this.state.millesime} onChange={e => this.setState({ millesime: e.target.value })} /></p>
				<p>Cod. Saq : <input name="codSaq" value={this.state.cod_saq} onChange={e => this.setState({ codSaq: e.target.value })} /></p>
				<p>Format : <input name="format" value={this.state.format} onChange={e => this.setState({ format: e.target.value })} /></p>
				{/* <p>Type Id : <input name="typeId" value={bouteille.vinop__type_id} onChange={e => this.setState({ typeId: e.target.value })} /></p> */}
				<p>Garder jusqu'à : <input name="garder" value={this.state.garder_jusqua} onChange={e => this.setState({ garder: e.target.value })} /></p>
				<p>Note dégustation : <input name="note" value={this.state.note_degustation} onChange={e => this.setState({ note: e.target.value })} /></p>
				<p>Date ajout : <input name="dateAjout" value={this.state.date_ajout} onChange={e => this.setState({ dateAjout: e.target.value })} /></p>

				<button type="button" onClick={(e) => this.modifier()}>Modifier</button>

			</form>
		)
	}
};

