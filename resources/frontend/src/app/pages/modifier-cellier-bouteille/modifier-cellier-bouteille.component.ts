import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';

@Component({
  selector: 'app-modifier-cellier-bouteille',
  templateUrl: './modifier-cellier-bouteille.component.html',
  styleUrls: ['./modifier-cellier-bouteille.component.scss']
})
export class ModifierCellierBouteilleComponent implements OnInit {
  bouteille: any;
  modifierBouteilleCellier = new FormGroup({

    millesime: new FormControl(''),
    quantite: new FormControl(''),
    date_achat: new FormControl(''),
    prix: new FormControl(''),
    conservation: new FormControl(''),
    notes: new FormControl(''),
  });

  constructor(private servBouteilleDeVin:BouteilleDeVinService) { }

  ngOnInit(): void {
  }

  putBouteille(data:any){
    console.log(data);
  }

}
