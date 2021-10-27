import React from "react";
import "./Connexion.css";
import CryptoJS from "crypto-js";

/* import Page404 from "../Page404/Page404";
import {Route, Switch, BrowserRouter as Router} from 'react-router-dom'; */


export default class Connexion extends React.Component{
	constructor(props){
    	super(props);

        this.state = {
            courriel : "",
            mot_passe : ""
        }
        
        this.validation = this.validation.bind(this);
        this.seConnecter = this.seConnecter.bind(this);
	}

    validation() {
        let bValidation = false;

        if((this.state.courriel && this.state.courriel.trim() !== "") 
            && (this.state.mot_passe && this.state.mot_passe.trim() !== "")){
            
            // Validation selon la forme minimale [a-Z]@[a-Z]
            let expRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            let bRegex = expRegex.test(this.state.courriel);
            
            if (bRegex) {
                //Il faut chiffrer le mot de passe !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                bValidation =true;
            }
        }
        
        return bValidation;
    }

    seConnecter() {
        console.log("Click sur bouton Se connecter!!!");

        if (this.validation()) {
            console.log("Connexion usager!!!");

            let mot_passe_chiffre = CryptoJS.AES.encrypt(this.state.mot_passe, "vinochou").toString();
            console.log("mot_passe_chiffre: ", mot_passe_chiffre);

            const donnes = {
                courriel : this.state.courriel,
                mot_passe : mot_passe_chiffre
            }

            const postMethod = {
                method: 'PUT', 
                headers: {
                    'Content-type': 'application/json',
                    'Authorization': 'Basic ' + btoa('vino:vino')
                },
                body: JSON.stringify(donnes) 
            }
    
            //Pas encore!!!
            /* fetch("http://127.0.0.1:8000/webservice/php/usagers/", postMethod)
                .then(res => res.json()) 
                .then(res => console.log("Connexion réussi !!!")) */

            //Si le PUT viens en TRUE, l'usager existe, vers l'accueil
            
        }
    }

  render() {
        console.log("Connexion");
		return (
            <section>
                <h2>Se connecter</h2>

                <div>
                    <p>Courriel</p>
                    <input name="courriel" value={this.state.courriel} onChange={evt => this.setState({ courriel: evt.target.value})} placeholder="Entrez son courriel" type="email" />
                </div>

                <div>
                    <p>Mot de passe</p>
                    <input name="mot_passe" value={this.state.mot_passe} onChange={evt => this.setState({ mot_passe: evt.target.value})} placeholder="Entrez son mot_passe" type="password" />
                </div>

                <br/> <br/>
                <div>
                    <button onClick={this.seConnecter}>Se connecter</button>
                </div>
            </section>
		);
  }
}