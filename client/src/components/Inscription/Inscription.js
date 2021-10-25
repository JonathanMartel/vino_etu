import React from "react";
import "./Inscription.css";
import Page404 from "../Page404/Page404";
import {Route, Switch, BrowserRouter as Router} from 'react-router-dom';




export default class Inscription extends React.Component{
	constructor(props){
    	super(props);

        this.state = {
            
        }
        
        this.boutonEnvoyer = this.boutonSinscrire.bind(this);
	}

    boutonSinscrire() {
        console.log("Click sur bouton S'inscrire!!!");
    }

  render() {
        console.log("Inscription");
		return (
            <article>
                <h2>S'inscrire</h2>

                <div>
                    <p>Prenom</p>
                    <input name="prenom_usager" placeholder="Entrez son prenom" type="text" />
                </div>

                <div>
                    <p>Nom</p>
                    <input name="nom_usager" placeholder="Entrez son nom" type="text" />
                </div>

                <div>
                    <p>Utilisateur</p>
                    <input name="nom_utilisateur_usager" placeholder="Entrez son utilisateur" type="text" />
                </div>

                <div>
                    <p>Mot de passe</p>
                    <input name="nom_usager" placeholder="Entrez son nom" type="text" />
                </div>

                <div>
                <button onClick={this.boutonSinscrire}>S'inscrire</button>
                </div>
            </article>
		);
  }
}