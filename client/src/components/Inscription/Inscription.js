import React from "react";
import "./Inscription.css";
import CryptoJS from "crypto-js";

/* import Page404 from "../Page404/Page404";
import {Route, Switch, BrowserRouter as Router} from 'react-router-dom'; */

export default class Inscription extends React.Component{
	constructor(props){
    	super(props);

        this.state = {
            prenom : "",
            nom : "",
            courriel : "",
            telephone : "",
            /* utilisateur : "", */
            mot_passe : "",
            est_admin : false,
            sinscrire : false,
            validation : false
        }

        this.validation = this.validation.bind(this);
        this.sinscrire = this.sinscrire.bind(this);
	}

    validation() {
        let bValidation = false;

        /* && (this.state.utilisateur && this.state.utilisateur.trim() !== "")  */
        if((this.state.prenom && this.state.prenom.trim() !== "") && (this.state.nom && this.state.nom.trim() !== "") 
            && (this.state.courriel && this.state.courriel.trim() !== "") 
            && (this.state.telephone && this.state.telephone.trim() !== "") 
            && (this.state.mot_passe && this.state.mot_passe.trim() !== "")
            && (this.state.mot_passe_verif && this.state.mot_passe_verif.trim() !== "")){
            
            // Validation selon la forme minimale [a-Z]@[a-Z]
            let expRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            let bRegex = expRegex.test(this.state.courriel);
            
            if (bRegex) {
                if (this.state.mot_passe === this.state.mot_passe_verif ) {
                    // chiffrer le mot de passe  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                    let mot_passe_chiffre = CryptoJS.AES.encrypt(this.state.mot_passe, "vinochou").toString();
                    console.log("mot_passe_chiffre: ", mot_passe_chiffre);
                    bValidation =true;
                }
            }
        }
        
        return bValidation;
    }
    
    sinscrire() {
        console.log("Click sur bouton S'inscrire!!!");

        if (this.validation()) {
            console.log("Inscrire usager!!!");

            //Vérifier s'il existe un usager avec le même courriel ? On dois valider cela ?
           
            const donnes = {
                prenom : this.state.prenom,
                nom : this.state.nom,
                courriel : this.state.courriel,
                telephone : this.state.telephone,
                /* utilisateur : this.state.utilisateur, */
                mot_passe : this.state.mot_passe,
                est_admin : 0
            }

            const postMethod = {
                method: 'POST', 
                headers: {
                    'Content-type': 'application/json',
                    'Authorization': 'Basic ' + btoa('vino:vino')
                },
                body: JSON.stringify(donnes) 
            }
    
            //Pas encore!!!
            /* fetch("http://127.0.0.1:8000/webservice/php/usagers/", postMethod)
                .then(res => res.json())  */

            //Si le POST est correct, vers la page de connexion
       } else {
            console.log("NOOOOOO inscrire usager!!!");
       }
    }

  render() {
        //console.log("Inscription");
        
		return (
            <section>
                <h2>S'inscrire</h2>

                <div>
                    <p>Prenom</p>
                    <input name="prenom" value={this.state.prenom} onChange={evt => this.setState({ prenom: evt.target.value})} placeholder="Entrez votre prenom" type="text" />
                </div>

                <div>
                    <p>Nom</p>
                    <input name="nom" value={this.state.nom} onChange={evt => this.setState({ nom: evt.target.value})} placeholder="Entrez votre nom" type="text" />
                </div>
                
                <div>
                    <p>Téléphone</p>
                    <input name="telephone" value={this.state.telephone} onChange={evt => this.setState({ telephone: evt.target.value})} placeholder="Entrez votre telephone" type="text" />
                </div>

                {/* <div>
                    <p>Utilisateur</p>
                    <input name="utilisateur" value={this.state.utilisateur} onChange={evt => this.setState({ utilisateur: evt.target.value})} placeholder="Entrez votre utilisateur" type="text" />
                </div> */}

                <div>
                    <p>Courriel</p>
                    <input name="courriel" value={this.state.courriel} onChange={evt => this.setState({ courriel: evt.target.value})} placeholder="Entrez votre courriel" type="email" />
                </div>

                <div>
                    <p>Mot de passe</p>
                    <input name="mot_passe" value={this.state.mot_passe} onChange={evt => this.setState({ mot_passe: evt.target.value})} placeholder="Entrez votre mot de passe" type="password" />
                </div>

                <div>
                    <p>Verification de Mot de passe</p>
                    <input name="mot_passe_verif" value={this.state.mot_passe_verif} onChange={evt => this.setState({ mot_passe_verif: evt.target.value})} placeholder="Entrez votre verification de mot de passe" type="password" />
                </div>
                <br/><br/>
                <div>
                    <button onClick={this.sinscrire} /* disabled={this.state.sinscrire ? '' : 'disable'} */>S'inscrire</button>
                </div>
            </section>
		);
  }
}