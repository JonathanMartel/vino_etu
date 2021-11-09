import React from 'react';
import './ListeAchat.css';
import { DataGrid } from '@mui/x-data-grid';
import Button from '@mui/material/Button';
import { Box } from "@mui/system";

export default class ListeAchat extends React.Component {
    constructor(props) {
		super(props);
		
        this.state = {
            items: []
        }

		this.fetchBouteilles = this.fetchBouteilles.bind(this);
		this.creerListeAchat = this.creerListeAchat.bind(this);
        
	}

    componentDidMount() {
		if (!this.props.estConnecte) {
			return this.props.history.push("/connexion");
        }
        this.fetchBouteilles();
    }

    fetchBouteilles() {
        //Ici on doit mettre le nouveau fetch pour avoir la liste de vinos de tous nos celliers avec la quantite, pour savoir sin on doit acheter
		fetch('https://rmpdwebservices.ca/webservice/php/celliers/3' , {
			method: 'GET',
			headers: new Headers({
				'Content-Type': 'application/json',
				authorization: 'Basic ' + btoa('vino:vino')
			})
		})
			.then((reponse) => reponse.json())
			.then((donnees) => {
				this.setState({ items: donnees.data });
			});
	}

    creerListeAchat() {
        console.log("Créer liste d'achat");
    }

    render() {
        console.log("items: ", this.state.items);
       
        const columns = [
            { field: 'emplacement', headerName: 'Cellier', width: 120 },
            { field: 'nom', headerName: 'Nom', width: 230 },
            { field: 'millesime', headerName: 'Millesime', width: 150 },
            { field: 'quantite', headerName: 'Quantite', width: 130 },
            
        ];
            
        return (
            <Box className="liste_achat_container" sx={{ 
                display: "flex", justfyContent: "center", alignItems: "center",
                width: "85vw", flexDirection: "column", borderRadius: "1rem",
                margin: "0 auto", marginTop: "20vh", color: "white", }} >

                <span>Liste d'achat</span>

                <div className="liste_achat_rows"  style={{ height: 400, width: '100%' }}>
                    <DataGrid sx={{ color: "white", }} rows={this.state.items} columns={columns}
                        pageSize={5} rowsPerPageOptions={[5]} checkboxSelection
                    />
                </div>
                <Button className="button" type="button" onClick={(e) => this.creerListeAchat()}> Créer Liste </Button>
            </Box>
        );
    }
}