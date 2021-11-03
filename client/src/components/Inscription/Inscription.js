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
      telephone: "",
      /* utilisateur : "", */
      mot_passe: "",
      est_admin: false,
      sinscrire: false,
      validation: false,
    };

    this.validation = this.validation.bind(this);
    this.sinscrire = this.sinscrire.bind(this);
  }

  componentDidMount() {
      if (!this.props.estConnecte) {
        return this.props.history.push("/connexion");
      }
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
      this.state.telephone &&
      this.state.telephone.trim() !== "" &&
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

  sinscrire() {
    console.log("Click sur bouton S'inscrire!!!");

    if (this.validation()) {
      console.log("Inscrire usager!!!");

      //Vérifier s'il existe un usager avec le même courriel ? On dois valider cela ?

      const donnes = {
        prenom: this.state.prenom,
        nom: this.state.nom,
        courriel: this.state.courriel,
        telephone: this.state.telephone,
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

      //Si le POST est correct, vers la page de connexion
      //return this.props.history.push("/");
    } else {
      console.log("NOOOOOO inscrire usager!!!");
    }
  }

  render() {
    //console.log("Inscription");

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

          <button>S'inscrire</button>
        </Box>

        {/* <button onClick={this.seConnecter}>{(this.state.seConnecter ? "Se déconnecter" : "Se connecter")}</button> */}
      </Box>
    );
  }
}
