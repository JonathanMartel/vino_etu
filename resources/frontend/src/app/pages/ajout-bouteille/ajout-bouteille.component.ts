import { Component, OnInit } from '@angular/core';
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

    constructor(
        private servBouteilleDeVin: BouteilleDeVinService,
        private actRoute: ActivatedRoute,
        private snackBar: MatSnackBar
    ) { }

    ngOnInit(): void {
    }


    ajouterBouteilleCellier(bouteilleId: any) {

        this.servBouteilleDeVin.ajoutBouteilleCellier(bouteilleId).subscribe(() => { });

    }


}
