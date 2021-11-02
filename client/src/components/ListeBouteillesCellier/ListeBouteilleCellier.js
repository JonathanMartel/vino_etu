import React from "react";
import BouteilleCellier from "../BouteilleCellier/BouteilleCellier";
import { Link } from "react-router-dom";
import Button from '@mui/material/Button';
import TextField from '@mui/material/TextField';
import Dialog from '@mui/material/Dialog';
import DialogActions from '@mui/material/DialogActions';
import DialogContent from '@mui/material/DialogContent';
import DialogContentText from '@mui/material/DialogContentText';
import DialogTitle from '@mui/material/DialogTitle';


import './ListeBouteilleCellier.css';
import Dialogue from "../Dialogue/Dialogue";

export default class ListeBouteilleCellier extends React.Component {
	constructor(props){
	  super(props);
	  this.state = {
		qteModif: "",
		qteInventaire: "",
		items: [],
		item: undefined,
		message: "",
		open: false,
		titre: "",
		action: "",
	  }

	  this.fetchBouteilles = this.fetchBouteilles.bind(this);
	  this.ajouter = this.ajouter.bind(this);
	  this.retirer = this.retirer.bind(this);
	  this.quantiteModif = this.quantiteModif.bind(this);
	  this.changerTitreDialogue = this.changerTitreDialogue.bind(this);
	  this.ajouterAction = this.ajouterAction.bind(this);
	  this.retirerAction = this.retirerAction.bind(this);
	  this.ajusterQuantite = this.ajusterQuantite.bind(this);
	
	}

	componentDidUpdate(){
	}

	fetchBouteilles(){
		fetch("https://rmpdwebservices.ca/webservice/php/celliers/" + this.props.match.params.id, {
			method: 'GET',
			headers: new Headers({
				"Content-Type": "application/json",
				"authorization": "Basic " + btoa("vino:vino"),
			}),
		})
            .then(reponse => reponse.json())
            .then((donnees)=>{
				console.log('Diana : ', donnees)
                this.setState({items:donnees.data});
            });
	}

	quantiteModif(valeur){
		this.setState({qteModif: valeur});
	}

	ajouterAction(item) {
		this.setState({item: item.id, action: "ajouter", action: "ajouter", open: true});
		this.changerTitreDialogue("Ajouter à l'inventaire");
	}

	retirerAction() {
		this.setState({action: "retirer"});
		this.changerTitreDialogue("Retirer de l'inventaire");
		this.setState({action: "retirer"});
		this.setState({open: true});
	}

	ajusterQuantite() {
		if(this.state.action == "ajouter"){
			this.ajouter(this.state.item);
		}
	}

	changerTitreDialogue(titre){
		this.setState({titre: titre});
	}

	ajouter(idItem) {
		console.log(this.state.qteModif);
		this.setState({open: false});
		const donnes = {
			id : idItem.id,
			quantite : this.state.qteModif
		}

		const postMethod = {
			method: 'PUT', 
			headers: {
				'Content-type': 'application/json',
				'authorization': 'Basic ' + btoa('vino:vino')
			},
			body: JSON.stringify(donnes) 
		}
    
		fetch("https://rmpdwebservices.ca/webservice/php/bouteilles/quantite", postMethod)
			.then(res => res.json()) 
			.then((res) => {
				this.setState({id_usager: res.data})
				if (res.data) {
					this.fetchBouteilles();
				} else { 
					console.log("Erreur.")
				}
			});
			this.setState({message: ""});
	}

	retirer(idItem){

		if (idItem.quantite >= this.state.qteModif) {
			this.setState({qteModif: (-this.state.qteModif)});
			const donnes = {
				id : idItem.id,
				quantite : this.state.qteModif
			}
	
			const postMethod = {
				method: 'PUT', 
				headers: {
					'Content-type': 'application/json',
					'authorization': 'Basic ' + btoa('vino:vino')
				},
				body: JSON.stringify(donnes) 
			}
	
			fetch("https://rmpdwebservices.ca/webservice/php/bouteilles/quantite", postMethod)
				.then(res => res.json()) 
				.then((res) => {
					this.setState({id_usager: res.data})
					if (res.data) {
						this.fetchBouteilles();
					} else {
						console.log("Erreur.")
					}
				});
			this.setState({message: ""});
		} else {
			console.log("Il n'y a pas de bouteilles pour retirer");
			this.setState({message: "Il n'y a pas de bouteilles pour retirer"});
		}
		
	}

	componentDidMount(){
		this.fetchBouteilles();
    }

	render() {
		const bouteilles = this.state.items
								.map((item, index)=>{
									return (
										<div key={index}>
											{/* <p className="messagRouge"> {this.state.message} </p> */}
											<BouteilleCellier info={item} />
											<button onClick={(e) => this.ajouterAction(item)}>Ajouter une bouteille</button>
											<button onClick={(e) => this.retirer(item)}>Retirer une bouteille</button>
										</div>
									);
								})

								
		return (
			<section>
				<Link to={"/ajoutBouteille"}>
					<span>Ajouter une nouvelle bouteille à votre cellier</span>
				</Link>
				

				<div>
					<Dialogue open={this.state.open} titre={this.state.titre} action={this.state.action} valeurChamps={this.quantiteModif} changerQuantite={this.ajusterQuantite} />
					{bouteilles}
					
					
				</div>
			</section>
		);
	}
}