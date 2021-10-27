import React from "react";
import "./Connexion.css";
import Page404 from "../Page404/Page404";
import {Route, Redirect, withRouter, Switch, BrowserRouter as Router} from 'react-router-dom'; 
import ListeCelliers from "../ListeCelliers/ListeCellier"

export default class Connexion extends React.Component{
	constructor(props){
    	super(props);

        this.state = {
            courriel : "",
            mot_passe : "",
            estConnecte : false
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
                bValidation =true;
            }
        }
        
        return bValidation;
    }

    seConnecter() {
        if (this.validation()) {
            const donnes = {
                courriel : this.state.courriel,
                mot_passe : this.state.mot_passe
            }

            const postMethod = {
                method: 'PUT', 
                headers: {
                    'Content-type': 'application/json',
                    'authorization': 'Basic ' + btoa('vino:vino')
                },
                body: JSON.stringify(donnes) 
            }
    
            fetch("http://127.0.0.1:8000/webservice/php/usagers/login/", postMethod)
                .then(res => res.json()) 
                .then((res) => {
                    this.setState({estConnecte: res.data})
                    if (res.data) {
                        console.log("Connexion ?", res.data)
                        /* this.props.history.push("/"); */
                        this.props.history.push("/ListeCelliers");
                    } else {
                        console.log("Courriel ou mot de passe incorrect.")
                    }
                    console.log("Connexion ?", res)
                });
        }
    }

  render() {
		return (
            <section>
                <h2>Se connecter</h2>

                <div>
                    <p>Courriel</p>
                    <input name="courriel" onKeyUp={evt => this.setState({ courriel: evt.target.value})} placeholder="Entrez son courriel" type="email" />
                </div>

                <div>
                    <p>Mot de passe</p>
                    <input name="mot_passe" onKeyUp={evt => this.setState({ mot_passe: evt.target.value})} placeholder="Entrez son mot_passe" type="password" />
                </div>

                <br/> <br/>
                <div>
                    <button onClick={this.seConnecter}>Se connecter</button>
                </div>
            </section>
		);
  }
}