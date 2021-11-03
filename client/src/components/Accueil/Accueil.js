import React from "react";
import fondEcran from '../../fondEcran.svg';
import './Accueil.css';

export default class Accueil extends React.Component {
	render() {
		return (
			<div className="contenu">
				<img className="fondEcran" src={fondEcran} alt="fondEcran" />
			</div>
		);
	}
}