import React from "react";
import { Link } from 'react-router-dom';

import './Cellier.css';

export default class Cellier extends React.Component {
	constructor(props){
	  super(props);
	
	}

	render() {
		
		return(
			<Link to={"/cellier/" + this.props.info.id_cellier}> {/* ListeBouteilleCellier */}
				<div>
					<p>Emplacement : {this.props.info.emplacement}</p>
				</div>
			</Link>
		);
	}
}