import React from "react";
import "./Inscription.css";
import Bcryptjs from "bcryptjs";
import { Box } from "@mui/system";
import { TextField } from "@mui/material";

/* import Page404 from "../Page404/Page404";
import {Route, Switch, BrowserRouter as Router} from 'react-router-dom'; */

export default class Inscription extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      prenom: "",
      nom: "",
      courriel: "",
      mot_passe: "",
      est_admin: false,
      sinscrire: false,
      validation: false,
    };

    this.validation = this.validation.bind(this);
    this.sinscrire = this.sinscrire.bind(this);
  }

  validation() {
    let bValidation = false;

    /* && (this.state.utilisateur && this.state.utilisateur.trim() !== "")  */
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
          /* let mot_passe_chiffre = Bcryptjs.hashSync(
            this.state.mot_passe
          ).toString();
          console.log("mot_passe_chiffre: ", mot_passe_chiffre); */
          bValidation = true;
        }
      }
    }

    return bValidation;
  }

  sinscrire() {

    if (this.validation()) {
      //Vérifier s'il existe un usager avec le même courriel ? On dois valider cela ? SQL courriel UNIQUE

      const donnes = {
        prenom: this.state.prenom,
        nom: this.state.nom,
        courriel: this.state.courriel,
        mot_passe: this.state.mot_passe,
        est_admin: 0,
      };

      const postMethod = {
        method: "POST",
        headers: {
          "Content-type": "application/json",
          authorization: "Basic " + btoa("vino:vino"),
        },
        body: JSON.stringify(donnes),
      };

      fetch("https://rmpdwebservices.ca/webservice/php/usagers/", postMethod)
                .then(res => res.json()) 
                .then((data) => {
                    if (data.data) {
                      this.props.history.push("/connexion");
                    } else {
                      console.log("Erreur à l'inscription d'usager");
                    }
                });
    } else {
      console.log("Validation incorrecte!!!");
    }
  }

  render() {
    console.log("Inscription");

    return (
      <Box
        className="register_container"
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
          <span className="register_title">Créer un compte</span>

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
              onBlur={evt => this.setState({ nom: evt.target.value })}
            />
            <TextField
              label="Prénom"
              variant="outlined"
              onBlur={evt => this.setState({ prenom: evt.target.value })}
            />
            <TextField
              label="Courriel"
              variant="outlined"
              type="email"
              onBlur={evt => this.setState({ courriel: evt.target.value })}
            />
            <TextField
              label="Mot de passe"
              variant="outlined"
              type="password"
              onBlur={evt => this.setState({ mot_passe: evt.target.value })}
            />
            <TextField
              label="Confirmer mot de passe"
              variant="outlined"
              type="password"
              onBlur={evt => this.setState({ mot_passe_verif: evt.target.value })}
            />

          </Box>

          <button onClick={() => this.sinscrire()}>S'inscrire</button>
        </Box>
      </Box>
    );
  }
}
