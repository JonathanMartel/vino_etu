import React from 'react';
import './Entete.css';
import menu from '../../Menu.png';
import logo from '../../logo.png';
import AppBar from '@mui/material/AppBar';
import Box from '@mui/material/Box';
import Toolbar from '@mui/material/Toolbar';

/* Variables de styles */
const appBarStyles = {
	backgroundColor: 'rgba(0, 0, 0, .8)',
	position: 'relative'
};

const toolBarStyles = {
	display: 'flex',
	justifyContent: 'space-between',
	height: 75
};

export default class Entete extends React.Component {
	render() {
		// return (
		// 	<Box>
		// 		<AppBar sx={appBarStyles}>
		// 			<Toolbar sx={toolBarStyles}>
		// 				<img className="logo" src={logo} alt="Logo" />
		// 				<img className="menu" src={menu} alt="Menu" />
		// 			</Toolbar>
		// 		</AppBar>
		// 	</Box>
		// );

		return (
			<Box sx={{ paddingBottom: '2rem' }}>
				<AppBar sx={appBarStyles}>
					<Toolbar sx={toolBarStyles}>
						<img className="logo" src={logo} alt="Logo" />
					</Toolbar>
				</AppBar>
			</Box>
		);
	}
}
