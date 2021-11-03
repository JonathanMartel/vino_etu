import React from 'react';
import moment from 'moment';
import fondEcran from '../../fondEcran.svg';
import BouteilleSAQ from '../BouteilleSAQ/BouteilleSAQ';
import './AjoutBouteilleCellier.css';
import BouteilleSAQ from "../BouteilleSAQ/BouteilleSAQ";
import { Box } from "@mui/system";
import { TextField } from "@mui/material";

export default class AjoutBouteille extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			bouteillesSAQ: [],
			recherche: '',
			nomBouteilleSAQ: '',
			prixBouteilleSAQ: '',
			nom: '',
			millesime: '',
			quantite: '1',
			date_achat: '',
			prix: '',
			garde: '',
			commentaires: '',
			usager_id: '1',
			vino__type_id: '',
			id_cellier: '3',
			url_img: '',
			url_saq: '',
		};

		// Binding des fonctions
		this.fetchBouteillesSAQ = this.fetchBouteillesSAQ.bind(this);
		this.ajouterBouteilleCellier = this.ajouterBouteilleCellier.bind(this);
		this.choixBouteille = this.choixBouteille.bind(this);
	}

	fetchBouteillesSAQ(event) {
		if (event.target.value == '') {
			this.setState({ bouteillesSAQ: [] });
			return;
		}

		fetch('https://rmpdwebservices.ca/webservice/php/saq/' + event.target.value, {
			method: 'GET',
			headers: new Headers({
				'Content-Type': 'application/json',
				authorization: 'Basic ' + btoa('vino:vino')
			})
		})
			.then((reponse) => reponse.json())
			.then((donnees) => {
				this.setState({ bouteillesSAQ: donnees.data });

			});
	}

	choixBouteille(info) {
		this.setState({bouteillesSAQ: [], nomBouteilleSAQ: info.nom, prixBouteilleSAQ: info.prix_saq, pays: info.pays, type__type_id: info.type, url_img: info.url_img, url_saq: info.url_saq });
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
			pays: this.state.pays,
			url_img: this.state.url_img,
			url_saq: this.state.url_saq,
		};

		entete.append('Content-Type', 'application/json');
		fetch('https://rmpdwebservices.ca/webservice/php/bouteilles', {
			method: 'POST',
			body: JSON.stringify(nouvelleBouteille),
			headers: new Headers({
				'Content-Type': 'application/json',
				authorization: 'Basic ' + btoa('vino:vino')
			})
		})
			.then((reponse) => reponse.json())
			.then(() => {
				this.props.history.push('/cellier/' + this.state.id_cellier);
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

			<Box className="formulaire_ajout_bouteille_cellier" sx={{
				backgroundColor: 'rgba(0, 0, 0, 0.8)',
				display: 'flex',
				justfyContent: 'center',
				alignItems: 'center',
				gap: '1rem',
				width: '85vw',
				flexDirection: 'column',
				borderRadius: '1rem',
				margin: '0 auto'
			}}>

				<Box sx={{
					display: 'flex',
					width: '80%',
					flexDirection: 'column',
					gap: '2rem'
				}}>
					<span className="ajout_bouteille_cellier_titre">Ajouter une bouteille au cellier</span>

					<Box sx={{
						display: 'flex',
						flexDirection: 'column',
						gap: '1rem'
					}}>
						{/* <p>Recherche : <input onKeyUp={(event) => this.fetchBouteillesSAQ(event)} type="text" name="nom_bouteille" /></p> */}
						{/* {bouteilles} */}
						{/* <p>Nom : <input name="nom" value={this.state.nomBouteilleSAQ} onChange={e => this.setState({ nom: e.target.value })} /></p> */}
						<TextField label="Nom" variant="outlined"
							InputLabelProps={{
								className: "ajout_bouteille_input"
							}}
						/>

						{/* <p>Pays : <input name="pays" value={this.state.pays} onChange={e => this.setState({ pays: e.target.value })} /></p> */}
						<TextField label="Origine" variant="outlined" value={this.state.pays} name="pays"
							onChange={e => this.setState({ pays: e.target.value })}
							InputLabelProps={{
								className: "ajout_bouteille_input"
							}}
						/>

						{/* <p>Quantité : <input name="quantite" value={this.state.quantite} onChange={e => this.setState({ quantite: e.target.value })} /></p> */}
						<TextField label="Quantité" variant="outlined" value={this.state.quantite} name="quantite"
							onChange={e => this.setState({ quantite: e.target.value })}
							InputLabelProps={{
								className: "ajout_bouteille_input"
							}}
						/>

						{/* <p>Millesime : <input name="millesime" value={this.state.millesime} onChange={e => this.setState({ millesime: e.target.value })} /></p> */}
						<TextField label="Millesime" variant="outlined" value={this.state.millesime} name="millesime"
							onChange={e => this.setState({ millesime: e.target.value })}
							InputLabelProps={{
								className: "ajout_bouteille_input"
							}}
						/>

						{/* <p>Date d'achat : <input name="date_achat" value={this.state.date_achat} onChange={e => this.setState({ date_achat: e.target.value })} /></p> */}
						<TextField label="Date d'achat" variant="outlined" value={this.state.date_achat} name="date_achat"
							onChange={e => this.setState({ date_achat: e.target.value })}
							InputLabelProps={{
								className: "ajout_bouteille_input"
							}}
						/>

						{/* <p>Prix : <input name="prix" value={this.state.prixBouteilleSAQ} onChange={e => this.setState({ prix: e.target.value })} /></p> */}
						<TextField label="Prix" variant="outlined" value={this.state.prixBouteilleSAQ} name="prix"
							onChange={e => this.setState({ prix: e.target.value })}
							InputLabelProps={{
								className: "ajout_bouteille_input"
							}}
						/>

						{/* <p>Peux être garder ? : <input name="garde_jusqua" value={this.state.garde} onChange={e => this.setState({ garde: e.target.value })} /></p> */}
						<TextField label="À conserver?" variant="outlined" value={this.state.garde} name="garde_jusqua"
							onChange={e => this.setState({ garde: e.target.value })}
							InputLabelProps={{
								className: "ajout_bouteille_input"
							}}
						/>

						{/* <p>Commentaires: <input name="notes" value={this.state.commentaires} onChange={e => this.setState({ commentaires: e.target.value })} /></p> */}
						<TextField label="Commentaires" variant="outlined" value={this.state.commentaires} name="notes"
							onChange={e => this.setState({ commentaires: e.target.value })}
							InputLabelProps={{
								className: "ajout_bouteille_input"
							}}
						/>

						{/* <input name="courriel" onKeyUp={evt => this.setState({ courriel: evt.target.value })} placeholder="bobus@gmail.com" type="email" />
                        <input name="mot_passe" onKeyUp={evt => this.setState({ mot_passe: evt.target.value })} placeholder="12345" type="password" /> */}
					</Box>

					<button onClick={this.ajouterBouteilleCellier}>Ajouter une bouteille au cellier</button>
				</Box>


				{/* <button onClick={this.seConnecter}>{(this.state.seConnecter ? "Se déconnecter" : "Se connecter")}</button> */}

			</Box>
		);
	}
}
