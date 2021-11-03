import React from "react";
import "./Connexion.css";

export default class Connexion extends React.Component{
	constructor(props){
    	super(props);

        this.state = {
            courriel : "",
            mot_passe : "",
            id_usager : undefined
        }
        
        this.validation = this.validation.bind(this);
        this.seConnecter = this.seConnecter.bind(this);

        console.log("Mon props: ", this.props);
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
            } else {
                console.log("Courriel non admissible");
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

            const putMethod = {
                method: 'PUT', 
                headers: {
                    'Content-type': 'application/json',
                    'authorization': 'Basic ' + btoa('vino:vino')
                },
                body: JSON.stringify(donnes) 
            }
    

            fetch("https://rmpdwebservices.ca/webservice/php/usagers/login/", putMethod)
                .then(res => res.json()) 
                .then((res) => {
                    if (res.data) {
                        this.setState({id_usager: res.data})
                        this.props.test(res.data)
                        console.log("Connexion avec succès!!!", res.data)
                        this.props.history.push("/listecelliers");
                    } else {
                        console.log("Courriel ou mot de passe incorrect.")
                    }
                });
        }
    }

  render() {
        /* const connectado = this.state.seConnecter; */
        console.log("Usager connecté : ", this.state.id_usager); //Retourne false si ne trouve pas l'usager
        console.log("this.props.id_usager: ", this.props.id_usager);

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
                    <button onClick={()=>this.seConnecter()} >Se connecter</button>
                </div>
            </section>
		);
  }
}