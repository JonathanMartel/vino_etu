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
import { Route, Switch, BrowserRouter as Router } from 'react-router-dom';
import ModifieCompte from "../ModifieCompte/ModifieCompte";
import './App.css';

export default class App extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			estConnecte: false,
			id_usager: undefined
		}

		this.seConnecter = this.seConnecter.bind(this);
	}

	seConnecter(id) {
		this.setState({id_usager: id, estConnecte: true});
	}

	render() {
		return (
			<Router>
				<Entete />
				<Switch>
					<Route exact path="/ajoutBouteille" component={AjoutBouteille} />

					<Route
						exact
						path="/inscription"
						component={(props) => (
							<Inscription title="S'inscrire" {...props} />
						)}
					/>

					<Route
						exact
						path="/compte/modifier"
						component={(props) => (
							<ModifieCompte title="Modifier son compte" id_usager={this.state.id_usager} {...props} />
						)}
					/>

				<Route exact path="/" component={(props)=> 
						<Connexion login={this.seConnecter} 
							estConnecte={this.state.estConnecte} 
							id_usager={this.state.id_usager} 
							{...props} /> } />
					
					<Route exact path="/listecelliers" component={(props)=> 
						<ListeCelliers estConnecte={this.state.estConnecte} 
							id_usager={this.state.id_usager} 
							{...props} /> } />	

					<Route exact path="/ajoutcellier" component={AjoutCellier} />

					<Route exact path="/cellier/:id" render={(param_route)=> 
							<ListeBouteilles {...param_route} id={param_route?.match?.params?.id} param={param_route}  />} />

					<Route exact path="/bouteilles/:id" render={(param_route)=> 
							<DetailsBouteille {...param_route} bouteille_id={param_route?.match?.params?.bouteille_id} param={param_route} />} />
	
    			    <Route exact path="*" component={Page404} />
        		</Switch>

        		<Route component={(props)=> 
						<Pied estConnecte={this.state.estConnecte} 
							id_usager={this.state.id_usager} 
							{...props} /> } />
      		</Router>
    );
  }

}
