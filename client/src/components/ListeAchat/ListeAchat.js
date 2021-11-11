import React, { useState } from 'react';
import './ListeAchat.css';
import { DataGrid } from '@mui/x-data-grid';  //import { DataGrid } from '@mui/x-data-grid/index-cjs';
import Button from '@mui/material/Button';
import { Box } from "@mui/system";
import { DataGrid } from '@mui/x-data-grid/index-cjs';

export default class ListeAchat extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      items: [],
      itemsSelected: [],
      bouteilles: [],
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

    this.fetchListeAchat();
    if (!this.state.listeAchat) {
      this.fetchBouteilles();
    }
    //this.fetchBouteilles();
  }

  componentDidUpdate() {
    console.log("kkk", this.state.itemsSelected);
  }


  fetchListeAchat() {
    fetch('https://rmpdwebservices.ca/webservice/php/listeachat/usager/' + this.props.id_usager, {
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
      });
  }

  creerListeAchat() {
    console.log("Créer liste d'achat");
    console.log("Colonnes séléctionnées: ", this.state.itemsSelected);


    //recorrer la lista para llebar millesime y la cantidad
    /*for (let i = 0; i < this.state.itemsSelected.length; i++) {
      console.log('Item: ', this.state.itemsSelected[i]);
    }*/
    /*
    bouteilles = this.state.itemsSelected
                            .map((item, index) => {
                                if (this.state.itemsSelected[index] == this.state.items[]) {
                                  
                                }
                            })
    */
    /*
    let donnes = {
        id_usager: this.props.id_usager,
        bouteilles: this.state.itemsSelected
    };
    console.log("Donnes: ", donnes);

    const postMethod = {
        method: 'POST',
        headers: {
            'Content-type': 'application/json',
            authorization: 'Basic ' + btoa('vino:vino')
        },
        body: JSON.stringify(donnes)
    };

    fetch('https://rmpdwebservices.ca/webservice/php/listeachat/', postMethod)
        .then((reponse) => reponse.json())
        .then((donnees) => {
            if (donnees.data) return this.props.history.push("/listeachat");
        });
    */


  }

  render() {
    console.log("items: ", this.state.items);

    const colonnes = [
      //{ field: 'bouteille_id', headerName: 'ID', width: 90, type: 'number' },
      { field: 'nom', headerName: 'Nom', width: 230 },
      { field: 'millesime', headerName: 'Millesime', width: 150 },
      { field: 'quantite', headerName: 'Quantite Inventaire', width: 130, type: 'number' },
      { field: '0', headerName: 'Quantite Achat', width: 130, editable: true, type: 'number' },
    ];

    return (
      <Box className="liste_achat_container" sx={{
        display: "flex", justfyContent: "center", alignItems: "center",
        width: "85vw", flexDirection: "column", borderRadius: "1rem",
        margin: "0 auto", marginTop: "20vh", color: "white",
      }} >

        <span>Liste d'achat</span>
        <div className="liste_achat_rows" style={{ height: 400, width: '100%' }}>
          <DataGrid sx={{ color: "white !important", }} rows={this.state.items} columns={colonnes}
            pageSize={5} rowsPerPageOptions={[5]} checkboxSelection disableSelectionOnClick
            onSelectionModelChange={itm => this.setState({ itemsSelected: itm })}
          //onSelectionModelChange={itm => console.log(this.state.items.bouteille_id)}
          />
        </div>

        {/* 
                <div className="liste_achat_rows"  style={{ height: 400, width: '100%' }}>
                    <DataGrid sx={{ color: "white !important", }} rows={this.state.itemsSelected} columns={colonnes}
                        pageSize={5} rowsPerPageOptions={[5]} checkboxSelection disableSelectionOnClick 
                    />
                </div>
              */}

        <label for="scales">mmmm</label>
        <input type="checkbox" />
        <Button className="button" type="button" onClick={(e) => this.creerListeAchat()}> Créer Liste </Button>
      </Box>
    );
  }
}