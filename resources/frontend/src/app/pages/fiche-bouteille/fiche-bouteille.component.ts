import { Component, OnInit } from '@angular/core';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';
import { ActivatedRoute } from '@angular/router';
import { MatSnackBar } from '@angular/material/snack-bar';
import { MatDialog } from '@angular/material/dialog';
import { AjoutBouteilleComponent } from '@pages/ajout-bouteille/ajout-bouteille.component';
import {Location} from '@angular/common';
@Component({
    selector: 'app-fiche-bouteille',
    templateUrl: './fiche-bouteille.component.html',
    styleUrls: ['./fiche-bouteille.component.scss']
})
export class FicheBouteilleComponent implements OnInit {
    bouteille: any;
    bouteilleId: any;

    constructor(
        private servBouteilleDeVin: BouteilleDeVinService,
        private actRoute: ActivatedRoute,
        public formAjout: MatDialog,
        private location: Location,
    ) { }

    ngOnInit(): void {

        // Utiliser le resolver pour charger le data de la bouteille
        this.actRoute.data.subscribe(data => {
            this.bouteille = data.bouteille;
            console.log(this.bouteille);
        });
    }

    formulaireAjout(data: any): void {
        this.formAjout.open(AjoutBouteilleComponent, {
            data
        });
    }

    back() {
        this.location.back();
    }

}
