import React from "react";
import Bouteille from "../Bouteille/Bouteille";

import './ListeBouteilleSAQ.css';

export default class ListeBouteilleSAQ extends React.Component {
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
                this.setState({bouteilles:donnees.data}) 
                console.log(donnees)
            });
    }

	render() {
		
	}
}