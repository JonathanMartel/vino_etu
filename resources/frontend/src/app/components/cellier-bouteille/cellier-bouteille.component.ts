import { Component, Input, OnInit } from '@angular/core';
import { startWith, pairwise} from "rxjs/operators"
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

    // Propriété permettant de rapidement savoir si la bouteille est en stock ou non
    enStock: boolean = true;

    inventaire: FormControl = new FormControl("", [
        Validators.min(0)
    ]);

    @Input() set uneBouteille(bouteille: any) {
        this.bouteille = bouteille
        if (bouteille) {
            this.inventaire.setValue(bouteille.inventaire);
            this.inventaire.valueChanges
                .pipe(startWith(undefined), pairwise())
                .subscribe(valeurs => {
                    const oldValeur = valeurs[0];
                    const newValeur = valeurs[1];

                    if (newValeur < 0) {
                        this.inventaire.setValue(0);
                        return;
                    }

                    if(newValeur !== oldValeur) {
                        this.enregistrerNouvelInventaire();
                    }
                })
        }

    };

    constructor(private servBouteilleDeVin: BouteilleDeVinService, public formModifierBouteille: MatDialog) { }

    ngOnInit(): void {

    }


    augmenter() {

        this.inventaire.setValue(this.inventaire.value + 1);

        // Si l'inventaire est au moins à 1, ajuster la propriété
        if (this.inventaire.value > 0) {
            this.enStock = true;
        }
    }

    diminuer() {
        if (this.inventaire.value - 1 < 0) {
            this.inventaire.setValue(0)
            return;
        }

        this.inventaire.setValue(this.inventaire.value - 1);

        // Si l'inventaire tombe a zéro, ajuster la propriété qui permettra de désactiver le bouton "-"
        if (this.inventaire.value === 0) {
            this.enStock = false;
        }
    }


    enregistrerNouvelInventaire() {
        this.servBouteilleDeVin.modifierInventaireCellierBouteille(this.bouteille.inventaireId, this.inventaire.value)
            .subscribe()
    }

    formulaireModification(data: any): void {
        let formulaire = this.formModifierBouteille.open(ModifierCellierBouteilleComponent, {
            data
        });

        formulaire.afterClosed().subscribe(result => {
            console.log('formulaire rempli')
        })
    }

}
