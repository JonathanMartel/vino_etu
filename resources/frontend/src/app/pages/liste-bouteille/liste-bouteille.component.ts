import { Component, OnInit } from '@angular/core';
import { BouteilleDeVinService} from '@services/bouteille-de-vin.service';


@Component({
  selector: 'app-liste-bouteille',
  templateUrl: './liste-bouteille.component.html',
  styleUrls: ['./liste-bouteille.component.scss']
})
export class ListeBouteilleComponent implements OnInit {
  bouteille:any;

  constructor(private servBouteilleDeVin:BouteilleDeVinService) { }

  ngOnInit(): void {

    this.servBouteilleDeVin.getListeBouteille().subscribe(bouteille => this.bouteille = bouteille.data);
  }

  // recherche dans la liste
    recherche(bouteilleRecherche: string) {
      console.log(bouteilleRecherche);
  
    }

}
