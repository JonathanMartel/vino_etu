import React from "react";

import './BouteilleSAQ.css';

export default class BouteilleSAQ extends React.Component {
	constructor(props){
	  super(props);
	}

	render() {
		return (
			<li>{this.props.info.nom}{this.props.info.table === "Cellier" ? `(this.props.info.quantite)`: ''}</li>
		)
	}
}