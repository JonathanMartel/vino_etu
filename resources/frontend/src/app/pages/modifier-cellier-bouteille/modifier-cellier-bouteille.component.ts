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
  bouteille: any;

  modifierBouteilleCellier = new FormGroup({
    nom: new FormControl(''),
    description: new FormControl(''),
    format: new FormControl(''),
    origine: new FormControl(''),
    url_achat: new FormControl(''),
    millesime: new FormControl(''),
    inventaire: new FormControl(''),
    date_acquisition: new FormControl(''),
    prix_paye: new FormControl(''),
    conservation: new FormControl(''),
    notes_personnelles: new FormControl(''),
  });


  constructor(private servBouteilleDeVin:BouteilleDeVinService,
              @Inject(MAT_DIALOG_DATA) public data:any) { }

  ngOnInit(): void {

    this.data;
    console.log(this.data);

    this.modifierBouteilleCellier.patchValue({
      nom: this.data.nom,
      description: this.data.description,
      format: this.data.format,
      origine: this.data.origine,
      url_achat: this.data.url_achat,
      millesime: this.data.millesime,
      inventaire: this.data.inventaire,
      date_acquisition: this.data.date_acquisition,
      prix_paye: this.data.prix_paye,
      conservation: this.data.conservation,
      notes_personnelles: this.data.notes_personnelles,
    })
  }

  putBouteille(nouvellesDonnes:any){

    console.log(nouvellesDonnes);
  }
}
