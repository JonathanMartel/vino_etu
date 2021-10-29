import React from "react";
import BouteilleCellier from "../BouteilleCellier/BouteilleCellier";
import { Link } from "react-router-dom";

import './ListeBouteilleCellier.css';

export default class ListeBouteilleCellier extends React.Component {
	constructor(props){
	  super(props);
	  this.state = {
		qteModif: "",
		qteInventaire: "",
		items: [],
		message: ""
	  }

	  this.fetchBouteilles = this.fetchBouteilles.bind(this);
	  this.ajouter = this.ajouter.bind(this);
	  this.retirer = this.retirer.bind(this);
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

	ajouter(idItem) {
		console.log("Ajouter 1 bouteille");
		console.log("Ajouter :", idItem.id);
		console.log("Ajouter :", idItem.nom);
        
		const donnes = {
			id : idItem.id,
			quantite : 1
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
		console.log("Retirer 1 bouteille");
		console.log("Retirer Diana", idItem.id);
		console.log("Retirer Diana", idItem.nom);
		console.log("Retirer quantite", idItem.quantite);
		
		if (idItem.quantite >= 1) {
			const donnes = {
				id : idItem.id,
				quantite : -1
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
											<button type="button" onClick={(e) => this.ajouter(item)}>Ajouter une bouteille</button>
											<button type="button" onClick={(e) => this.retirer(item)}>Retirer une bouteille</button>
										</div>
									);
								})

		return (
			<section>
				<Link to={"/ajoutBouteille"}>
					<span>Ajouter une nouvelle bouteille à votre cellier</span>
				</Link>

				<div>
					{bouteilles}
				</div>
			</section>
		);
	}
}