import { textAlign } from '@mui/system';
import React from 'react';
import { Link } from 'react-router-dom';
import saqLogo from '../../SAQ_Logo.svg';
import listePays from '../../pays.json';
import './BouteilleCellier.css';
import vinBlanc from '../../vin_blanc.png';
import vinRouge from '../../vin_rouge.png';

export default class BouteilleCellier extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			imgSaq: this.props.info.url_img,
			drapeau: ''
		};

		this.drapeauPays = this.drapeauPays.bind(this);
	}
	componentDidMount() {
		this.drapeauPays();
	}

	drapeauPays() {
		const drapeauPays = listePays
			.filter((data) => {
				if (this.props.info.pays == null) return data;
				else if (data.name.toLowerCase().includes(this.props.info.pays.toLowerCase())) {
					return data;
				}
			})
			.map((data) => {
				let drap = 'https://flagcdn.com/' + data.alpha2 + '.svg';
				this.setState({ drapeau: drap });
			});
	}

	render() {
		//<Link to={'/bouteilles/' + this.props.info.id} />;

		return (
			<div className="bouteille_container">
				<div className="titre">{this.props.info.nom}</div>
				<div className="content_container">
					<div className="content">
						<div className="bouteille_img_container">
							<img className="bouteille_img" src={this.state.imgSaq} />
							<img src={this.props.info.vino__type_id === '1' ? vinRouge : vinBlanc} />
						</div>
						{this.props.info.url_saq ? (
							<a href={this.props.info.url_saq}>
								<p className="url_saq">SAQ</p>
							</a>
						) : null}
					</div>
					<div className="bouteille_description">
						<img className="bouteille_drapeau" src={this.state.drapeau} width="30" />
						<p>{this.props.info.millesime}</p>
						<p>Quantité : {this.props.info.quantite}</p>
					</div>
					<div className="bouteille_boutons_container">
						<button className="bouteille_boutons" onClick={() => this.props.ajouterAction(this.props.info)}>
							Ajouter
						</button>
						<button className="bouteille_boutons" onClick={() => this.props.retirerAction(this.props.info)}>
							Boire
						</button>
						<Link to={'/cellier/bouteilles/' + this.props.info.id}>
							<button className="bouteille_boutons bouton_modifier">Modifier</button>
						</Link>
					</div>
				</div>
			</div>
		);
	}
}
