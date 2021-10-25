import { Component, OnInit } from '@angular/core';
import { BouteilleDeVinService} from '../bouteille-de-vin.service';

@Component({
  selector: 'app-liste-bouteille',
  templateUrl: './liste-bouteille.component.html',
  styleUrls: ['./liste-bouteille.component.scss']
})
export class ListeBouteilleComponent implements OnInit {
  bouteille:any;

  constructor(private servBouteilleDeVin:BouteilleDeVinService) { }

  ngOnInit(): void {

    this.servBouteilleDeVin.getListeBouteille().subscribe(bouteille => this.bouteille = bouteille);
  }

}
