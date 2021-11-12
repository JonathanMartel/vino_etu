import React from "react";
import Entete from "../Entete/Entete";
import Pied from "../Pied/Pied";
import Page404 from "../Page404/Page404";
import AjoutBouteille from "../AjoutBouteilleCellier/AjoutBouteilleCellier";
import ListeBouteilles from "../ListeBouteillesCellier/ListeBouteilleCellier";
import Inscription from "../Inscription/Inscription";
import Connexion from "../Connexion/Connexion";
import ListeCelliers from "../ListeCelliers/ListeCellier";
import AjoutCellier from "../AjoutCellier/AjoutCellier";
import DetailsBouteille from "../DetailsBouteille/DetailsBouteille";
import { Route, Switch, BrowserRouter as Router } from "react-router-dom";
import ModifieCompte from "../ModifieCompte/ModifieCompte";
import ListeAchat from "../ListeAchat/ListeAchat";
import "./App.css";
import Admin from "../Admin/Admin";
import ModifierCellier from "../ModifierCellier/ModifierCellier";

export default class App extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      estConnecte: false,
      id_usager: undefined,
      estAdmin: false
    };

    this.seConnecter = this.seConnecter.bind(this);
    this.logout = this.logout.bind(this);
    this.fetchUsager = this.fetchUsager.bind(this);

  }

  fetchUsager(id) {
    const options = {
      method: 'GET',
      headers: {
        'Content-type': 'application/json',
        authorization: 'Basic ' + btoa('vino:vino')
      }
    };

    fetch('https://rmpdwebservices.ca/webservice/php/usagers/' + id, options)
      .then((res) => res.json())
      .then((data) => {
        if (data.data[0].est_admin === "1") {
          this.setState({ estAdmin: true })
        }
      });
  }

  seConnecter(id) {
    this.fetchUsager(id);
    this.setState({ id_usager: id, estConnecte: true });
  }

  logout() {
    this.setState({ id_usager: undefined, estConnecte: false });
  }

  render() {
    return (
      <Router>
        <Entete />
        <Switch>
          <Route
            exact
            path="/bouteille/ajout"
            component={(props) => (
              <AjoutBouteille
                estConnecte={this.state.estConnecte}
                id_usager={this.state.id_usager}
                title="Ajouter bouteille"
                estAdmin={this.state.estAdmin}
                {...props}
              />
            )}
          />

          <Route
            exact
            path="/"
            component={(props) => (
              <ListeCelliers
                estConnecte={this.state.estConnecte}
                id_usager={this.state.id_usager}
                estAdmin={this.state.estAdmin}
                title="Liste celliers"
                {...props}
              />
            )}
          />

          <Route
            exact
            path="/inscription"
            component={(props) => (
              <Inscription
                title="S'inscrire"
                estConnecte={this.state.estConnecte}
                id_usager={this.state.id_usager}
                estAdmin={this.state.estAdmin}
                {...props}
              />
            )}
          />

          <Route
            exact
            path="/compte/modifier"
            component={(props) => (
              <ModifieCompte
                estConnecte={this.state.estConnecte}
                id_usager={this.state.id_usager}
                estAdmin={this.state.estAdmin}
                title="Modifier son compte"
                {...props}
              />
            )}
          />

          <Route
            exact
            path="/connexion"
            component={(props) => (
              <Connexion
                login={this.seConnecter}
                estConnecte={this.state.estConnecte}
                id_usager={this.state.id_usager}
                estAdmin={this.state.estAdmin}
                title="Se connecter"
                {...props}
              />
            )}
          />

          <Route
            exact
            path="/celliers/liste"
            component={(props) => (
              <ListeCelliers
                estConnecte={this.state.estConnecte}
                id_usager={this.state.id_usager}
                estAdmin={this.state.estAdmin}
                title="Liste celliers"
                {...props}
              />
            )}
          />

          <Route
            exact
            path="/cellier/:id"
            render={(param_route) => (
              <ListeBouteilles
                {...param_route}
                id={param_route?.match?.params?.id}
                param={param_route}
                estConnecte={this.state.estConnecte}
                id_usager={this.state.id_usager}
                estAdmin={this.state.estAdmin}
                title="Cellier"
              />
            )}
          />

          <Route
            exact
            path="/cellier/bouteilles/:id"
            render={(param_route) => (
              <DetailsBouteille
                {...param_route}
                bouteille_id={param_route?.match?.params?.bouteille_id}
                param={param_route}
                estConnecte={this.state.estConnecte}
                id_usager={this.state.id_usager}
                estAdmin={this.state.estAdmin}
                title="Détails bouteille"
              />
            )}
          />

          <Route
            exact
            path="/admin"
            component={(props) => (
              <Admin
                estConnecte={this.state.estConnecte}
                id_usager={this.state.id_usager}
                estAdmin={this.state.estAdmin}
                title="Admin"
                {...props}
              />
            )}
          />

          <Route
            exact
            path="/celliers/ajouter"
            component={(props) => (
              <AjoutCellier
                title="Ajouter cellier"
                estConnecte={this.state.estConnecte}
                id_usager={this.state.id_usager}
                estAdmin={this.state.estAdmin}
                {...props}
              />
            )}
          />

          <Route
            exact
            path="/cellier/modifier/:id"
            component={(props) => (
              <ModifierCellier
                title="Modifier cellier"
                estConnecte={this.state.estConnecte}
                id_usager={this.state.id_usager}
                estAdmin={this.state.estAdmin}
                {...props}
              />
            )}
          />

          <Route
            exact
            path="/listeachat"
            component={(props) => (
              <ListeAchat
                title="Liste d'achat"
                estConnecte={this.state.estConnecte}
                id_usager={this.state.id_usager}
                estAdmin={this.state.estAdmin}
                {...props}
              />
            )}
          />

          <Route exact path="*" component={Page404} />
        </Switch>

        <Route
          component={(props) => (
            <Pied
              estConnecte={this.state.estConnecte}
              id_usager={this.state.id_usager}
              estAdmin={this.state.estAdmin}
              logout={this.logout}
              {...props}
            />
          )}
        />
      </Router>
    );
  }
}
