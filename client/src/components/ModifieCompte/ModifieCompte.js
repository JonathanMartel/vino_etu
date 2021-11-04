import React from "react";
import "./ModifieCompte.css";
import Bcryptjs from "bcryptjs";
import { Box } from "@mui/system";
import { TextField } from "@mui/material";

export default class ModifieCompte extends React.Component {
    constructor(props) {
        super(props);

        // Object contenant les informations d'un utilisateur
        this.state = {
            prenom: "",
            nom: "",
            courriel: "",
            mot_passe: "",
            modifier: false,
            validation: false,
        };

        // Bind des fonctions
        this.validation = this.validation.bind(this);
        this.modifier = this.modifier.bind(this);
    }

    // À voir avec bobby
    // Est-ce nécéssaire en PUT?
    // componentDidMount() {
    //     if (this.props.estConnecte) {
    //         this.props.history.push("/connexion");
    //     }
    // }


    // Validation du formulaire
    validation() {
        let bValidation = false;

        if (
            this.state.prenom &&
            this.state.prenom.trim() !== "" &&
            this.state.nom &&
            this.state.nom.trim() !== "" &&
            this.state.courriel &&
            this.state.courriel.trim() !== "" &&
            this.state.mot_passe &&
            this.state.mot_passe.trim() !== "" &&
            this.state.mot_passe_verif &&
            this.state.mot_passe_verif.trim() !== ""
        ) {
            // Validation selon la forme minimale [a-Z]@[a-Z]
            let expRegex =
                /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            let bRegex = expRegex.test(this.state.courriel);

            if (bRegex) {
                if (this.state.mot_passe === this.state.mot_passe_verif) {
                    // chiffrer le mot de passe  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                    let mot_passe_chiffre = Bcryptjs.hashSync(
                        this.state.mot_passe
                    ).toString();
                    console.log("mot_passe_chiffre: ", mot_passe_chiffre);
                    bValidation = true;
                }
            }
        }

        return bValidation;
    }

    // Fonction pour modifier les informations de l'usager. À faire véréfier par Bobbychou.
    modifier() {
        console.log("Click sur bouton modifier!!!");

        if (this.validation()) {
            console.log("Modifier usager!!!");

            const donnes = {
                prenom: this.state.prenom,
                nom: this.state.nom,
                courriel: this.state.courriel,
                mot_passe: this.state.mot_passe,
            };

            const putMethod = {
                method: "PUT",
                headers: {
                    "Content-type": "application/json",
                    authorization: "Basic " + btoa("vino:vino"),
                },
                body: JSON.stringify(donnes),
            };

            fetch("https://rmpdwebservices.ca/webservice/php/usagers", putMethod)
                .then(res => res.json())

            //Si le PUT est correct, redirection à faire
        } else {
            console.log("Pas de modifications pour toé messieu!!!");
        }
    }

    // Affichage
    render() {

        return (
            <Box
                className="modification_contenu"
                sx={{
                    backgroundColor: "rgba(0, 0, 0, 0.8)",
                    display: "flex",
                    justfyContent: "center",
                    alignItems: "center",
                    gap: "1rem",
                    width: "85vw",
                    flexDirection: "column",
                    borderRadius: "1rem",
                    margin: "0 auto",
                    marginTop: "10vh",
                }}
            >
                <Box
                    sx={{
                        display: "flex",
                        width: "80%",
                        flexDirection: "column",
                        gap: "2rem",
                    }}
                >
                    <span className="modification_titre">Modifier son compte</span>

                    <Box
                        sx={{
                            display: "flex",
                            flexDirection: "column",
                            gap: "1rem",
                        }}
                    >
                        <TextField
                            label="Nom"
                            variant="outlined"
                        />
                        <TextField
                            label="Prénom"
                            variant="outlined"
                        />
                        <TextField
                            label="Courriel"
                            variant="outlined"
                            type="email"
                        />
                        <TextField
                            label="Mot de passe"
                            variant="outlined"
                            type="password"
                        />
                        <TextField
                            label="Confirmer mot de passe"
                            variant="outlined"
                            type="password"
                        />

                        {/* <input name="courriel" onKeyUp={evt => this.setState({ courriel: evt.target.value })} placeholder="bobus@gmail.com" type="email" />
                        <input name="mot_passe" onKeyUp={evt => this.setState({ mot_passe: evt.target.value })} placeholder="12345" type="password" /> */}
                    </Box>

                    <button>Modifier</button>
                </Box>

                {/* <button onClick={this.seConnecter}>{(this.state.seConnecter ? "Se déconnecter" : "Se connecter")}</button> */}
            </Box>
        );
    }
}
