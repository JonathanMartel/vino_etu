import React from 'react';
import './DetailsBouteille.css';

export default class DetailsBouteille extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			items :[]
		}
		
		/* console.log(this.props); */
		this.montreBouteille = this.montreBouteille.bind(this);
	}

	montreBouteille() { 
		
		const getMethod = {
			method: 'GET', 
			headers: {
				'Content-type': 'application/json',
				'authorization': 'Basic ' + btoa('vino:vino')
			}
			//, body: JSON.stringify(donnes) 
		}

		fetch("https://rmpdwebservices.ca/webservice/php/bouteilles/" + this.props.param.match.params.id, getMethod)
			.then(reponse => reponse.json())
        	.then((donnees)=>{
				this.setState({items: donnees.data})
				console.log("Bouteilles ", donnees.data )
				/* console.log("Bouteilles ", this.state.items ) */
        });
	}

	modifier() {
		console.log("Click en modifier !!!");
	}

	componentDidMount(){
		this.montreBouteille();
	}


	render() {

		const bouteille = this.state.items
							.map((item, index)=>{
								return (
									<article key={index}>
										<div> 
											<p>Nom : </p>
											<input type="text" value={item.nom}  />
											
											<p>Description : </p>
											<input type="text"  value={item.description}  />
											
											<p>Pays : {item.pays}</p>
											<input type="text"  value={item.pays}  />
											
											<p>Millesime : {item.millesime}</p>
											<input type="text" value={item.millesime}  />
											
											<p>Type : {item.type}</p>
											<input type="text" value={item.type}  />
										</div>
										<br/>
										<div>
											<button type="button" onClick={(e) => this.modifier(item)}>Modifier</button>
										</div>
									</article>
								);
							})

		return (
			<section>
				{/* <p>Je suis au DetailsBouteille : { this.props.param.match.params.id } </p> */}

				{bouteille}

			</section>
		)
	}
};

