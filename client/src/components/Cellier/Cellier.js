import React from "react";
import { Link } from 'react-router-dom';

import './Cellier.css';

export default class Cellier extends React.Component {
	constructor(props){
	  super(props);
	
	}

	render() {
		
		return(
			<Link to={"/cellier/" + this.props.info.id}>
				<div>
					<p>{this.props.info.emplacement}</p>
				</div>
			</Link>
		);
	}
}