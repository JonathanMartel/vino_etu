import { Component, OnInit } from '@angular/core';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';
import { ActivatedRoute } from '@angular/router';
import { MatSnackBar } from '@angular/material/snack-bar';
import { MatDialog } from '@angular/material/dialog';
import { AjoutBouteilleComponent } from '@pages/ajout-bouteille/ajout-bouteille.component';

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
        public formAjout: MatDialog
    ) { }

    ngOnInit(): void {

        // Utiliser le resolver si il y a du data dans le service ActivatedRoute

            this.actRoute.data.subscribe(data => {
                console.log(data);
                this.bouteille = data.bouteille;
                console.log(this.bouteille);
            });

            return;


        // this.bouteilleId = this.actRoute.snapshot.paramMap.get('id');
        // this.servBouteilleDeVin.getBouteilleParId(this.bouteilleId).subscribe(bouteille => this.bouteille = bouteille.data);
    }

    formulaireAjout(data: any): void {
        this.formAjout.open(AjoutBouteilleComponent, {
            data
        });
    }

}
