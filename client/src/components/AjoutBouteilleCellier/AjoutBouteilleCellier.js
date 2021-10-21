import React from "react";
import Bouteille from "../Bouteille/Bouteille";

import './AjoutBouteilleCellier.css';

export default class AjoutBouteilleCellier extends React.Component {
	constructor(props){
		super(props);
		this.state = {
			bouteilles: []
		}
	}

	fetchBouteillesSAQ(){
		fetch("") // Insérer l'adresse pour la request HTTP
		.then(reponse => reponse.json())
		.then((donnees)=>{
			this.setState({bouteilles:donnees.data}) 
			console.log(donnees)
		});
	}

	cliquer(){
        console.log(this);
        console.log("click");
    }
	
	
	componentDidMount(){
		this.fetchBouteillesSAQ = this.fetchBouteillesSAQ.bind(this);
	}
	
	
	
	render() {

		const bouteilles = this.state.bouteilles
								.map((bouteille, index)=>{
									return (
										<Bouteille info={bouteille} onClick={this.cliquer.bind(bouteille)} key={index}/>
									)
								})
		
		return (
			<div class="nouvelleBouteille" vertical layout>
				<p>Recherche : <input type="text" name="nom_bouteille"/></p>
					<ul>
						{bouteilles}
					</ul>
				<div>
					<p>Nom : <span data-id="" class="nom_bouteille"></span></p>
					<p>Millesime : <input name="millesime"/></p>
					<p>Quantite : <input name="quantite" value="1"/></p>
					<p>Date achat : <input name="date_achat"/></p>
					<p>Prix : <input name="prix"/></p>
					<p>Garde : <input name="garde_jusqua"/></p>
					<p>Notes <input name="notes"/></p>
				</div>
				<button name="ajouterBouteilleCellier">Ajouter la bouteille (champs tous obligatoires)</button>
			</div>
			);
	}
}