import React, { useState, useEffect } from "react";
import BouteilleCellier from "../BouteilleCellier/BouteilleCellier";
import paysJSON from "../../pays.json";

import "./ListeBouteilleCellier.css";
import Dialogue from "../Dialogue/Dialogue";
import { circularProgressClasses } from "@mui/material";
import { Box } from "@mui/system";
import { Breadcrumbs, Link, Typography } from "@mui/material";
import InputLabel from '@mui/material/InputLabel';
import MenuItem from '@mui/material/MenuItem';
import ListSubheader from '@mui/material/ListSubheader';
import FormControl from '@mui/material/FormControl';
import Select from '@mui/material/Select';


export default class ListeBouteilleCellier extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      qteModif: "",
      qteInventaire: "",
      items: [],
      item: undefined,
      message: "",
      open: false,
      titre: "",
      action: undefined,
      premierId: undefined,
      nomCellier: undefined,
    };

    this.fetchBouteilles = this.fetchBouteilles.bind(this);
    this.ajouter = this.ajouter.bind(this);
    this.retirer = this.retirer.bind(this);
    this.changerQuantite = this.changerQuantite.bind(this);
    this.changerTitreDialogue = this.changerTitreDialogue.bind(this);
    this.ajouterAction = this.ajouterAction.bind(this);
    this.retirerAction = this.retirerAction.bind(this);
    this.sortBouteilles = this.sortBouteilles.bind(this);
  }

  componentDidMount() {
    this.fetchBouteilles();
  }

  componentDidUpdate() {}

  sortBouteilles(key, order) {
    if (order.toUpperCase() === "ASC") {
      return this.state.items.sort((a, b) => a[key].localeCompare(b[key]));
    } else if (order.toUpperCase() === "DESC") {
      return this.state.items.sort((a, b) => b[key].localeCompare(a[key]));
    }
  }

  triBouteilles(order) {
	  console.log(order);
  }

  triBouteillesASC(key) {
    return this.state.items.sort((a, b) => a[key].localeCompare(b[key]));
  }

  triBouteillesDESC(key) {
    return this.state.items.sort((a, b) => b[key].localeCompare(a[key]));
  }

  fetchBouteilles() {
    fetch(
      "https://rmpdwebservices.ca/webservice/php/celliers/" +
        this.props.match.params.id +
        "/bouteilles",
      {
        method: "GET",
        headers: new Headers({
          "Content-Type": "application/json",
          authorization: "Basic " + btoa("vino:vino"),
        }),
      }
    )
      .then((reponse) => reponse.json())
      .then((donnees) => {
        this.setState({
          items: donnees.data,
          premierId: donnees.data[0].id,
          nomCellier: donnees.data[0].emplacement,
        });
        console.log(this.state.premierId);
        console.log(this.state.items);
      });
  }

  changerQuantite(valeur) {
    this.setState({ qteModif: valeur, open: false });

    if (this.state.action == "ajouter") {
      this.ajouter(this.state.item, valeur);
    } else {
      this.retirer(this.state.item, valeur);
    }
  }

  ajouterAction(item) {
    this.setState({
      item: item,
      action: "ajouter",
      open: true,
    });
    this.changerTitreDialogue("Ajouter à l'inventaire");
  }

  retirerAction(item) {
    this.setState({
      item: item,
      action: "retirer",
      open: true,
    });
    this.changerTitreDialogue("Retirer de l'inventaire");
  }

  changerTitreDialogue(titre) {
    this.setState({ titre: titre });
  }

  ajouter(item, quantite) {
    this.setState({ open: false });
    const donnes = {
      id: item.id,
      quantite: quantite,
    };

    const postMethod = {
      method: "PUT",
      headers: {
        "Content-type": "application/json",
        authorization: "Basic " + btoa("vino:vino"),
      },
      body: JSON.stringify(donnes),
    };

    fetch(
      "https://rmpdwebservices.ca/webservice/php/bouteilles/quantite",
      postMethod
    )
      .then((res) => res.json())
      .then((data) => {
        if (data.data) {
          this.fetchBouteilles();
        } else {
        }
      });
    this.setState({ message: "" });
  }

  retirer(item, quantite) {
    if (item.quantite >= quantite) {
      let quantiteInversee = -quantite;
      const donnes = {
        id: item.id,
        quantite: quantiteInversee,
      };

      const postMethod = {
        method: "PUT",
        headers: {
          "Content-type": "application/json",
          authorization: "Basic " + btoa("vino:vino"),
        },
        body: JSON.stringify(donnes),
      };

      fetch(
        "https://rmpdwebservices.ca/webservice/php/bouteilles/quantite",
        postMethod
      )
        .then((res) => res.json())
        .then((data) => {
          if (data.data) {
            this.fetchBouteilles();
          } else {
          }
        });
      this.setState({ message: "" });
    } else {
      this.setState({
        message:
          "Il n'y a pas assez de bouteilles pour retirer la quantité demandée",
      });
    }
  }

  render() {
    const premierId = this.state.premierId;
    const bouteilles = this.state.items.map((item, index) => {
      return (
        <div>
          {premierId ? (
            <div key={index}>
              {/*<p className="messageErreur"> {this.state.message} </p>*/}
              <BouteilleCellier
                info={item}
                ajouterAction={this.ajouterAction}
                retirerAction={this.retirerAction}
              />
            </div>
          ) : (
            <div className="cellier_vide">
              Il n'y a pas de bouteilles dans votre cellier
            </div>
          )}
        </div>
      );
    });

    return (
      <Box>
        <Breadcrumbs
          aria-label="breadcrumb"
          sx={{ display: "flex", margin: "0 1.5rem" }}
        >
          <Link underline="hover" color="white" href="/celliers/liste">
            Celliers
          </Link>
          <Typography color="text.primary">{this.state.nomCellier}</Typography>
          <Typography color="text.primary">Liste des bouteilles</Typography>
        </Breadcrumbs>
        <FormControl sx={{ m: 1, minWidth: 120 }}>
          <InputLabel htmlFor="grouped-native-select">Trier par</InputLabel>
          <Select
            native
            defaultValue=""
            id="grouped-native-select"
            label="Grouping"
			onChange={(e) => this.triBouteilles(e.target.value)}
          >
            <option aria-label="None" value="" />
            <optgroup label="Nom">
              <option value={"nomasc"}>Nom (A-Z)</option>
              <option value={"nomdesc"}>Nom (Z-A)</option>
            </optgroup>
            <optgroup label="Millesime">
              <option value={"milasc"}>Millesime Ascendant</option>
              <option value={"mildesc"}>Millesime Descendant</option>
            </optgroup>
			<optgroup label="Pays">
              <option value={"paysasc"}>Pays (A-Z)</option>
              <option value={"paysdesc"}>Pays (Z-A)</option>
            </optgroup>
          </Select>
        </FormControl>
        <section>
          <Dialogue
            open={this.state.open}
            titre={this.state.titre}
            action={this.state.action}
            changerQuantite={this.changerQuantite}
            getQuantite={this.state.qteModif}
          />

          <div className="liste_bouteilles">{bouteilles}</div>
        </section>
      </Box>
    );
  }
}
