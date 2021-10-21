import React from "react";
import BouteilleCellier from "../BouteilleCellier/BouteilleCellier";

import './ListeBouteilleCellier.css';

export default class ListeBouteilleCellier extends React.Component {
	constructor(props){
	  super(props);
	  this.state = {
		  bouteilles: []
	  }

	  this.ajouter = this.ajouter.bind(this);
	  this.retirer = this.retirer.bind(this);
	  this.fetchBouteilles = this.fetchBouteilles.bind(this);
	
	}

	fetchBouteilles(){
		fetch("") // Insérer l'adresse pour la request HTTP
            .then(reponse => reponse.json())
            .then((donnees)=>{
                this.setState({bouteilles:donnees.data})
                console.log(donnees)
            });
	}

	ajouter(id){
		 const entete = new Headers();
		 entete.append("Content-Type", "application/json");

		 const reqOptions = {
            method: 'PATCH',
            headers: entete,
            body: , // Insérer le contenu du body nécessaire
            redirect: 'follow'
        };
        return fetch("", reqOptions) // Insérer l'adresse de la requete HTTP 
        .then(reponse => reponse.json())
        .then(()=>{
            this.fetchBouteilles();
        });

	}

	retirer(id){
		const entete = new Headers();
		 entete.append("Content-Type", "application/json");

		 const reqOptions = {
            method: 'PATCH',
            headers: entete,
            body: , // Insérer le contenu du body nécessaire
            redirect: 'follow'
        };
        return fetch("", reqOptions) // Insérer l'adresse de la requete HTTP 
        .then(reponse => reponse.json())
        .then(()=>{
            this.fetchBouteilles();
        });
	}

	componentDidMount(){
        this.fetchBouteilles();
    }

	
	render() {
		const bouteilles = this.state.bouteilles
								.map((bouteille, index)=>{
									return (
										<BouteilleCellier bouteille={bouteille} key={index}/>
										<button onClick={this.ajouter(index)}>Ajouter une bouteille</button>
										<button onClick={this.retirer(index)}>Retirer une bouteille</button>
									);
								})

		return (
			<section className="listeBouteilleCellier">
				{bouteilles}
			</section>
		);
	}
}