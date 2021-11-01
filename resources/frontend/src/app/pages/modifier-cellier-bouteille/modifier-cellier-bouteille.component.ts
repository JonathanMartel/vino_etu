import { Component, Inject, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';

@Component({
  selector: 'app-modifier-cellier-bouteille',
  templateUrl: './modifier-cellier-bouteille.component.html',
  styleUrls: ['./modifier-cellier-bouteille.component.scss']
})
export class ModifierCellierBouteilleComponent implements OnInit {

  modifierBouteilleCellier = new FormGroup({

    millesime: new FormControl(''),
    quantite: new FormControl(''),
    date_achat: new FormControl(''),
    prix: new FormControl(''),
    conservation: new FormControl(''),
    notes: new FormControl(''),
  });


  constructor(private servBouteilleDeVin:BouteilleDeVinService,
              public formulaireRef: MatDialogRef<ModifierCellierBouteilleComponent>,
              @Inject(MAT_DIALOG_DATA) public data:any) { }

  ngOnInit(): void {

    this.data;
    console.log(this.data);
  }

  putBouteille(nouvellesDonnes:any){

    console.log(nouvellesDonnes);
  }
}
