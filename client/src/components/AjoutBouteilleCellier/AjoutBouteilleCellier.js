import React from 'react';
import BouteilleSAQ from '../BouteilleSAQ/BouteilleSAQ';
import './AjoutBouteilleCellier.css';
import { Box } from '@mui/system';
import { TextField } from '@mui/material';
import InputLabel from '@mui/material/InputLabel';
import MenuItem from '@mui/material/MenuItem';
import FormControl from '@mui/material/FormControl';
import Select from '@mui/material/Select';
import moment from 'moment';

export default class AjoutBouteille extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			bouteillesSAQ: [],
			celliers: [],
			recherche: '',
			nomBouteilleSAQ: '',
			prixBouteilleSAQ: '',
			nom: '',
			millesime: moment().format('YYYY'),
			quantite: '1',
			date_achat: moment().format('YYYY-MM-DD'),
			prix: '',
			garde: '',
			commentaires: '',
			usager_id: '1',
			vino__type_id: '',
			id_cellier: '',
			url_img: 'https://www.saq.com/media/wysiwyg/placeholder/category/06.png',
			url_saq: ''
		};

		// Binding des fonctions
		this.fetchBouteillesSAQ = this.fetchBouteillesSAQ.bind(this);
		this.ajouterBouteilleCellier = this.ajouterBouteilleCellier.bind(this);
		this.choixBouteille = this.choixBouteille.bind(this);
		this.fetchCelliers = this.fetchCelliers.bind(this);
		this.choixCellier = this.choixCellier.bind(this);
	}

	componentDidMount() {
		this.fetchCelliers();
		console.log(this.props.id_usager);
	}

	fetchCelliers() {
		fetch('https://rmpdwebservices.ca/webservice/php/celliers/usager/' + this.props.id_usager, {
			method: 'GET',
			headers: new Headers({
				'Content-Type': 'application/json',
				authorization: 'Basic ' + btoa('vino:vino')
			})
		})
			.then((reponse) => reponse.json())
			.then((donnees) => {
				console.log(donnees.data);
				this.setState({ celliers: donnees.data });
			});
	}

	choixCellier(e) {
		this.setState({ id_cellier: e.target.value });
	}

	fetchBouteillesSAQ(event) {
		if (event.target.value === '') {
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
		this.setState({
			bouteillesSAQ: [],
			nom: info.nom,
			prixBouteilleSAQ: info.prix_saq,
			pays: info.pays,
			vino__type_id: info.type,
			url_img: info.url_img,
			url_saq: info.url_saq
		});
	}

	ajouterBouteilleCellier() {
		const entete = new Headers();

		const nouvelleBouteille = {
			prixBouteilleSAQ: this.state.prixBouteilleSAQ,
			usager_id: this.props.id_usager,
			nom: this.state.nom,
			pays: this.state.pays,
			millesime: this.state.millesime,
			url_saq: this.state.url_saq,
			url_img: this.state.url_img,
			vino__type_id: this.state.vino__type_id,
			garde_jusqua: this.state.garde,
			note_degustation: this.state.commentaires,
			date_ajout: this.state.date_achat,
			id_cellier: this.state.id_cellier,
			quantite: this.state.quantite,
			prix: this.state.prixBouteilleSAQ
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
			<Box
				className="formulaire_ajout_bouteille_cellier"
				sx={{
					backgroundColor: 'rgba(0, 0, 0, 0.8)',
					display: 'flex',
					justfyContent: 'center',
					alignItems: 'center',
					gap: '1rem',
					width: '85vw',
					flexDirection: 'column',
					borderRadius: '1rem',
					margin: '0 auto'
				}}
			>
				<Box
					sx={{
						display: 'flex',
						width: '80%',
						flexDirection: 'column',
						gap: '2rem'
					}}
				>
					<span className="ajout_bouteille_cellier_titre">Ajouter une bouteille au cellier</span>

					<Box
						sx={{
							display: 'flex',
							flexDirection: 'column',
							gap: '1rem'
						}}
					>
						<TextField
							label="Recherche d'une bouteille"
							variant="outlined"
							InputLabelProps={{
								className: 'ajout_bouteille_input'
							}}
							onChange={(event) => this.fetchBouteillesSAQ(event)}
						/>
						{bouteilles}

						<FormControl>
							<InputLabel>Choisir le cellier</InputLabel>
							<Select
								label="Cellier"
								sx={{ color: 'white' }}
								value={this.state.id_cellier}
								onChange={(e) => this.setState({ id_cellier: e.target.value })}
							>
								{this.state.celliers.map((cellier) => (
									<MenuItem value={cellier.id_cellier}>{cellier.emplacement}</MenuItem>
								))}
							</Select>
						</FormControl>

						<TextField
							label="Nom"
							variant="outlined"
							value={this.state.nom}
							type="text"
							onChange={(e) => this.setState({ nom: e.target.value })}
							InputLabelProps={{
								className: 'ajout_bouteille_input'
							}}
						/>

						<TextField
							label="Origine"
							variant="outlined"
							value={this.state.pays}
							type="text"
							name="pays"
							onChange={(e) => this.setState({ pays: e.target.value })}
							InputLabelProps={{
								className: 'ajout_bouteille_input'
							}}
						/>

						<TextField
							label="Quantité"
							variant="outlined"
							type="number"
							value={this.state.quantite}
							name="quantite"
							onChange={(e) => this.setState({ quantite: e.target.value })}
							InputLabelProps={{
								className: 'ajout_bouteille_input'
							}}
						/>

						<TextField
							label="Millesime"
							variant="outlined"
							value={this.state.millesime}
							name="millesime"
							onChange={(e) => this.setState({ millesime: e.target.value })}
							InputLabelProps={{
								className: 'ajout_bouteille_input'
							}}
						/>

						<TextField
							label="Date d'achat"
							variant="outlined"
							type="date"
							value={this.state.date_achat}
							name="date_achat"
							onChange={(e) => this.setState({ date_achat: e.target.value })}
							InputLabelProps={{
								className: 'ajout_bouteille_input'
							}}
						/>

						<TextField
							label="Prix"
							variant="outlined"
							value={this.state.prixBouteilleSAQ}
							name="prix"
							onChange={(e) => this.setState({ prix: e.target.value })}
							InputLabelProps={{
								className: 'ajout_bouteille_input'
							}}
						/>

						<TextField
							label="À conserver?"
							variant="outlined"
							value={this.state.garde}
							name="garde_jusqua"
							onChange={(e) => this.setState({ garde: e.target.value })}
							InputLabelProps={{
								className: 'ajout_bouteille_input'
							}}
						/>

						<TextField
							label="Commentaires"
							variant="outlined"
							value={this.state.commentaires}
							name="notes"
							onChange={(e) => this.setState({ commentaires: e.target.value })}
							InputLabelProps={{
								className: 'ajout_bouteille_input'
							}}
						/>
					</Box>

					<button onClick={this.ajouterBouteilleCellier}>Ajouter une bouteille au cellier</button>
				</Box>
			</Box>
		);
	}
}
