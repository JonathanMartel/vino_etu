import React from 'react';

import './Modal.css';

export default class Modal extends React.Component {
	constructor(props) {
		super(props);
		
	}
	

	render() {
		
		const Modal = ({fermer, voir, enfant}) => {
			const choisirClasse = voir ? "modal display-block" : "modal display-none";
		
		return (
			 <div className={choisirClasse}>
				 <div className="modal-bloc">
					 {enfant}
					 <button onClick={fermer}>Fermer</button>
				 </div>
			 </div>
		);
		};
	}
	
}
