import React from "react";
import Entete from '../Entete/Entete';
import Accueil from '../Accueil/Accueil';
import Pied from '../Pied/Pied';
import Page404 from "../Page404/Page404";
import AjoutBouteilleCellier from "../AjoutBouteilleCellier/AjoutBouteilleCellier";

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
					<Route exact path="/ajoutbouteille">
						 <AjoutBouteilleCellier />
					</Route>
					<Route exact path="*" component={Page404} />
				</Switch>
        <Pied/>
			</Router>
		
		);
  }
}