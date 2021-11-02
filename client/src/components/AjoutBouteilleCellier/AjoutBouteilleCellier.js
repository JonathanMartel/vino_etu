import React from "react";
import fondEcran from '../../fondEcran.svg';
import BouteilleSAQ from "../BouteilleSAQ/BouteilleSAQ";
import './AjoutBouteilleCellier.css';

export default class AjoutBouteille extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			bouteillesSAQ: [],
			recherche: "",
			nomBouteilleSAQ: "",
			prixBouteilleSAQ: "",
			nom: "",
			millesime: "",
			quantite: "1",
			date_achat: "",
			prix: "",
			garde: "",
			commentaires: "",
			usager_id: "1",
			vino__type_id: "1",
			id_cellier: "3"
		}

		// Binding des fonctions
		this.fetchBouteillesSAQ = this.fetchBouteillesSAQ.bind(this);
		this.ajouterBouteilleCellier = this.ajouterBouteilleCellier.bind(this);
		this.choixBouteille = this.choixBouteille.bind(this);

	}

	componentDidUpdate() {
		console.log(this.state.nomBouteilleSAQ);
	}

	fetchBouteillesSAQ(event) {
		if (event.target.value == '') {
			this.setState({ bouteillesSAQ: [] });
			return;
		}

		console.log(event.target.value);
		fetch("https://rmpdwebservices.ca/webservice/php/saq/" + event.target.value, {
			method: 'GET',
			headers: new Headers({
				"Content-Type": "application/json",
				"authorization": "Basic " + btoa("vino:vino"),
			}),

		})
			.then(reponse => reponse.json())
			.then((donnees) => {
				this.setState({ bouteillesSAQ: donnees.data })
				
			});
	}

	choixBouteille(info) {
		console.log(info.nom);
		this.setState({ nomBouteilleSAQ: info.nom, prixBouteilleSAQ: info.prix_saq, pays: info.pays});
		this.setState({bouteillesSAQ: []});
	}

	ajouterBouteilleCellier() {
		const entete = new Headers();
		const nouvelleBouteille = {
			prixBouteilleSAQ: this.state.prixBouteilleSAQ,
			nom: this.state.nomBouteilleSAQ,
			pays: this.state.pays,
			millesime: this.state.millesime,
			quantite: this.state.quantite,
			dateAchat: this.state.date_achat,
			prix: this.state.prixBouteilleSAQ,
			garde: this.state.garde,
			commentaires: this.state.commentaires,
			usager_id: this.state.usager_id,
			vino__type_id: this.state.vino__type_id,
			id_cellier: this.state.id_cellier,
			pays: this.state.pays
		}

		entete.append("Content-Type", "application/json");
		fetch("https://rmpdwebservices.ca/webservice/php/bouteilles", {
			method: 'POST',
			body: JSON.stringify(nouvelleBouteille),
			headers: new Headers({
				"Content-Type": "application/json",
				"authorization": "Basic " + btoa("vino:vino"),
			}),
		})
			.then(reponse => reponse.json())
			.then(() => {
				//this.setState({pays: })
				console.log(nouvelleBouteille.pays);
				this.props.history.push('/cellier/' + this.state.id_cellier)
			});

	}
	

	render() {
		console.log(this.state.bouteillesSAQ);
		const bouteilles = this.state.bouteillesSAQ
			.map((bouteille, index) => {
				return (
					<BouteilleSAQ info={bouteille} choixBouteille={this.choixBouteille} key={index} />
					
				)
			})

		return (
			
			<div className="nouvelleBouteille">
				
				<p>Recherche : <input onKeyUp={(event) => this.fetchBouteillesSAQ(event)} type="text" name="nom_bouteille" /></p>
				<ul>
					{bouteilles}
				</ul>
				<div>
					<p>Nom : <input name="nom" value={this.state.nomBouteilleSAQ} onChange={e => this.setState({ nom: e.target.value })} /></p>
					<p>Pays : <input name="pays" value={this.state.pays} onChange={e => this.setState({ pays: e.target.value })} /></p>
					<p>Millesime : <input name="millesime" value={this.state.millesime} onChange={e => this.setState({ millesime: e.target.value })} /></p>
					<p>Quantité : <input name="quantite" value={this.state.quantite} onChange={e => this.setState({ quantite: e.target.value })} /></p>
					<p>Date d'achat : <input name="date_achat" value={this.state.date_achat} onChange={e => this.setState({ date_achat: e.target.value })} /></p>
					<p>Prix : <input name="prix" value={this.state.prixBouteilleSAQ} onChange={e => this.setState({ prix: e.target.value })} /></p>
					<p>Peux être garder ? : <input name="garde_jusqua" value={this.state.garde} onChange={e => this.setState({ garde: e.target.value })} /></p>
					<p>Commentaires: <input name="notes" value={this.state.commentaires} onChange={e => this.setState({ commentaires: e.target.value })} /></p>
					
				</div>
				
				<button onClick={this.ajouterBouteilleCellier} name="ajouterBouteilleCellier">Ajouter la bouteille au cellier</button>
			</div>
		);
	}
}