import React from 'react';
import {Link} from 'react-router-dom';

import './BouteilleCellier.css';

export default class BouteilleCellier extends React.Component {
	constructor(props) {
		super(props);
		this.state = { 
			imgSaq: this.props.info.url_img
		 }
	}
	
	render() { 
		<Link to={"/bouteilles/" + this.props.info.id} />
		return ( 
				<article className="uneBouteille">
					<img src={this.state.imgSaq} />
					<p>Nom : {this.props.info.nom}</p>
					<p>Pays : {this.props.info.pays}</p>
					<p>Millesime : {this.props.info.millesime}</p>
					<p>Quantite : {this.props.info.quantite}</p>
					{/* <p>{this.props.info.vino__type_id}</p>*/}
					{/* <a href={this.props.info.url_saq} >Voir sur le site de la SAQ</a> */}
					
					<Link to={"/bouteilles/" + this.props.info.id}>
						<button>Modifier</button>
					</Link>
				</article>
			
		 );
	}
}