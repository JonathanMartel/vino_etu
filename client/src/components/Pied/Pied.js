import React from "react";
import './Pied.css';
import BottomNavigation from '@mui/material/BottomNavigation';
import BottomNavigationAction from '@mui/material/BottomNavigationAction';
import FormatListBulletedIcon from '@mui/icons-material/FormatListBulleted';
import PersonIcon from '@mui/icons-material/Person';
import WineBarIcon from '@mui/icons-material/WineBar';
import AddCircleOutlineOutlinedIcon from '@mui/icons-material/AddCircleOutlineOutlined';
import LoginIcon from '@mui/icons-material/Login';
import PersonAddIcon from '@mui/icons-material/PersonAdd';

export default class Pied extends React.Component {
	constructor(props) {
		super(props);

		console.log(document.title)
	}

	render() {
		if (document.title == 'Se connecter') {
			return (
				<BottomNavigation showLabels sx={{ width: '100vw', position: 'fixed', bottom: 0, left: 0, right: 0, zIndex: 1, backgroundColor: '#641B30' }}>
					<BottomNavigationAction
						label="Se connecter"
						value="favorites"
						icon={<LoginIcon />}
					/>

					<BottomNavigationAction
						label="S'enregistrer"
						value="folder"
						icon={<PersonAddIcon />} />
				</BottomNavigation>
			);
		} else {
			return (
				<BottomNavigation showLabels sx={{ width: '100vw', position: 'fixed', bottom: 0, left: 0, right: 0, zIndex: 1, backgroundColor: '#641B30' }}>
					<BottomNavigationAction
						label="Celliers"
						value="recents"
						icon={<FormatListBulletedIcon />}
					/>

					<AddCircleOutlineOutlinedIcon sx={{ transform: 'translateX(550%)', width: 15, color: 'white' }} />
					<BottomNavigationAction
						label="Bouteille"
						value="favorites"
						icon={<WineBarIcon />}
					/>

					<BottomNavigationAction
						label="Mon compte"
						value="folder"
						icon={<PersonIcon />} />
				</BottomNavigation>
			);
		}
	}
}