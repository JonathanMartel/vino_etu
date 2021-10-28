import { Component, OnInit } from '@angular/core';
import { BouteilleDeVinService} from '@services/bouteille-de-vin.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-fiche-bouteille',
  templateUrl: './fiche-bouteille.component.html',
  styleUrls: ['./fiche-bouteille.component.scss']
})
export class FicheBouteilleComponent implements OnInit {
  bouteille:any;
  bouteilleId:any;

  constructor(private servBouteilleDeVin:BouteilleDeVinService, private actRoute: ActivatedRoute) { }

  ngOnInit(): void {

    this.bouteilleId = this.actRoute.snapshot.paramMap.get('id');

    this.servBouteilleDeVin.getBouteilleParId(this.bouteilleId).subscribe(bouteille => this.bouteille = bouteille.data);


    this.actRoute.data.subscribe(data => { this.bouteille = data.bouteille; });
  }

  ajouterBouteilleCellier(bouteilleId:any){

    this.servBouteilleDeVin.ajoutBouteilleCellier(bouteilleId).subscribe(response => {console.log(response)});
    //console.log(bouteilleId);
  }
}
