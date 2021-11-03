import React from "react";
import Page404 from "../Page404/Page404";
import {
    Route,
    Redirect,
    withRouter,
    Switch,
    BrowserRouter as Router,
} from "react-router-dom";
import { Box } from "@mui/system";
import { TextField } from "@mui/material";
import "./Connexion.css";

export default class Connexion extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            courriel: "",
            mot_passe: "",
            id_usager: undefined
        }

        this.validation = this.validation.bind(this);
        this.seConnecter = this.seConnecter.bind(this);

        console.log("Mon props: ", this.props);
    }

    validation() {
        let bValidation = false;

        if ((this.state.courriel && this.state.courriel.trim() !== "")
            && (this.state.mot_passe && this.state.mot_passe.trim() !== "")) {

            // Validation selon la forme minimale [a-Z]@[a-Z]
            let expRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            let bRegex = expRegex.test(this.state.courriel);

            if (bRegex) {
                bValidation = true;
            } else {
                console.log("Courriel non admissible");
            }
        }

        return bValidation;
    }

    seConnecter() {
        if (this.validation()) {
            const donnes = {
                courriel: this.state.courriel,
                mot_passe: this.state.mot_passe
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
                        this.setState({ id_usager: res.data })
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
            <Box
                className="login_container"
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
                    marginTop: "20vh",
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
                    <span className="login_title">Bienvenue dans votre cellier</span>

                    <Box
                        sx={{
                            display: "flex",
                            flexDirection: "column",
                            gap: "1rem",
                        }}
                    >
                        <TextField label="Courriel" variant="outlined" 
                            onBlur={evt => this.setState({ courriel: evt.target.value })} 
                            placeholder="bobus@gmail.com" 
                        />
                        <TextField
                            label="Mot de passe"
                            type="password"
                            variant="outlined"
                            onBlur={evt => this.setState({ mot_passe: evt.target.value })}
                            placeholder="12345"
                        />
                    </Box>

                    <button onClick={() => this.seConnecter()} >Se connecter</button>
                </Box>
            </Box>
        );
    }
}
