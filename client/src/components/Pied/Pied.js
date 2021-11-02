import React from "react";
import rmpd from '../../rmpd.png';
import './Pied.css';
import { BottomNavigation, BottomNavigationAction, IconButton } from '@mui/material';
import FolderIcon from '@mui/icons-material/Folder';
import RestoreIcon from '@mui/icons-material/Restore';
import FavoriteIcon from '@mui/icons-material/Favorite';
import LocationOnIcon from '@mui/icons-material/LocationOn';
import HomeIcon from '@mui/icons-material/Home';
import FormatListBulletedIcon from '@mui/icons-material/FormatListBulleted';
import PersonIcon from '@mui/icons-material/Person';
import WineBarIcon from '@mui/icons-material/WineBar';
import AddCircleOutlineOutlinedIcon from '@mui/icons-material/AddCircleOutlineOutlined';

export default class Pied extends React.Component {
	constructor(props) {
		super(props);
	}

	render() {
		return (
			<BottomNavigation sx={{ width: '100vw', position: 'fixed', bottom: 0, left: 0, right: 0, zIndex: 1, backgroundColor: '#641B30' }}>
				<BottomNavigationAction
					showLabel
					label="Celliers"
					value="recents"
					icon={<FormatListBulletedIcon />}
				/>

				<AddCircleOutlineOutlinedIcon sx={{ transform: 'translateX(550%)', width: 15, color: 'white' }} />
				<BottomNavigationAction
					showLabel
					label="Bouteille"
					value="favorites"
					icon={<WineBarIcon />}
				/>

				<BottomNavigationAction
					showLabel
					label="Mon compte"
					value="folder"
					icon={<PersonIcon />} />
			</BottomNavigation>
		);
	}
}