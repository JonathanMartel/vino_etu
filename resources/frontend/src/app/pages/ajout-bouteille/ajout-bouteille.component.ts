import { Component, Inject, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
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
    quantite: new FormControl(''),
    date_achat: new FormControl(''),
    prix: new FormControl(''),
    conservation: new FormControl(''),
  });

  constructor(private servBouteilleDeVin:BouteilleDeVinService,
              private actRoute: ActivatedRoute,
              private snackBar:MatSnackBar,
              public formulaireRef: MatDialogRef<AjoutBouteilleComponent>,
              @Inject(MAT_DIALOG_DATA) public data:any){ }

  ngOnInit(): void {
    this.data;
    console.log(this.data);
  }


  postBouteilleCellier(bouteille:any){

    console.log(bouteille);

    /* this.servBouteilleDeVin.ajoutBouteilleCellier(bouteille:{this.data, bouteille}).subscribe(()=> {});

    setTimeout(() => {
      this.formulaireRef.close();
    }, 2000) */

    }


}
