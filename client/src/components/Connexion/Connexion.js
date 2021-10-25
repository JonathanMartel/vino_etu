import React from "react";
import "./Connexion.css";
import Page404 from "../Page404/Page404";
import {Route, Switch, BrowserRouter as Router} from 'react-router-dom';


export default class Connexion extends React.Component{
	constructor(props){
    	super(props);

        this.state = {
            
        }
        
        this.boutonEnvoyer = this.boutonSeConnecter.bind(this);
	}

    boutonSeConnecter() {
        console.log("Click sur bouton Se connecter!!!");
    }

  render() {
        console.log("Connexion");
		return (
            <article>
                <h2>Se connecter</h2>

                <div>
                    <p>Utilisateur</p>
                    <input name="nom_utilisateur_usager" placeholder="Entrez son utilisateur" type="text" />
                </div>

                <div>
                    <p>Mot de passe</p>
                    <input name="nom_usager" placeholder="Entrez son nom" type="text" />
                </div>

                <div>
                <button onClick={this.boutonSeConnecter}>Se connecter</button>
                </div>
            </article>
		);
  }
}