import React from 'react';
import BoutonNav from '../BoutonNav/BoutonNav';

import { Link, NavLink } from 'react-router-dom';

import './Entete.css';

export default class Entete extends React.Component {
	constructor(props){
	  super(props);
	
	}

	render() {

		return (  
				<div>
					<nav>
						<ul>
							<li><BoutonNav lien="/" label="Accueil"/></li>
						</ul>
					</nav>
				</div>
			);
	}
}