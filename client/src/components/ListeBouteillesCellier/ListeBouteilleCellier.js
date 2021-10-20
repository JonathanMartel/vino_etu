import React from "react";
import Bouteille from "../Bouteille/Bouteille";

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