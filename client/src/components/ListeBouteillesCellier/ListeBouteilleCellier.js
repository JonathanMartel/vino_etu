import React from "react";
import BouteilleCellier from "../BouteilleCellier/BouteilleCellier";
import { Link } from "react-router-dom";

import './ListeBouteilleCellier.css';

export default class ListeBouteilleCellier extends React.Component {
	constructor(props){
	  super(props);
	  this.state = {
		  bouteilles: [],
		  cellierId: "1" // Dummy pour faire tests
	  }

	  this.ajouter = this.ajouter.bind(this);
	  this.retirer = this.retirer.bind(this);
	  this.fetchBouteilles = this.fetchBouteilles.bind(this);
	
	}

	fetchBouteilles(){
		fetch("http://127.0.0.1:8000/webservice/php/bouteilles/cellier/" + this.state.cellierId, {
		method: 'GET',
		headers: new Headers({
			"Content-Type": "application/json",
			"authorization": "Basic " + btoa("vino:vino"),
		}),
	})
            .then(reponse => reponse.json())
            .then((donnees)=>{
                this.setState({bouteilles:donnees.data})
            });
	}

	ajouter(id){

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
					<p>Test</p>
			</div>
		);
	}
}