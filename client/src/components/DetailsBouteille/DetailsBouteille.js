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
			code_saq: "",
			format: "",
			garde_jusqua: "",
			note: "",
			date_ajout: undefined
		}

		this.recupereBouteille = this.recupereBouteille.bind(this);
		this.modifier = this.modifier.bind(this);
	}

	recupereBouteille() {
		const getMethod = {
			method: 'GET',
			headers: {
				'Content-type': 'application/json',
				authorization: 'Basic ' + btoa('vino:vino')
			}
		}
		fetch("https://rmpdwebservices.ca/webservice/php/bouteilles/" + this.props.param.match.params.id, getMethod)
			.then(reponse => reponse.json())
			.then((donnees) => {
				if (donnees.data[0] === undefined) return this.props.history.push("/ListeCelliers/");
				console.log("Datos botella: ", donnees.data[0]);

				this.setState({
					nom: donnees.data[0].nom,
					description: donnees.data[0].description,
					pays: donnees.data[0].pays,
					millesime: donnees.data[0].millesime,
					code_saq: donnees.data[0].code_saq,
					format: donnees.data[0].format,
					garde_jusqua: donnees.data[0].garde_jusqua,
					note: donnees.data[0].note_degustation,
					date_ajout: donnees.data[0].date_ajout,
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
			code_saq: this.state.code_saq,
			format: this.state.format,
			garde_jusqua: this.state.garde_jusqua,
			note: this.state.note,
			date_ajout: this.state.date_ajout
		}
		console.log("Donnes: ", donnes);
		const putMethod = {
			method: 'PUT',
			headers: {
				'Content-type': 'application/json',
				authorization: 'Basic ' + btoa('vino:vino')
			},
			body: JSON.stringify(donnes)
		};

		fetch('https://rmpdwebservices.ca/webservice/php/bouteilles/', putMethod)
			.then((reponse) => reponse.json())
			.then((donnees) => {
				if (donnees.data) return this.props.history.push("/ListeCelliers/");
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
				<p>Cod. Saq : <input name="code_saq" value={this.state.code_saq} onChange={e => this.setState({ code_saq: e.target.value })} /></p>
				<p>Format : <input name="format" value={this.state.format} onChange={e => this.setState({ format: e.target.value })} /></p>
				<p>Garder jusqu'à : <input name="garde_jusqua" value={this.state.garde_jusqua} onChange={e => this.setState({ garde_jusqua: e.target.value })} /></p>
				<p>Note dégustation : <input name="note" value={this.state.note} onChange={e => this.setState({ note: e.target.value })} /></p>
				<p>Date ajout : <input type="date" name="date_ajout" value={this.state.date_ajout} onChange={e => this.setState({ date_ajout: e.target.value })} /></p>

				<button type="button" onClick={(e) => this.modifier()}>Modifier</button>

			</form>
		);
	}
}
