import React from "react";
import BouteilleCellier from "../BouteilleCellier/BouteilleCellier";
import { Link } from "react-router-dom";

import "./ListeBouteilleCellier.css";
import Dialogue from "../Dialogue/Dialogue";

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
    };

    this.fetchBouteilles = this.fetchBouteilles.bind(this);
    this.ajouter = this.ajouter.bind(this);
    this.retirer = this.retirer.bind(this);
    this.changerQuantite = this.changerQuantite.bind(this);
    this.changerTitreDialogue = this.changerTitreDialogue.bind(this);
    this.ajouterAction = this.ajouterAction.bind(this);
    this.retirerAction = this.retirerAction.bind(this);
  }

  componentDidUpdate() {
    console.log(this.state.qteModif);
  }

  fetchBouteilles() {
    fetch(
      "https://rmpdwebservices.ca/webservice/php/celliers/" +
      this.props.match.params.id,
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
        console.log("Diana : ", donnees);
        this.setState({ items: donnees.data });
      });
  }

  changerQuantite(valeur) {
    this.setState({ qteModif: valeur, open: false });
    console.log(valeur, " BOUTEILLES ONT ÉTÉ MODIFIÉES");

    if (this.state.action == "ajouter") {
      //fetch add
      this.ajouter(this.state.item);
    } else {
      //fetch subtract
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

  ajouter(item) {
    //console.log(this.state.qteModif);
    this.setState({ open: false });
    const donnes = {
      id: item.id,
      quantite: this.state.qteModif,
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
        //this.setState({ id_usager: res.data });
        if (data.data) {
          this.fetchBouteilles();
        } else {
          console.log("Erreur.");
        }
      });
    this.setState({ message: "" });
  }

  retirer(item) {
    if (item.quantite >= this.state.qteModif) {
      this.setState({ qteModif: -this.state.qteModif });
      const donnes = {
        id: item.id,
        quantite: this.state.qteModif,
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
        "https://rmpdwebservices.ca/webservice/php/bouteilles/quantite", postMethod)
        .then((res) => res.json())
        .then((res) => {
          this.setState({ id_usager: res.data });
          if (res.data) {
            this.fetchBouteilles();
          } else {
            console.log("Erreur.");
          }
        });
      this.setState({ message: "" });
    } else {
      this.setState({ message: "Il n'y a pas de bouteilles pour retirer" });
    }
  }

  componentDidMount() {
    this.fetchBouteilles();
  }

  render() {
    const bouteilles = this.state.items.map((item, index) => {
      return (
        <div key={index}>
          {/* <p className="messagRouge"> {this.state.message} </p> */}
          <BouteilleCellier info={item} />
          <button onClick={(e) => this.ajouterAction(item)}>
            Ajouter une bouteille
          </button>
          <button onClick={(e) => this.retirerAction(item)}>
            Retirer une bouteille
          </button>
        </div>
      );
    });

    return (
      <section>
        <Link to={"/ajoutBouteille"}>
          <span>Ajouter une nouvelle bouteille à votre cellier</span>
        </Link>

        <div>
          <Dialogue
            open={this.state.open}
            titre={this.state.titre}
            action={this.state.action}
            changerQuantite={this.changerQuantite}
            getQuantite={this.state.qteModif}
          />
          {bouteilles}
        </div>
      </section>
    );
  }
}
