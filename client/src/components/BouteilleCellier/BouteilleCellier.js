import React from 'react';
import {Link} from 'react-router-dom';

import './BouteilleCellier.css';

export default class BouteilleCellier extends React.Component {
	constructor(props) {
		super(props);
		this.state = {  }
	}
	
	render() { 
		
		return ( 
				<article className="uneBouteille">
					<img src={this.props.bouteille.url_image} />
					<p>{this.props.bouteille.nom}</p>
					<p>{this.props.bouteille.pays}</p>
					<p>{this.props.bouteille.vino__type_id}</p>
					<p>{this.props.bouteille.millesime}</p>
					<a href={this.props.bouteille.url_saq}>Voir sur le site de la SAQ</a>
					<Link to={"/bouteilles/"+this.props.info.id}>
						<button>Modifier</button>
					</Link>
				</article>
			
		 );
	}
}