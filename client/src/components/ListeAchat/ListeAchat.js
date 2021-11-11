import React from 'react';
import './ListeAchat.css';

import Button from '@mui/material/Button';
import { Box } from "@mui/system";
import { DataGrid } from '@mui/x-data-grid/index-cjs';

export default class ListeAchat extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            items: [],
            listeAchat: false
        }

        this.fetchBouteilles = this.fetchBouteilles.bind(this);
        this.creerListeAchat = this.creerListeAchat.bind(this);
        this.fetchListeAchat = this.fetchListeAchat.bind(this);
    }

    componentDidMount() {
        if (!this.props.estConnecte) {
            return this.props.history.push("/connexion");
        }
        /**
         * Pas 1
         *      Existe une liste d'achat pour l'usager ?
         *          SELECT a.id, b.item, c.nom, b.millesime, b.quantite
                    FROM vino__liste_achat a, vino__liste_achat_vino b, vino__bouteille c
                    WHERE a.id_usager= 3
                        and a.id = b.liste_achat_id
                        and b.bouteille_id = c.id
         *          si Oui, montrer la liste et demander si la liste a été achetée
         *              
         * 
         * Pas 2
         *      GET d'inventaire pour voir les quantites des vinos
         *          SELECT a.bouteille_id, c.nom, sum(a.quantite)
                    FROM vino__cellier_inventaire a, vino__bouteille c
                    WHERE a.usager_id = 3 this.props.id_usager
                        and a.bouteille_id = c.id
                    GROUP BY a.bouteille_id, c.nom
         *
         */
        this.fetchListeAchat();
        this.fetchBouteilles();
    }

    fetchListeAchat() {
        fetch('https://rmpdwebservices.ca/webservice/php/celliers/' + this.props.id_usager + '/bouteilles', {
            method: 'GET',
            headers: new Headers({
                'Content-Type': 'application/json',
                authorization: 'Basic ' + btoa('vino:vino')
            })
        })
            .then((reponse) => reponse.json())
            .then((donnees) => {
                this.setState({ items: donnees.data });
                this.setState({ listeAchat: true });
            });
    }

    fetchBouteilles() {
        //Ici on doit mettre le nouveau fetch pour avoir la liste de vinos de tous nos celliers avec la quantite, pour savoir sin on doit acheter
        fetch('https://rmpdwebservices.ca/webservice/php/celliers/' + this.props.id_usager, {
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
            { field: 'id', headerName: 'idVino', width: 120 },
            //{ field: 'emplacement', headerName: 'Cellier', width: 120 },
            { field: 'nom', headerName: 'Nom', width: 230 },
            //{ field: 'millesime', headerName: 'Millesime', width: 150 },
            //{ field: 'quantite', headerName: 'Quantite', width: 130 },

        ];

        console.log("columns: ", columns);

        return (
            <Box className="liste_achat_container" sx={{
                display: "flex", justfyContent: "center", alignItems: "center",
                width: "85vw", flexDirection: "column", borderRadius: "1rem",
                margin: "0 auto", marginTop: "20vh", color: "white",
            }} >

                <span>Liste d'achat</span>

                <div className="liste_achat_rows" style={{ height: 400, width: '100%' }}>
                    <DataGrid sx={{ color: "white !important", }} rows={this.state.items} columns={columns}
                        pageSize={5} rowsPerPageOptions={[5]} checkboxSelection
                    />
                </div>
                <Button className="button" type="button" onClick={(e) => this.creerListeAchat()}> Créer Liste </Button>
            </Box>
        );
    }
}