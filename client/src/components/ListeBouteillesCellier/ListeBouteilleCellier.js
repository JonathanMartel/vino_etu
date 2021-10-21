import React from "react";
import BouteilleCellier from "../BouteilleCellier/BouteilleCellier";

import './ListeBouteilleCellier.css';

export default class ListeBouteilleCellier extends React.Component {
	constructor(props){
	  super(props);
	  this.state = {
		  bouteilles: []
	  }
	
	}

	componentDidMount(){
        fetch("") // Insérer l'adresse pour la request HTTP
            .then(reponse => reponse.json())
            .then((donnees)=>{
                this.setState({items:donnees.data}) 
                console.log(donnees)
            });
    }

	render() {
		
	}
}