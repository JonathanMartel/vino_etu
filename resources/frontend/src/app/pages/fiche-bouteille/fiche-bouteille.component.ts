import { Component, OnInit } from '@angular/core';
import { BouteilleDeVinService } from '@services/bouteille-de-vin.service';
import { ActivatedRoute, Router } from '@angular/router';
import { MatSnackBar } from '@angular/material/snack-bar';
import { MatDialog } from '@angular/material/dialog';
import { AjoutBouteilleComponent } from '@pages/ajout-bouteille/ajout-bouteille.component';
import { Location } from '@angular/common'
import { AuthService } from '@services/auth.service';

@Component({
    selector: 'app-fiche-bouteille',
    templateUrl: './fiche-bouteille.component.html',
    styleUrls: ['./fiche-bouteille.component.scss']
})
export class FicheBouteilleComponent implements OnInit {
    bouteille: any;
    bouteilleId: any;

    constructor(
        private actRoute: ActivatedRoute,
        public formAjout: MatDialog,
        private location: Location,
        private authService: AuthService,
        private router: Router,
    ) { }

    ngOnInit(): void {

        // Utiliser le resolver pour charger le data de la bouteille
        this.actRoute.data.subscribe(data => {
            this.bouteille = data.bouteille;
            console.log(this.bouteille);
        });
    }

    // Revenir à la page précédente
    back(): void {
        this.location.back()
    }

    // Appel du formulaire d'ajout d'un bouteille

    formulaireAjout(data: any): boolean|void {
        // Vérifier si il y a bien un utilisateur d'authentifié
        if(!this.authService.estAuthentifie()) {
            this.router.navigate(['/connection']);
            return false;
        }

        this.formAjout.open(AjoutBouteilleComponent, {
            data
        });
    }


}
