import React from "react";


import './BouteilleSAQ.css';
import { Link } from "react-router-dom";

export default class BouteilleSAQ extends React.Component {
	constructor(props){
	  super(props);
	}

	render() {
		return (
			<li className="une-bouteille-saq" onClick={() => this.props.choixBouteille(this.props.info)}>{this.props.info.nom}{this.props.info.table === "cellier" ? ` (${this.props.info.quantite})`: ''}</li>
		)
	}
}