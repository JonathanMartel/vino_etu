import React, { useState } from 'react';
import './ListeAchat.css';
import { DataGrid } from '@mui/x-data-grid';  //import { DataGrid } from '@mui/x-data-grid/index-cjs';
import Button from '@mui/material/Button';
import { Box } from "@mui/system";
import { TextField } from "@mui/material";
//import { DataGrid } from '@mui/x-data-grid/index-cjs';

export default class ListeAchat extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      items: [],
      itemsSelected: [],
      bouteilles: []['id', 'millesime', 'quantite'],
      listeAchat: false,
      titre: "",
      idListeAchat: undefined
    }

    this.fetchBouteilles = this.fetchBouteilles.bind(this);
    this.creerListeAchat = this.creerListeAchat.bind(this);
    this.fetchListeAchat = this.fetchListeAchat.bind(this);
    this.effacerListe = this.effacerListe.bind(this);
  }

  componentDidMount() {
    if (!this.props.estConnecte) {
      return this.props.history.push("/connexion");
    }
    
    this.fetchListeAchat();
    console.log('this.state.listeAchat: ', this.state.listeAchat);
    
    if (!this.state.listeAchat) {
      this.fetchBouteilles();
      this.setState({titre: "Inventaire des bouteilles"});
    } else {
      this.setState({titre: "Liste d'achat"});
    }
    
  }

  componentDidUpdate() {
    console.log("kkk", this.state.itemsSelected);
    
    this.state.itemsSelected
            .map((item) => {

                this.state.items.map(x => {
                    if (x.id === item) {
                        console.log("x: ", x);
                        this.setState({bouteilles: [[x.id, x.millesime, x.quantite]]});
                        //console.log("this.state.bouteilles: ", this.state.bouteilles);

                        //CODE ICI POUR PRÉPARER À SEND LE FETCH
                        // var item est égale à l'object de la bouteille sélectionnée avec toutes ses infos.
                    }
                });
            })
    
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
        //console.log("Éxiste listeAchat ? : ", this.state.listeAchat);
      });
    
      console.log('this.state.items: ', this.state.items);
      console.log("Éxiste listeAchat ? : ", this.state.listeAchat);

      
  }

  fetchBouteilles() {
    //Ici on doit mettre le nouveau fetch pour avoir la liste de vinos de tous nos celliers avec la quantite, pour savoir sin on doit acheter
    fetch('https://rmpdwebservices.ca/webservice/php/bouteilles/usager/' + this.props.id_usager, {
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
    /*
    this.state.itemsSelected
            .map((item) => {

                this.state.items.map(x => {
                    if (x.id === item) {
                        console.log("x: ", x);
                        this.setState({bouteilles: x})
                        this.setState({bouteilles: [x.id, x.millesime, x.qantite]});
                        //CODE ICI POUR PRÉPARER À SEND LE FETCH
                        // var item est égale à l'object de la bouteille sélectionnée avec toutes ses infos.
                    }
                });
            })
    */
    console.log("this.state.bouteilles: ", this.state.bouteilles);
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

  effacerListe() {

    this.state.items.map(x => {
        console.log("x: ", x.id);
        this.setState({idListeAchat: x.id});
    });

    console.log("Liste d'achat: ", this.state.idListeAchat);
    /*
    const postMethod = {
        method: 'DELETE',
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
    //console.log("items: ", this.state.items);

    console.log("Éxiste listeAchat ? : ", this.state.listeAchat);
    

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

        <span> {this.state.titre} </span>
        <div className="liste_achat_rows" style={{ height: 400, width: '100%' }}>
          <DataGrid sx={{ color: "white !important", }} rows={this.state.items} columns={colonnes}
            pageSize={5} rowsPerPageOptions={[5]} checkboxSelection disableSelectionOnClick
            onSelectionModelChange={itm => this.setState({ itemsSelected: itm })}
          />
        </div>

        
        <label className="liste_achat_check" onClick={(e) => this.effacerListe()} >Effacer liste d'achat <input type="checkbox" /> </label>

       {/* <TextField label="Effacer liste d'achat" variant="outlined" value="Effacer liste d'achat" type="checkbox" style={{ color: 'white', width: '20%' }}
                    onChange={evt => this.setState({ emplacement: evt.target.value })} /> */}

        <Button className="button" type="button" onClick={(e) => this.creerListeAchat()}> Créer Liste </Button>
      </Box>
    );
  }
} 