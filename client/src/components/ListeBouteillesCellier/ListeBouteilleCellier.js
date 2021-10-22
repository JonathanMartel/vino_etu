import React from "react";
import BouteilleCellier from "../BouteilleCellier/BouteilleCellier";
import { Link } from "react-router-dom";

import './ListeBouteilleCellier.css';

export default class ListeBouteilleCellier extends React.Component {
	constructor(props){
	  super(props);
	  this.state = {
		  bouteilles: [],
		  voirModal: false,
	  }

	  this.ajouter = this.ajouter.bind(this);
	  this.retirer = this.retirer.bind(this);
	  this.fetchBouteilles = this.fetchBouteilles.bind(this);
	  this.ouvrirModal = this.ouvrirModal.bind(this);
	  this.fermerModal = this.fermerModal.bind(this);
	
	}

	fetchBouteilles(){
		fetch("") // Insérer l'adresse pour la request HTTP
            .then(reponse => reponse.json())
            .then((donnees)=>{
                this.setState({bouteilles:donnees.data})
                console.log(donnees)
            });
	}

	ouvrirModal(){
		this.setState({voirModal: true});
	}

	fermerModal(){
		this.setState({voirModal: false});
	}
	
	ajouter(id){

		this.ouvrirModal();

		 const entete = new Headers();
		 entete.append("Content-Type", "application/json");

		 const reqOptions = {
            method: 'PUT',
            headers: entete,
            body: "", // Insérer le contenu du body nécessaire
            redirect: 'follow'
        };
        return fetch("", reqOptions) // Insérer l'adresse de la requete HTTP 
        .then(reponse => reponse.json())
        .then(()=>{
            this.fetchBouteilles();
        });

	}

	retirer(id){

		this.ouvrirModal();
		
		const entete = new Headers();
		 entete.append("Content-Type", "application/json");

		 const reqOptions = {
            method: 'PUT',
            headers: entete,
            body: "", // Insérer le contenu du body nécessaire
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
										<div>
										<BouteilleCellier bouteille={bouteille} key={index}/>
										<button onClick={this.ajouter(index)}>Ajouter une bouteille</button>
										<button onClick={this.retirer(index)}>Retirer une bouteille</button>
										</div>
									);
								})

		return (
			<div>
				<Link to={"/ajoutbouteillecellier"}>
					<span>Ajouter une nouvelle bouteille à votre cellier</span>
				</Link>
				
				<div>
					{bouteilles}
				</div>
			</div>
		);
	}
}