import { Breadcrumbs, Link, Typography } from '@mui/material';
import React from 'react';
import Cellier from "../Cellier/Cellier";
import './ListeCellier.css'
import AddCircleIcon from '@mui/icons-material/AddCircle';
import { Box } from '@mui/system';
/* import ListeBouteilleCellier from '../ListeBouteillesCellier/ListeBouteilleCellier'; */

export default class ListeCellier extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			celliers: [],
			id_usager: 0,
			items: []
		}

		this.fetchCelliers = this.fetchCelliers.bind(this);
	}

	cliquer() {
		console.log("cliquer: ", this);
		//this.props.history.push("/ListeBouteilleCellier");
	}

	fetchCelliers() {

		console.log('this.props.match.params.id : ', this.props.match.params.id);
		//Pour quoi ne fonctionne pas ???
		/* this.setState({id_usager: this.props.match.params.id});
		console.log('id_usager : ', this.state.id_usager); */

		const donnes = {
			usager_id: null
		}

		const getMethod = {
			method: 'GET',
			headers: {
				'Content-type': 'application/json',
				'authorization': 'Basic ' + btoa('vino:vino')
			}
			//, body: JSON.stringify(donnes) 
		}

		console.log("this.state.id_usager: ", this.state.id_usager);
		fetch("https://rmpdwebservices.ca/webservice/php/celliers/usager/" + this.props.match.params.id, getMethod)
			.then(reponse => reponse.json())
			.then((donnees) => {
				this.setState({ items: donnees.data })
				console.log("Celliers: ", this.state.items)
			});
	}

	componentDidMount() {
		this.fetchCelliers();
	}

	render() {
		{/* <Cellier info={item} onClick={this.cliquer.bind(item)} key={index} /> */ }
		console.log('this.props : ', this.props);

		const celliers = this.state.items
			.map((item, index) => {
				return (
					<Cellier info={item} onClick={this.cliquer.bind(item)} key={index} />
				);
			})

		console.log("Celliers del render: ", celliers);

		return (
			<Box>
				<Breadcrumbs aria-label="breadcrumb" sx={{ display: 'flex', margin: '0 1.5rem' }}>
					<Link underline="hover" color="inherit" href="/">
						Celliers
					</Link>
					<Typography color="text.primary">Liste des celliers</Typography>

				</Breadcrumbs>
				<AddCircleIcon sx={{ color: '#641B30' }}/>

				<section className="liste_celliers">
					{celliers}
				</section>
			</Box>
		);
	}
}
