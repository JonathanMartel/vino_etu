import React from "react";
import Entete from '../Entete/Entete';
import Accueil from '../Accueil/Accueil';
import Pied from '../Pied/Pied';
import Page404 from "../Page404/Page404";
import AjoutBouteilleCellier from "../AjoutBouteilleCellier/AjoutBouteilleCellier";
import ListeBouteilleCellier from "../ListeBouteillesCellier/ListeBouteilleCellier";
import AjoutCellier from "../AjoutCellier/AjoutCellier";

import {Route, Switch, BrowserRouter as Router} from 'react-router-dom';

import './App.css';




export default class App extends React.Component{
	constructor(props){
    	super(props);

	}

  render() {

		return (
			<Router>
        <Entete/>
				<Switch>
					<Route exact path="/" component={Accueil} />
					<Route exact path="/ajoutbouteillecellier" component={AjoutBouteilleCellier} />
					<Route exact path="/listebouteillescellier" component={ListeBouteilleCellier} />
					<Route exact path="/ajoutcellier" component={AjoutCellier} />
					<Route exact path="/cellier/:id" render={(param_route)=><ListeBouteilleCellier {...param_route} id={param_route?.match?.params?.id} param={param_route} />}
					/>
					<Route exact path="*" component={Page404} />
				</Switch>
        <Pied/>
			</Router>
		
		);
  }
}