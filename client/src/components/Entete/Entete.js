import React from 'react';
// import { Link, NavLink } from 'react-router-dom';
import './Entete.css';
import menu from '../../Menu.png';
import logo from '../../logo.png';
import AppBar from '@mui/material/AppBar';
import Box from '@mui/material/Box';
import Toolbar from '@mui/material/Toolbar';
import { border, color } from '@mui/system';
import zIndex from '@mui/material/styles/zIndex';
// import { sizing } from '@mui/system';

/* Variables de styles */
const appBarStyles = {
	backgroundColor: 'rgba(0, 0, 0, .8)',
	position: 'relative',
}

const toolBarStyles = {
	display: 'flex',
	justifyContent: 'space-between',
	height: 100

}


export default class Entete extends React.Component {
	constructor(props) {
		super(props);
	}

	render() {

		return (
			<Box>
				<AppBar sx={appBarStyles}>
					<Toolbar sx={toolBarStyles}>
						<img className="logo" src={logo} alt="Logo" />
						<img className="menu" src={menu} alt="Menu" />
					</Toolbar>
				</AppBar>
			</Box>
		);
	}
}