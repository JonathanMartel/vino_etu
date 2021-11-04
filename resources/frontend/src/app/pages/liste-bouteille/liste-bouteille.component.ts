import { Component, OnInit } from '@angular/core';
import { BouteilleDeVinService} from '@services/bouteille-de-vin.service';
import {HttpClient} from '@angular/common/http';

@Component({
  selector: 'app-liste-bouteille',
  templateUrl: './liste-bouteille.component.html',
  styleUrls: ['./liste-bouteille.component.scss']
})
export class ListeBouteilleComponent implements OnInit {
  bouteille:any;

  constructor(private servBouteilleDeVin:BouteilleDeVinService, private http: HttpClient) { }

  /* this.http.get('/url', {
    params: {

    },
    observe: 'response'
  })
  .toPromise()
  .then(response => {
    console.log(response);
  })
  .chatch(console.log); */


  ngOnInit(): void {

    this.servBouteilleDeVin.getListeBouteille().subscribe(bouteille => this.bouteille = bouteille.data);
  }

  // recherche dans la liste
  recherche(bouteilleRecherche: string) {
    console.log(encodeURIComponent(bouteilleRecherche));


  }




}
