import React from 'react';
import Cellier from "../Cellier/Cellier";

export default class ListeCellier extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			celliers: [],
			id_usager: 0,
			items :[]
		}

		this.fetchCelliers = this.fetchCelliers.bind(this);
	}

	fetchCelliers(){
		console.log('id_usager : ', this.props.id_usager);

		const donnes = {
			usager_id : null
		}

		const getMethod = {
			method: 'GET', 
			headers: {
				'Content-type': 'application/json',
				'authorization': 'Basic ' + btoa('vino:vino')
			}
		}

		fetch("https://rmpdwebservices.ca/webservice/php/celliers/usager/" + this.props.id_usager, getMethod)
			.then(reponse => reponse.json())
        	.then((donnees)=>{
				this.setState({items: donnees.data})
				console.log("Celliers: ", this.state.items )
        });
	}

	componentDidMount() {
		this.fetchCelliers();
	}

	render() {
		if (this.props.esConnecte && this.props.id_usager > 0) { //usager connecté

			const celliers = this.state.items
								.map((item, index)=>{
									return (
										<Cellier info={item} key={index} />
									);
								})
			
			return (
				<section>
					<div>
						<h2>Liste de vos celliers</h2>
						<h3>Veuillez cliquer sur le cellier que vous voulez consulter</h3>
					</div>
					
					<section className="liste_celliers">
						{celliers}
					</section>
				</section>
			);
		} else {	//usager non connecté
			return (
				<div>
					{this.props.history.push("/")}
				</div>
			);
		} 
	}
}
