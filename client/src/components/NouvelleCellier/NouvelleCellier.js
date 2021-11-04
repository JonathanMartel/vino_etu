import React from "react";

import './NouvelleCellier.css';

export default class NouvelleCellier extends React.Component {
    constructor(props) {
		super(props);

        this.state = {
            emplacement: "",
            temperature: 10,
            usager_id: 0
        }

        this.validation = this.validation.bind(this);
        this.creerCellier = this.creerCellier.bind(this);
	}

    componentDidMount() {
		if (!this.props.estConnecte) {
			return this.props.history.push("/");
		}
	}

    validation()  {
        let bValidation = false;

        if ( this.state.emplacement && this.state.emplacement.trim() !== "" &&
            this.state.temperature) {
                bValidation = true;
        } 

        return bValidation;
    }

    creerCellier() {
        console.log("Click en création de cellier!");

        if (this.validation()) {
            let donnes = {
                emplacement: this.state.emplacement,
                usager_id: this.props.id_usager /* ,
                temperature: this.state.temperature */
            };
            console.log("Donnes: ", donnes);

            const postMethod = {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json',
                    authorization: 'Basic ' + btoa('vino:vino')
                },
                body: JSON.stringify(donnes)
            };
    
            fetch('https://rmpdwebservices.ca/webservice/php/celliers/', postMethod)
                .then((reponse) => reponse.json())
                .then((donnees) => {
                    if (donnees.data) return this.props.history.push("/ListeCelliers/");
                });

        } else {
            console.log("Validation incorrecte!!!");
        }
    }

    render() {
        return (
            <form>
                <p>Emplacement : <input name="emplacement" value={this.state.emplacement} onChange={(e) => this.setState({ emplacement: e.target.value })} /></p>
				<p>Température : <input type="number" step="0.5" name="temperature" value={this.state.temperature} onChange={e => this.setState({ temperature: e.target.value })} /></p>

				<button type="button" onClick={(e) => this.creerCellier()}>Créer cellier</button>
            </form>
        );
    }
}