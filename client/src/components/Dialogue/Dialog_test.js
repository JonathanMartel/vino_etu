import React from 'react';

import Button from '@mui/material/Button';
import TextField from '@mui/material/TextField';
import Dialog from '@mui/material/Dialog';
import DialogActions from '@mui/material/DialogActions';
import DialogContent from '@mui/material/DialogContent';
import DialogContentText from '@mui/material/DialogContentText';
import DialogTitle from '@mui/material/DialogTitle';

export default class Dialogue extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			open: false,
			value: undefined
		}

		this.handleClose = this.handleClose.bind(this);
	}

	componentDidUpdate(previousProps, previousState) {
		if (this.state.open && !this.props.open) {
			this.setState({ open: false });
		} else if (!this.state.open && !previousState.open) {
			this.setState({ open: true })
		}
	}

	handleClose() {
		console.log(this.state.value)
		this.setState({ open: false });
	}

	render() {
		return (
			<div>
				<Button variant="outlined" onClick={this.handleClickOpen}>
					Open form dialog
				</Button>
				<Dialog open={this.state.open} onClose={this.handleClose}>
					<DialogTitle>Subscribe</DialogTitle>
					<DialogContent>
						<DialogContentText>
							To subscribe to this website, please enter your email address here. We
							will send updates occasionally.
						</DialogContentText>
						<TextField
							autoFocus
							margin="dense"
							id="name"
							label="Email Address"
							type="email"
							fullWidth
							variant="standard"
							onChange={(e) => this.setState({value : e.target.value })}
						/>
					</DialogContent>
					<DialogActions>
						<Button onClick={this.handleClose}>Cancel</Button>
						<Button onClick={this.handleClose}>Subscribe</Button>
					</DialogActions>
				</Dialog>
			</div>
		);
	}
};
