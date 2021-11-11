import React from "react";
import { Link } from 'react-router-dom';
import CreateOutlinedIcon from '@mui/icons-material/CreateOutlined';
import InventoryIcon from '@mui/icons-material/Inventory';
import ArrowCircleDownIcon from '@mui/icons-material/ArrowCircleDown';
import ThermostatIcon from '@mui/icons-material/Thermostat';
import './Cellier.css';
import { Box } from "@mui/system";

export default class Cellier extends React.Component {

	componentDidMount() {
		if (!this.props.estConnecte) {
			return this.props.history.push("/connexion");
		}
	}

	render() {
		return (
			<Link to={"/cellier/" + this.props.info.id_cellier} className="cellier_container_parent">
				<Box className="cellier_container">
						<Box sx={{ fontSize: '1.5em', display: 'flex', justifyContent: 'space-between', width: '100%', height: 50, alignItems: 'center' }}>
							{this.props.info.emplacement}
							<Link to={"/cellier/modifier/" + this.props.info.id_cellier} {...this.props} >
								 <CreateOutlinedIcon  sx={{ color: '#B2365A', fontSize: '2rem'}} />
							</Link>
							<ArrowCircleDownIcon sx={{ color: '#B2365A', transform: 'rotate(-90deg)', fontSize: '2rem'}} />
						</Box>

					<Box className="cellier_item">
						<Box sx={{ fontSize: '1.5em', display: 'flex', width: '100%', alignItems: 'center', gap: '.5rem' }}>
							<InventoryIcon sx={{ color: 'lightblue' }}/> <span className="spantest">{this.props.info.quantite}</span> 
							<ThermostatIcon sx={{ color: 'lightblue' }} /> <span className="spantest">{this.props.info.temperature} °C</span>
						</Box>
					</Box>
				</Box>
			</Link >
		);
	}
}