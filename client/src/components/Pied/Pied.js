import React from "react";

import './Pied.css';

export default class Accueil extends React.Component {
	constructor(props) {
		super(props);
	}

	render() {
		return (
			<footer>
				<p>
					Réalisé par l'équipe formée de Diana Quiroz, Mathieu Rioux, Robert Gaina et Pascal Beausoleil.
				</p>
			</footer>
		);
	}
}