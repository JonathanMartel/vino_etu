import React from 'react';
import Cellier from "../Cellier/Cellier";

export default class AjoutCellier extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			celliers: []
		}

		this.fetchCelliers = this.fetchCelliers.bind(this);
	}

	fetchCelliers(){
		fetch("http://rmpdwebservices.ca/webservice/php/celliers/usager/")// Il faut ajouter le id de l'usager dans le fetch
		.then(reponse => reponse.json())
        .then((donnees)=>{
			this.setState({celliers: donnees.data})
        });
	}

	componentDidMount(){
		this.fetchCelliers();
	}

	render() {
		const celliers = this.state.celliers
							.map((cellier, index)=>{
								return (
									<Cellier info={cellier} onClick={this.cliquer.bind(cellier)} key={index} />
								);
							})
		return (
			<div>
				<h2>Liste de vos celliers</h2>
				<h3>Veuillez cliquer sur le cellier que vous voulez consulter</h3>
			</div>
			<div className="liste_celliers">
				{celliers}
			</div>
		)
	}
