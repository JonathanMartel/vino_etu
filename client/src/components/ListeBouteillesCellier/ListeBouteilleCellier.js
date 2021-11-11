import React from 'react';

import BouteilleCellier from '../BouteilleCellier/BouteilleCellier';
import Dialogue from '../Dialogue/Dialogue';
import listePays from '../../pays.json';

import './ListeBouteilleCellier.css';

//import { circularProgressClasses } from '@mui/material';
import { Box } from '@mui/system';
import { Breadcrumbs, Link, Typography } from '@mui/material';
import InputLabel from '@mui/material/InputLabel';
//import MenuItem from '@mui/material/MenuItem';
//import ListSubheader from '@mui/material/ListSubheader';
import FormControl from '@mui/material/FormControl';
import Select from '@mui/material/Select';

export default class ListeBouteilleCellier extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			qteModif: '',
			qteInventaire: '',
			items: [],
			item: undefined,
			message: '',
			open: false,
			titre: '',
			action: undefined,
			premierId: undefined,
			nomCellier: undefined,
			drapeau: undefined
		};

		this.fetchBouteilles = this.fetchBouteilles.bind(this);
		this.ajouter = this.ajouter.bind(this);
		this.retirer = this.retirer.bind(this);
		this.changerQuantite = this.changerQuantite.bind(this);
		this.changerTitreDialogue = this.changerTitreDialogue.bind(this);
		this.ajouterAction = this.ajouterAction.bind(this);
		this.retirerAction = this.retirerAction.bind(this);
		this.sortBouteilles = this.sortBouteilles.bind(this);
		this.setDrapeau = this.setDrapeau.bind(this);
	}

	componentDidMount() {
		this.fetchBouteilles();
	}

	componentDidUpdate() { }

	sortBouteilles(obj) {
		const parsedObj = JSON.parse(obj);
		const key = parsedObj.key;
		const order = parsedObj.order;
		if (order.toUpperCase() === 'ASC') {
			const sortedItems = this.state.items.sort((a, b) => a[key].localeCompare(b[key]));
			console.log(sortedItems);
			this.setState({ items: sortedItems });
		} else if (order.toUpperCase() === 'DESC') {
			const sortedItems = this.state.items.sort((a, b) => b[key].localeCompare(a[key]));
			console.log(sortedItems);
			this.setState({ items: sortedItems });
		}
	}

	triBouteilles(order) {
		console.log(JSON.parse(order));
	}

	fetchBouteilles() {
		fetch('https://rmpdwebservices.ca/webservice/php/celliers/' + this.props.match.params.id + '/bouteilles', {
			method: 'GET',
			headers: new Headers({
				'Content-Type': 'application/json',
				authorization: 'Basic ' + btoa('vino:vino')
			})
		})
			.then((reponse) => reponse.json())
			.then((donnees) => {
				donnees.data.map((item) => {
					Object.entries(item).map((i) => {
						if (i[0] === "pays") item.drapeau = this.getDrapeauPays(i[1]);
					});
				})

				this.setState({
					items: donnees.data,
					premierId: donnees.data[0].id,
					nomCellier: donnees.data[0].emplacement,
				});


				console.log(this.state.items);
			});
	}

	getDrapeauPays(pays) {
		let flag = undefined;

		listePays
			.filter((data) => {
				if (pays == null) return;

				else if (data.name.toLowerCase().includes(pays.toLowerCase())) {
					return data;
				}
			})
			.map((data) => {
				flag = 'https://flagcdn.com/' + data.alpha2 + '.svg';
			});

		return flag;
	}


	changerQuantite(valeur) {
		this.setState({ qteModif: valeur, open: false });

		if (this.state.action === 'ajouter') {
			this.ajouter(this.state.item, valeur);
		} else {
			this.retirer(this.state.item, valeur);
		}
	}

	ajouterAction(item) {
		this.setState({
			item: item,
			action: 'ajouter',
			open: true
		});
		this.changerTitreDialogue("Ajouter à l'inventaire");
	}

	retirerAction(item) {
		this.setState({
			item: item,
			action: 'retirer',
			open: true
		});
		this.changerTitreDialogue("Retirer de l'inventaire");
	}

	changerTitreDialogue(titre) {
		this.setState({ titre: titre });
	}

	ajouter(item, quantite) {
		this.setState({ open: false });
		const donnes = {
			id: item.id,
			quantite: quantite
		};

		const postMethod = {
			method: 'PUT',
			headers: {
				'Content-type': 'application/json',
				authorization: 'Basic ' + btoa('vino:vino')
			},
			body: JSON.stringify(donnes)
		};

		fetch('https://rmpdwebservices.ca/webservice/php/bouteilles/quantite', postMethod)
			.then((res) => res.json())
			.then((data) => {
				if (data.data) {
					this.fetchBouteilles();
				} else {
				}
			});
		this.setState({ message: '' });
	}

	retirer(item, quantite) {
		if (item.quantite >= quantite) {
			let quantiteInversee = -quantite;
			const donnes = {
				id: item.id,
				quantite: quantiteInversee
			};

			const postMethod = {
				method: 'PUT',
				headers: {
					'Content-type': 'application/json',
					authorization: 'Basic ' + btoa('vino:vino')
				},
				body: JSON.stringify(donnes)
			};

			fetch('https://rmpdwebservices.ca/webservice/php/bouteilles/quantite', postMethod)
				.then((res) => res.json())
				.then((data) => {
					if (data.data) {
						this.fetchBouteilles();
					} else {
					}
				});
			this.setState({ message: '' });
		} else {
			this.setState({
				message: "Il n'y a pas assez de bouteilles pour retirer la quantité demandée"
			});
		}
	}

	render() {
		const premierId = this.state.premierId;
		const bouteilles = this.state.items.map((item, index) => {

			return (
				<div>
					{premierId ? (
						<div>
							<BouteilleCellier
								key={index}
								info={item}
								setDrapeau={this.setDrapeau}
								drapeau={this.state.drapeau}
								ajouterAction={this.ajouterAction}
								retirerAction={this.retirerAction}
							/>
						</div>
					) : (
						<div className="cellier_vide">Il n'y a pas de bouteilles dans votre cellier</div>
					)}
				</div>
			);
		});

		return (
			<Box>
				<Breadcrumbs aria-label="breadcrumb" sx={{ display: 'flex', margin: '0 1.5rem' }}>
					<Link underline="hover" color="white" href="/celliers/liste">
						Celliers
					</Link>
					<Typography color="text.primary">{this.state.nomCellier}</Typography>
					<Typography color="text.primary">Liste des bouteilles</Typography>
				</Breadcrumbs>
				<FormControl sx={{ m: 1, minWidth: 120 }}>
					<InputLabel htmlFor="grouped-native-select">Trier par</InputLabel>
					<Select
						native
						defaultValue=""
						id="grouped-native-select"
						label="Grouping"
						onChange={(e) => this.sortBouteilles(e.target.value)}
					>
						<optgroup label="Nom">
							<option value={JSON.stringify({ key: 'nom', order: 'asc' })}>Nom (A-Z)</option>
							<option value={JSON.stringify({ key: 'nom', order: 'desc' })}>Nom (Z-A)</option>
						</optgroup>
						<optgroup label="Millesime">
							<option value={JSON.stringify({ key: 'millesime', order: 'asc' })}>
								Millesime Ascendant
							</option>
							<option value={JSON.stringify({ key: 'millesime', order: 'desc' })}>
								Millesime Descendant
							</option>
						</optgroup>
						<optgroup label="Pays">
							<option value={JSON.stringify({ key: 'pays', order: 'asc' })}>Pays (A-Z)</option>
							<option value={JSON.stringify({ key: 'pays', order: 'desc' })}>Pays (Z-A)</option>
						</optgroup>
					</Select>
				</FormControl>
				<section>
					<Dialogue
						open={this.state.open}
						titre={this.state.titre}
						action={this.state.action}
						changerQuantite={this.changerQuantite}
						getQuantite={this.state.qteModif}
					/>

					<div className="liste_bouteilles">{bouteilles}</div>
				</section>
			</Box>
		);
	}
}
