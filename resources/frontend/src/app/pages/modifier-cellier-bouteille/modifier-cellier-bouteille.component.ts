import { Component, Inject, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { ActivatedRoute } from '@angular/router';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';

@Component({
  selector: 'app-modifier-cellier-bouteille',
  templateUrl: './modifier-cellier-bouteille.component.html',
  styleUrls: ['./modifier-cellier-bouteille.component.scss']
})
export class ModifierCellierBouteilleComponent implements OnInit {
  bouteille: any;
  bouteilleId: any;
  

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


  constructor(private servBouteilleDeVin:BouteilleDeVinService, private actRoute: ActivatedRoute,
              /* public formulaireRef: MatDialogRef<ModifierCellierBouteilleComponent>,
              @Inject(MAT_DIALOG_DATA) public data:any */) { }

  ngOnInit(): void {

    this.bouteilleId = this.actRoute.snapshot.params.id;
    console.log(this.bouteilleId);
    this.servBouteilleDeVin.getBouteilleAcheteeParId(this.bouteilleId).subscribe(rep => {
      console.log(rep);
    })


   /*  this.modifierBouteilleCellier.patchValue({
      nom: this.bouteille.nom,
      description: this.bouteille.description,
      format: this.bouteille.format,
      origine: this.bouteille.origine,
      url_achat: this.bouteille.url_achat,
      millesime: this.bouteille.millesime,
      inventaire: this.bouteille.inventaire,
      date_acquisition: this.bouteille.date_acquisition,
      prix_paye: this.bouteille.prix_paye,
      conservation: this.bouteille.conservation,
      notes_personnelles: this.bouteille.notes_personnelles,
    }) */
  }

  putBouteille(nouvellesDonnes:any){

    console.log(nouvellesDonnes);
  }
}
