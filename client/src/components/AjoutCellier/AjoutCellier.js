import React from 'react';
import Cellier from "../Cellier/Cellier";
import { Redirect } from "react-router-dom";

export default class AjoutCellier extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			id_usager: "1",
			emplacement: "",
			temperature: "",
		}
		this.ajouterCellier = this.ajouterCellier.bind(this);
	}

	ajouterCellier() {
		let nouveauCellier = {
			//id_usager: this.state.id_usager,
			emplacement: this.state.emplacement
		}
		fetch("http://127.0.0.1:8000/webservice/php/celliers", {
			method: 'POST',
			body: JSON.stringify(nouveauCellier),
			headers: new Headers({
				"Content-Type": "application/json",
				"authorization": "Basic " + btoa("vino:vino"),
			}),
		})
			.then(reponse => reponse.json())
			.then(() => {
				console.log("Cellier ajouté");
				<Redirect to='/' /> // À changer pour rediriger vers le cellier qu'on viens d'ajouter.
			});
	}

	render() {
		return (

			<div className="nouveauCellier">
				<div>
					<p>Emplacement du cellier : <input name="emplacement" value={this.state.emplacement} onChange={e => this.setState({ emplacement: e.target.value })} /></p>
				</div>
				<button onClick={this.ajouterCellier} name="ajouterCellier">Ajouter votre cellier</button>
			</div>

		)
	}
};
