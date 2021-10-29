import React from "react";
import rmpd from '../../rmpd.png';
import './Pied.css';

export default class Pied extends React.Component {
	constructor(props) {
		super(props);
	}

	render() {
		return (
			<footer>
				<img className="rmpd" src={rmpd} alt="rmpd" />
			</footer>
		);
	}
}