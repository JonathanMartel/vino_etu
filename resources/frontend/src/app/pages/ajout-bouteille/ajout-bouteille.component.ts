import { Component, Inject, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { ActivatedRoute } from '@angular/router';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';

@Component({
    selector: 'app-ajout-bouteille',
    templateUrl: './ajout-bouteille.component.html',
    styleUrls: ['./ajout-bouteille.component.scss']
})
export class AjoutBouteilleComponent implements OnInit {
    bouteilleAchetee: any;

  ajoutBouteille = new FormGroup({
    millesime: new FormControl(''),
    inventaire: new FormControl(''),
    date_acquisition: new FormControl(''),
    prix_paye: new FormControl(''),
    conservation: new FormControl(''),
    notes_personnelles: new FormControl(''),
  });

  constructor(private servBouteilleDeVin:BouteilleDeVinService,
              private actRoute: ActivatedRoute,
              public formulaireRef: MatDialogRef<AjoutBouteilleComponent>,
              @Inject(MAT_DIALOG_DATA) public data:any){ }

  ngOnInit(): void {
    this.data;
    console.log(this.data.pays);
  }


  postBouteilleCellier(bouteille:any){

    this.bouteilleAchetee= {...this.data, ...bouteille}

    this.bouteilleAchetee.origine = this.data.pays;
    this.bouteilleAchetee.celliers_id = 1;

    console.log(this.bouteilleAchetee);

    this.servBouteilleDeVin.ajoutBouteilleCellier(this.bouteilleAchetee).subscribe(()=> {});

    setTimeout(() => {
      this.formulaireRef.close();
    }, 2000)

  }


}
