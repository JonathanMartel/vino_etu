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
import { Menu, MenuItem } from "@mui/material";
import LogoutIcon from '@mui/icons-material/Logout';
import AccountCircleIcon from '@mui/icons-material/AccountCircle';
import PlaylistAddIcon from '@mui/icons-material/PlaylistAdd';
import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';
import { Box } from "@mui/system";
import AddShoppingCartOutlinedIcon from '@mui/icons-material/AddShoppingCartOutlined';

export default class Pied extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			isAccMenuOpen: false,
			anchorElAccMenu: null,
			isCelliersMenuOpen: false,
			anchorElCelliersMenu: null
		}

		this.openAccMenu = this.openAccMenu.bind(this);
		this.closeAccMenu = this.closeAccMenu.bind(this);
		this.openCelliersMenu = this.openCelliersMenu.bind(this);
		this.closeCelliersMenu = this.closeCelliersMenu.bind(this);
	}

	openAccMenu(e) {
		this.setState({ isAccMenuOpen: true, anchorElAccMenu: e.currentTarget });
	}

	closeAccMenu() {
		this.setState({ isAccMenuOpen: false });
	}

	openCelliersMenu(e) {
		this.setState({ isCelliersMenuOpen: true, anchorElCelliersMenu: e.currentTarget });
	}

	closeCelliersMenu() {
		this.setState({ isCelliersMenuOpen: false })
	}

	render() {
		console.log("Est connecté: ", this.props.estConnecte);
		console.log("Usager: ", this.props.id_usager);

		if (!this.props.estConnecte) {
			return (
				<BottomNavigation showLabels sx={{ width: '100vw', position: 'fixed', bottom: 0, left: 0, right: 0, zIndex: 1, marginBottom: 20, backgroundColor: '#641B30' }}>
					<BottomNavigationAction
						label="Se connecter"
						value="favorites"
						icon={<LoginIcon />}
						onClick={() => this.props.history.push("/")}
					/>

					<BottomNavigationAction
						label="S'enregistrer"
						value="folder"
						icon={<PersonAddIcon />}
						onClick={() => this.props.history.push("/inscription")} />
				</BottomNavigation>
			);
		} else {
			return (
      <>
				<BottomNavigation showLabels sx={{ width: '100vw', position: 'fixed', bottom: 0, left: 0, right: 0, zIndex: 1, backgroundColor: '#641B30' }}>
					<BottomNavigationAction
						label="Celliers"
						value="recents"
						icon={<FormatListBulletedIcon />}
						onClick={(e) => this.openCelliersMenu(e)}
					/>

					<AddCircleOutlineOutlinedIcon sx={{ transform: 'translateX(550%)', width: 15, color: 'white' }} />
					<BottomNavigationAction
						label="Nouvelle bouteille"
						value="favorites"
						icon={<WineBarIcon />}
						onClick={() => this.props.history.push("/bouteille/ajout")}
					/>

					<BottomNavigationAction
						label="Mon compte"
						value="folder"
						icon={<PersonIcon />}
						onClick={(e) => this.openAccMenu(e)}
					/>

					<Menu
						open={this.state.isCelliersMenuOpen}
						anchorEl={this.state.anchorElCelliersMenu}
						onClose={() => this.closeCelliersMenu()}
						PaperProps={{
							style: {
								transform: 'translateY(-40%)',
							}
						}}
						anchorOrigin={{
							vertical: 'top',
							horizontal: 'center',
						}}
						transformOrigin={{
							vertical: 'top',
							horizontal: 'center',
						}}
					>

						<MenuItem onClick={() => this.props.history.push("/celliers/liste")} sx={{ display: 'flex', gap: '.5rem' }}>
							<FormatListNumberedIcon onClick={() => this.props.history.push("/celliers/liste")} /> Liste des celliers
						</MenuItem>

						<MenuItem onClick={() => this.props.history.push("/celliers/ajouter")} sx={{ display: 'flex', gap: '.5rem' }}>
							<PlaylistAddIcon onClick={() => this.props.history.push("/celliers/ajouter")} /> Ajouter un cellier
						</MenuItem>
					</Menu>

					<Menu
						open={this.state.isAccMenuOpen}
						anchorEl={this.state.anchorElAccMenu}
						onClose={() => this.closeAccMenu()}
						PaperProps={{
							style: {
								transform: 'translateY(-40%)',
							}
						}}
						anchorOrigin={{
							vertical: 'top',
							horizontal: 'center',
						}}
						transformOrigin={{
							vertical: 'top',
							horizontal: 'center',
						}}
					>

						<MenuItem onClick={() => this.props.history.push("/compte/modifier")} sx={{ display: 'flex', gap: '.5rem' }}>
							<AccountCircleIcon onClick={() => this.props.history.push("/compte/modifier")} /> Mon profil
						</MenuItem>
						
						<MenuItem onClick={() => this.props.history.push("/listeachat")} sx={{ display: 'flex', gap: '.5rem' }}>
							<AddShoppingCartOutlinedIcon onClick={() => this.props.history.push("/listeachat")} /> Liste d'achat
						</MenuItem>
						
						<MenuItem onClick={() => this.props.logout()} sx={{ display: 'flex', gap: '.5rem' }}>
							<LogoutIcon onClick={() => this.props.logout()} /> Se déconnecter
						</MenuItem>
					</Menu>
				</BottomNavigation>
        <Box sx={{ width: '100vw', position: 'fixed', bottom: 0, left: 0, right: 0, zIndex: 1, height: '21px', backgroundColor: '#641B30' }}>
				</Box>
      </>
			);
		}
	}
}