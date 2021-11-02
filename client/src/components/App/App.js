import React from "react";
import Entete from "../Entete/Entete";
import Accueil from "../Accueil/Accueil";
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
import "./App.css";

export default class App extends React.Component {
  constructor(props) {
    super(props);

    this.state = {};
  }

  login() {}

  render() {
    return (
      <Router>
        <Entete />
        <Switch>
          <Route
            exact
            path="/"
            component={(props) => <Connexion title="Se connecter" />}
          />
          <Route exact path="/ajoutBouteille" component={AjoutBouteille} />

          <Route
            exact
            path="/inscription"
            component={(props) => (
              <Inscription title="S'enregistrer" {...props} />
            )}
          />
          <Route exact path="/connexion" component={Connexion} />

          {/* <Route exact path="/connexion" component={() => <Connexion /> } />	 */}
          <Route exact path="/listecelliers/:id" component={ListeCelliers} />

          <Route exact path="/ajoutcellier" component={AjoutCellier} />
          <Route
            exact
            path="/cellier/:id"
            render={(param_route) => (
              <ListeBouteilles
                {...param_route}
                id={param_route?.match?.params?.id}
                param={param_route}
              />
            )}
          />
          {/* <Route exact path="/bouteilles/:id" component={DetailsBouteille} /> */}
          <Route
            exact
            path="/bouteilles/:id"
            render={(param_route) => (
              <DetailsBouteille
                {...param_route}
                bouteille_id={param_route?.match?.params?.bouteille_id}
                param={param_route}
              />
            )}
          />

          <Route exact path="*" component={Page404} />
        </Switch>
        <Pied />
      </Router>
    );
  }
}
