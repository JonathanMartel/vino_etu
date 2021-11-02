import { Component, Input, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import { MatDialog } from '@angular/material/dialog';
import { ModifierCellierBouteilleComponent } from '@pages/modifier-cellier-bouteille/modifier-cellier-bouteille.component';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';

@Component({
  selector: 'app-cellier-bouteille',
  templateUrl: './cellier-bouteille.component.html',
  styleUrls: ['./cellier-bouteille.component.scss']
})
export class CellierBouteilleComponent implements OnInit {

  bouteille: any;
  inventaire: FormControl = new FormControl("", [
          Validators.min(0)
  ]);

  @Input() set uneBouteille(bouteille: any) {
    this.bouteille = bouteille
    if (bouteille) {
      this.inventaire.setValue(bouteille.inventaire);
      this.inventaire.valueChanges.subscribe(
        valeur => {
          console.log(valeur);
          if(!valeur){
            return
          }
          this.enregistrerNouvelInventaire()})
    }

};

  constructor(private servBouteilleDeVin:BouteilleDeVinService, public formModifierBouteille: MatDialog) { }

  ngOnInit(): void {

  }


  augmenter() {

    this.inventaire.setValue(this.inventaire.value + 1);

    //this.enregistrerNouvelInventaire();


  }

  diminuer() {

    if(this.inventaire.value - 1 < 0) {
      this.inventaire.setValue(0)
      return
    }

    this.inventaire.setValue(this.inventaire.value - 1);

  }


  enregistrerNouvelInventaire() {
    this.servBouteilleDeVin.modifierInventaireCellierBouteille(this.bouteille.inventaireId, this.inventaire.value)
          .subscribe()
  }

  formulaireModification(data:any): void {
    let formulaire = this.formModifierBouteille.open(ModifierCellierBouteilleComponent, {
      data
    });

    formulaire.afterClosed().subscribe(result => {
      console.log('formulaire rempli')
    })
  }

}
