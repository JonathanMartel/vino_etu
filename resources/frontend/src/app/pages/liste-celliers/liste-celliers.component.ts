import { Component, OnInit } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { AjoutCellierComponent } from '@pages/ajout-cellier/ajout-cellier.component';
import { AuthService } from '@services/auth.service';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';

@Component({
    selector: 'app-liste-celliers',
    templateUrl: './liste-celliers.component.html',
    styleUrls: ['./liste-celliers.component.scss']
})
export class ListeCelliersComponent implements OnInit {

    listeCelliers!: any[];

    constructor(
        private servBouteilleDeVin: BouteilleDeVinService,
        private authService: AuthService,
        public formAjout: MatDialog,
    ) { }

    ngOnInit(): void {
        console.log(this.authService.getIdUtilisateurAuthentifie());

        // Charger la liste des celliers de l'utilisateur.
        this.servBouteilleDeVin.getListeCelliersParUtilisateur(this.authService.getIdUtilisateurAuthentifie())
            .subscribe((data: any) => {
                this.listeCelliers = data;
            })
    }

    formulaireAjout(data: any): void {
        this.formAjout.open(AjoutCellierComponent, {
            data
        });
    }



}
