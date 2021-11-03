import React from 'react';
import moment from 'moment';
import fondEcran from '../../fondEcran.svg';
import BouteilleSAQ from '../BouteilleSAQ/BouteilleSAQ';
import './AjoutBouteilleCellier.css';

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
		this.setState({ nomBouteilleSAQ: info.nom, prixBouteilleSAQ: info.prix_saq, pays: info.pays, type__type_id: info.type, url_img: info.url_img, url_saq: info.url_saq });
		this.setState({ bouteillesSAQ: [] });
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
		const bouteilles = this.state.bouteillesSAQ.map((bouteille, index) => {
			return <BouteilleSAQ info={bouteille} choixBouteille={this.choixBouteille} key={index} />;
		});

		return (
			<div className="nouvelleBouteille">
				<p>
					Recherche :{' '}
					<input onKeyUp={(event) => this.fetchBouteillesSAQ(event)} type="text" name="nom_bouteille" />
				</p>
				<ul>{bouteilles}</ul>
				<div>
					<p>
						Nom :{' '}
						<input
							type="text"
							name="nom"
							defaultValue={this.state.nomBouteilleSAQ}
							onBlur={(e) => this.setState({ nom: e.target.value })}
						/>
					</p>
					<p>
						Pays :{' '}
						<input
							type="text"
							name="pays"
							defaultValue={this.state.pays}
							onBlur={(e) => this.setState({ pays: e.target.value })}
						/>
					</p>
					<p>
						Type de vin :{' '} {/* Il faut changer le input pour un select */}
						<input
							type="text"
							name="type"
							defaultValue={this.state.vino__type_id}
							onBlur={(e) => this.setState({ vino__type_id: e.target.value })}
						/>
					</p>
					<p>
						Millesime :{' '}
						<input
							type="text"
							name="millesime"
							defaultValue={this.state.millesime}
							onBlur={(e) => this.setState({ millesime: e.target.value })}
						/>
					</p>
					<p>
						Quantité :{' '}
						<input
							type="number"
							name="quantite"
							defaultValue={this.state.quantite}
							onBlur={(e) => this.setState({ quantite: e.target.value })}
						/>
					</p>
					<p>
						Date d'achat :{' '}
						<input
							type="date"
							name="date_achat"
							defaultValue={moment().format('YYYY-MM-DD')}
							onBlur={(e) => this.setState({ date_achat: e.target.value })}
						/>
					</p>
					<p>
						Prix :{' '}
						<input
							type="text"
							name="prix"
							defaultValue={this.state.prixBouteilleSAQ}
							onBlur={(e) => this.setState({ prix: e.target.value })}
						/>
					</p>
					<p>
						Peux être garder ? :{' '}
						<input
							type="text"
							name="garde_jusqua"
							defaultValue={this.state.garde}
							onBlur={(e) => this.setState({ garde: e.target.value })}
						/>
					</p>
					<p>
						Commentaires:{' '}
						<input
							type="text"
							name="notes"
							defaultValue={this.state.commentaires}
							onBlur={(e) => this.setState({ commentaires: e.target.value })}
						/>
					</p>
				</div>

				<button onClick={this.ajouterBouteilleCellier} name="ajouterBouteilleCellier">
					Ajouter la bouteille au cellier
				</button>
			</div>
		);
	}
}
