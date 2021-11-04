import { Breadcrumbs, Link, Typography } from '@mui/material';
import React from 'react';
import Cellier from "../Cellier/Cellier";
import './ListeCellier.css'
import AddCircleIcon from '@mui/icons-material/AddCircle';
import { Box } from '@mui/system';

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

	componentDidMount() {
		if (!this.props.estConnecte) {
			return this.props.history.push("/");
		}
		this.fetchCelliers();
	}

	fetchCelliers(){
		console.log('id_usager : ', this.props.id_usager);

		const donnes = {
			usager_id: null
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
			.then((donnees) => {
				this.setState({ items: donnees.data })
				console.log("Celliers: ", this.state.items)
			});
	}
	
	render() {
		const celliers = this.state.items
							.map((item, index)=>{
								return (
									<Cellier info={item} key={index} />
								);
							})
		
		return (
			<Box>
				<Breadcrumbs aria-label="breadcrumb" sx={{ display: 'flex', margin: '0 1.5rem' }}>
					<Link underline="hover" color="inherit" href="/">
						Celliers
					</Link>
					<Typography color="text.primary">Liste des celliers</Typography>

				</Breadcrumbs>
				<AddCircleIcon onClick={()=> this.props.history.push("/NouvelleCellier")} sx={{ color: '#641B30' }}/>

				<section className="liste_celliers">
					{celliers}
				</section>
			</Box>
		);
	}
}
