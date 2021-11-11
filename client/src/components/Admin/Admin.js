import React from "react";
import "./Admin.css";
import { DataGrid } from "@mui/x-data-grid/index-cjs";
import { Breadcrumbs, Link, Typography } from '@mui/material';

export default class Admin extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            usagers: []
        };
    }

    componentDidMount() {
        if (!this.props.estConnecte) {
            return this.props.history.push('/connexion');
        }
        this.getUsager()
    }

    getUsager() {
        const options = {
            method: 'GET',
            headers: {
                'Content-type': 'application/json',
                'authorization': 'Basic ' + btoa('vino:vino')
            }
        }

        fetch("https://rmpdwebservices.ca/webservice/php/usagers/", options)
            .then(reponse => reponse.json())
            .then((donnees) => {
                this.setState({
                    usagers: donnees.data
                })
            });
    }

    render() {
        const columns = [
            { field: 'prenom', headerName: 'Prénom', width: 80 },
            { field: 'nom', headerName: 'Nom', width: 80 },
            {
                field: 'courriel',
                headerName: 'Courriel',
                type: 'string',
                width: 150,
            }
        ];

        const users = this.state.usagers.map(user => {
            return {
                id: parseInt(user.id_usager),
                prenom: user.prenom,
                nom: user.nom,
                courriel: user.courriel
            }
        })

        return (
            <>
                <Breadcrumbs aria-label="breadcrumb" sx={{ display: 'flex', margin: '0 1.8rem', marginBottom: '1rem' }}>
                    <Link underline="hover" color="inherit" href="/">
                        Mon Cellier
                    </Link>

                    <Typography color="text.primary">Panneau admin</Typography>
                </Breadcrumbs>

                <span className="titre" >Liste des usagers</span>

                <div style={{
                    height: 500, width: '85vw',
                    margin: '0 auto',
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    borderRadius: '.5rem'
                }}>
                    <DataGrid style={{ color: 'white', border: 'none', margin: '1rem .5rem' }}
                        rows={users}
                        columns={columns}
                        pageSize={5}
                        rowsPerPageOptions={[5]}
                    />
                </div>
            </>
        );
    }
}